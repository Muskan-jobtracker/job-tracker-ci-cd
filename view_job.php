<?php
include "db.php";

if (!isset($_GET["id"])) {
    die("Job ID not found.");
}

$id = intval($_GET["id"]);

$sql = "SELECT * FROM jobs WHERE id = $id";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Job application not found.");
}

$job = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Job Details</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            margin: 0;
        }

        .navbar {
            background: #222;
            padding: 18px 25px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 25px;
            font-size: 18px;
        }

        .container {
            max-width: 750px;
            margin: 50px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .detail {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .detail:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .value {
            font-size: 17px;
            color: #222;
        }

        .back-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 11px 20px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .back-btn:hover {
            background: #0b5ed7;
        }

    </style>

</head>

<body>

<div class="navbar">

    <a href="index.php">🏠 Dashboard</a>

    <a href="jobs.php">📋 My Jobs</a>

    <a href="add_job.php">➕ Add Job</a>

</div>


<div class="container">

    <h1>📋 Job Application Details</h1>

    <div class="card">

        <div class="detail">

            <span class="label">🏢 Company</span>

            <span class="value">
                <?php echo htmlspecialchars($job["company_name"]); ?>
            </span>

        </div>


        <div class="detail">

            <span class="label">💼 Job Title</span>

            <span class="value">
                <?php echo htmlspecialchars($job["job_title"]); ?>
            </span>

        </div>


        <div class="detail">

            <span class="label">📍 Location</span>

            <span class="value">
                <?php echo htmlspecialchars($job["location"]); ?>
            </span>

        </div>


        <div class="detail">

            <span class="label">📅 Application Date</span>

            <span class="value">
                <?php echo htmlspecialchars($job["application_date"]); ?>
            </span>

        </div>


        <div class="detail">

            <span class="label">📌 Status</span>

            <span class="value">
                <?php echo htmlspecialchars($job["status"]); ?>
            </span>

        </div>


        <div class="detail">

            <span class="label">📝 Notes</span>

            <span class="value">
                <?php echo nl2br(htmlspecialchars($job["notes"])); ?>
            </span>

        </div>


        <a href="jobs.php" class="back-btn">
            ← Back to My Jobs
        </a>

    </div>

</div>

</body>

</html>