<?php
include "db.php";

// Search value
$search = isset($_GET["search"]) ? $_GET["search"] : "";

// Status filter
$status = isset($_GET["status"]) ? $_GET["status"] : "";

// Build query
$sql = "SELECT * FROM jobs WHERE 1=1";

if ($search != "") {
    $search_safe = $conn->real_escape_string($search);

    $sql .= " AND (
        company_name LIKE '%$search_safe%'
        OR job_title LIKE '%$search_safe%'
        OR location LIKE '%$search_safe%'
    )";
}

if ($status != "") {
    $status_safe = $conn->real_escape_string($status);
    $sql .= " AND status = '$status_safe'";
}

$sql .= " ORDER BY id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Job Applications</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f6f8;
        }

        /* NAVBAR */

        .navbar {
            background-color: #222;
            padding: 18px 25px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 25px;
            font-size: 18px;
        }

        .navbar a:hover {
            color: #0d6efd;
        }

        /* CONTAINER */

        .container {
            padding: 35px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        /* ADD BUTTON */

        .add-btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .add-btn:hover {
            background-color: #0b5ed7;
        }

        /* SEARCH */

        .search-box {
            background: white;
            padding: 22px;
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        .search-box input,
        .search-box select {
            padding: 11px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .search-btn {
            padding: 11px 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .search-btn:hover {
            background-color: #0b5ed7;
        }

        .reset-btn {
            display: inline-block;
            padding: 11px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .reset-btn:hover {
            background-color: #5c636a;
        }

        /* MESSAGE */

        .message {
            color: #198754;
            background: #d1e7dd;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* TABLE */

        .table-container {
            background: white;
            border-radius: 10px;
            overflow-x: auto;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th {
            background-color: #333;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        /* STATUS */

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .applied {
            background-color: #cfe2ff;
            color: #084298;
        }

        .interview {
            background-color: #fff3cd;
            color: #664d03;
        }

        .selected {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .rejected {
            background-color: #f8d7da;
            color: #842029;
        }

        /* ACTION BUTTONS */

        .action {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .view-btn,
        .edit-btn,
        .delete-btn {
            padding: 7px 11px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .view-btn {
            background-color: #198754;
            color: white;
        }

        .view-btn:hover {
            background-color: #157347;
        }

        .edit-btn {
            background-color: #0d6efd;
            color: white;
        }

        .edit-btn:hover {
            background-color: #0b5ed7;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #bb2d3b;
        }

        /* MOBILE */

        @media (max-width: 700px) {

            .container {
                padding: 20px;
            }

            .navbar a {
                font-size: 15px;
                margin-right: 12px;
            }

            .search-box input,
            .search-box select,
            .search-btn,
            .reset-btn {
                margin-bottom: 10px;
            }

        }

    </style>

</head>

<body>

<!-- NAVIGATION -->

<div class="navbar">

    <a href="index.php">🏠 Dashboard</a>

    <a href="jobs.php">📋 My Jobs</a>

    <a href="add_job.php">➕ Add Job</a>

</div>


<div class="container">

    <h1>📋 My Job Applications</h1>

    <a href="add_job.php" class="add-btn">
        + Add New Job
    </a>


    <?php

    if (isset($_GET["deleted"])) {

        echo "<div class='message'>
                Job deleted successfully! ✅
              </div>";

    }

    if (isset($_GET["updated"])) {

        echo "<div class='message'>
                Job updated successfully! ✅
              </div>";

    }

    ?>


    <!-- SEARCH AND FILTER -->

    <div class="search-box">

        <form method="GET">

            <input
                type="text"
                name="search"
                placeholder="Search company, job or location..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <select name="status">

                <option value="">All Status</option>

                <option value="Applied"
                    <?php if ($status == "Applied") echo "selected"; ?>>
                    Applied
                </option>

                <option value="Interview"
                    <?php if ($status == "Interview") echo "selected"; ?>>
                    Interview
                </option>

                <option value="Selected"
                    <?php if ($status == "Selected") echo "selected"; ?>>
                    Selected
                </option>

                <option value="Rejected"
                    <?php if ($status == "Rejected") echo "selected"; ?>>
                    Rejected
                </option>

            </select>

            <button type="submit" class="search-btn">
                🔍 Search
            </button>

            <a href="jobs.php" class="reset-btn">
                Reset
            </a>

        </form>

    </div>


    <!-- JOB TABLE -->

    <div class="table-container">

        <table>

            <tr>

                <th>ID</th>
                <th>Company</th>
                <th>Job Title</th>
                <th>Location</th>
                <th>Application Date</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>

            </tr>


            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    echo "<tr>";

                    echo "<td>" .
                        $row["id"] .
                        "</td>";

                    echo "<td>" .
                        htmlspecialchars($row["company_name"]) .
                        "</td>";

                    echo "<td>" .
                        htmlspecialchars($row["job_title"]) .
                        "</td>";

                    echo "<td>" .
                        htmlspecialchars($row["location"]) .
                        "</td>";

                    echo "<td>" .
                        htmlspecialchars($row["application_date"]) .
                        "</td>";


                    /* STATUS */

                    $status_class = strtolower($row["status"]);

                    echo "<td>
                            <span class='status $status_class'>
                                " . htmlspecialchars($row["status"]) . "
                            </span>
                          </td>";


                    echo "<td>" .
                        htmlspecialchars($row["notes"]) .
                        "</td>";


                    /* ACTION */

                    echo "<td>

                        <div class='action'>

                            <a class='view-btn'
                               href='view_job.php?id=" . $row["id"] . "'>
                               👁 View
                            </a>

                            <a class='edit-btn'
                               href='edit_job.php?id=" . $row["id"] . "'>
                               ✏️ Edit
                            </a>

                            <a class='delete-btn'
                               href='delete_job.php?id=" . $row["id"] . "'
                               onclick=\"return confirm('Are you sure you want to delete this job?');\">
                               🗑️ Delete
                            </a>

                        </div>

                    </td>";

                    echo "</tr>";

                }

            } else {

                echo "<tr>
                        <td colspan='8' style='text-align:center;'>
                            No job applications found.
                        </td>
                      </tr>";

            }

            ?>

        </table>

    </div>

</div>

</body>
</html>