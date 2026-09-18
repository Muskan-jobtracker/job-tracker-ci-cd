<?php
include "db.php";

if (!isset($_GET["id"])) {
    header("Location: jobs.php");
    exit();
}

$id = $_GET["id"];

// Get existing job
$sql = "SELECT * FROM jobs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$job = $result->fetch_assoc();

if (!$job) {
    echo "Job not found.";
    exit();
}

$stmt->close();


// Update job
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $company_name = $_POST["company_name"];
    $job_title = $_POST["job_title"];
    $location = $_POST["location"];
    $application_date = $_POST["application_date"];
    $status = $_POST["status"];
    $notes = $_POST["notes"];

    $sql = "UPDATE jobs SET
            company_name = ?,
            job_title = ?,
            location = ?,
            application_date = ?,
            status = ?,
            notes = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssi",
        $company_name,
        $job_title,
        $location,
        $application_date,
        $status,
        $notes,
        $id
    );

    if ($stmt->execute()) {
        header("Location: jobs.php?updated=1");
        exit();
    } else {
        echo "Error updating job: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Job</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }

        .container {
            width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
        }
    </style>

</head>

<body>

<div class="container">

    <h1>✏️ Edit Job</h1>

    <form method="POST">

        <label>Company Name:</label>

        <input
            type="text"
            name="company_name"
            value="<?php echo htmlspecialchars($job['company_name']); ?>"
            required
        >

        <label>Job Title:</label>

        <input
            type="text"
            name="job_title"
            value="<?php echo htmlspecialchars($job['job_title']); ?>"
            required
        >

        <label>Location:</label>

        <input
            type="text"
            name="location"
            value="<?php echo htmlspecialchars($job['location']); ?>"
        >

        <label>Application Date:</label>

        <input
            type="date"
            name="application_date"
            value="<?php echo htmlspecialchars($job['application_date']); ?>"
        >

        <label>Status:</label>

        <select name="status">

            <option value="Applied"
                <?php if ($job['status'] == 'Applied') echo 'selected'; ?>>
                Applied
            </option>

            <option value="Interview"
                <?php if ($job['status'] == 'Interview') echo 'selected'; ?>>
                Interview
            </option>

            <option value="Selected"
                <?php if ($job['status'] == 'Selected') echo 'selected'; ?>>
                Selected
            </option>

            <option value="Rejected"
                <?php if ($job['status'] == 'Rejected') echo 'selected'; ?>>
                Rejected
            </option>

        </select>

        <label>Notes:</label>

        <textarea name="notes"><?php echo htmlspecialchars($job['notes']); ?></textarea>

        <button type="submit">
            Update Job
        </button>

    </form>

    <br>

    <a href="jobs.php">← Back to Jobs</a>

</div>

</body>
</html>