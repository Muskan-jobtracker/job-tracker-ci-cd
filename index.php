<?php
include "db.php";
include "auth.php";

$user_id = $_SESSION["user_id"];

// Total jobs
$total_sql = "SELECT COUNT(*) AS total FROM jobs WHERE user_id = ?";
$stmt = $conn->prepare($total_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total = $stmt->get_result()->fetch_assoc()["total"];
$stmt->close();

// Applied
$applied_sql = "SELECT COUNT(*) AS count FROM jobs WHERE user_id = ? AND status = 'Applied'";
$stmt = $conn->prepare($applied_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$applied = $stmt->get_result()->fetch_assoc()["count"];
$stmt->close();

// Interview
$interview_sql = "SELECT COUNT(*) AS count FROM jobs WHERE user_id = ? AND status = 'Interview'";
$stmt = $conn->prepare($interview_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$interview = $stmt->get_result()->fetch_assoc()["count"];
$stmt->close();

// Selected
$selected_sql = "SELECT COUNT(*) AS count FROM jobs WHERE user_id = ? AND status = 'Selected'";
$stmt = $conn->prepare($selected_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$selected = $stmt->get_result()->fetch_assoc()["count"];
$stmt->close();

// Rejected
$rejected_sql = "SELECT COUNT(*) AS count FROM jobs WHERE user_id = ? AND status = 'Rejected'";
$stmt = $conn->prepare($rejected_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$rejected = $stmt->get_result()->fetch_assoc()["count"];
$stmt->close();
?>



<!DOCTYPE html>
<html>

<head>

    <title>Job Tracker Dashboard</title>

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }

        /* ===== NAVBAR ===== */

.navbar {
    height: 70px;
    background-color: #222;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 25px;
    box-sizing: border-box;
}

/* Left side navigation */
.nav-left {
    display: flex;
    align-items: center;
    gap: 30px;
}

/* Navigation links */
.nav-left a {
    color: white !important;
    text-decoration: none !important;
    font-size: 20px;
    font-family: Arial, sans-serif;
}

.nav-left a:visited {
    color: white !important;
}

.nav-left a:hover {
    color: #2196f3 !important;
    text-decoration: none !important;
}

/* Profile */
.profile-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-icon a {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none !important;
    font-size: 22px;
}

.profile-icon a:hover {
    background: #e8e8e8;
}
        .container {
            padding: 30px;
        }

        h1 {
            text-align: center;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 30px;
        }

        .card {
            background: white;
            width: 180px;
            padding: 25px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }

        .card h2 {
            font-size: 35px;
            margin: 10px;
        }

        .card p {
            font-size: 18px;
        }

        .total {
            border-top: 5px solid #333;
        }

        .applied {
            border-top: 5px solid #007bff;
        }

        .interview {
            border-top: 5px solid #ffc107;
        }

        .selected {
            border-top: 5px solid #28a745;
        }

        .rejected {
            border-top: 5px solid #dc3545;
        }

        .add-button {
            display: block;
            width: 180px;
            margin: 35px auto;
            padding: 12px;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            font-size: 17px;
        }

        .chart-container {
    width: 550px;
    max-width: 90%;
    margin: 40px auto;
    padding: 25px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    text-align: center;
}

.chart-container h2 {
    margin-bottom: 25px;
}

.donut-chart {
    width: 300px;
    height: 300px;
    border-radius: 50%;
    margin: 0 auto 25px auto;

    display: flex;
    align-items: center;
    justify-content: center;
}

.donut-center {
    width: 150px;
    height: 150px;
    background: white;
    border-radius: 50%;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    font-size: 35px;
    font-weight: bold;
}

.donut-center span {
    font-size: 16px;
    font-weight: normal;
}

.chart-legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 16px;
}

.legend-box {
    display: inline-block;
    width: 15px;
    height: 15px;
    margin-right: 5px;
    border-radius: 3px;
}

.applied-box {
    background: #007bff;
}

.interview-box {
    background: #ffc107;
}

.selected-box {
    background: #28a745;
}

.rejected-box {
    background: #dc3545;
}

   .theme-btn {
    border: none;
    background: transparent;
    color: white;
    font-size: 26px;
    cursor: pointer;
    padding: 8px 12px;
}

.theme-btn:hover {
    transform: scale(1.1);
}

/* DARK MODE */

body.dark-mode {
    background: #121212;
    color: white;
}

body.dark-mode .container {
    background: #1e1e1e;
    color: white;
}

body.dark-mode .card {
    background: #1e1e1e;
    color: white;
}

body.dark-mode h1,
body.dark-mode h2,
body.dark-mode p {
    color: white;
}



    </style>

</head>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const themeToggle = document.getElementById("themeToggle");

    if (!themeToggle) {
        return;
    }

    // Load saved theme
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        themeToggle.textContent = "☀️";
    }

    // Theme button
    themeToggle.addEventListener("click", function () {

        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {

            localStorage.setItem("theme", "dark");
            themeToggle.textContent = "☀️";

        } else {

            localStorage.setItem("theme", "light");
            themeToggle.textContent = "🌙";

        }

    });

});

</script>

<body>

<body>

<div class="navbar">

  <div class="nav-left">

    <a href="index.php">🏠 Dashboard</a>

    <a href="jobs.php">📋 My Jobs</a>

    <a href="add_job.php">➕ Add Job</a>

    <a href="about.php">ℹ️ About</a>

   

    <a href="contact.php">✉️ Contact</a>


    <a href="messages.php">
        💬 Messages
    </a>


    <a href="logout.php">🚪 Logout</a>

    <button id="themeToggle" class="theme-btn" type="button">🌙</button>

</div>
     
    <div class="profile-icon">
        <a href="profile.php" title="Profile">👤</a>
    </div>


</div>

<div class="container">

    <h1>📊 Job Tracker Dashboard</h1>

    <div class="cards">

        <div class="card total">
            <h2><?php echo $total; ?></h2>
            <p>Total Applications</p>
        </div>

        <div class="card applied">
            <h2><?php echo $applied; ?></h2>
            <p>Applied</p>
        </div>

        <div class="card interview">
            <h2><?php echo $interview; ?></h2>
            <p>Interview</p>
        </div>

        <div class="card selected">
            <h2><?php echo $selected; ?></h2>
            <p>Selected</p>
        </div>

        <div class="card rejected">
            <h2><?php echo $rejected; ?></h2>
            <p>Rejected</p>
        </div>

    </div>

    <a href="add_job.php" class="add-button">
        + Add New Job
    </a>

    <!-- <div class="chart-container">
    <h2>📊 Application Status</h2>

    <canvas id="jobChart"></canvas>
</div> -->

<?php
$total_status = $applied + $interview + $selected + $rejected;

if ($total_status > 0) {

    $applied_percent = ($applied / $total_status) * 100;
    $interview_percent = ($interview / $total_status) * 100;
    $selected_percent = ($selected / $total_status) * 100;

} else {

    $applied_percent = 0;
    $interview_percent = 0;
    $selected_percent = 0;
}
?>

<div class="chart-container">

    <h2>📊 Application Status</h2>

    <div
        class="donut-chart"
        style="
        background: conic-gradient(
            #007bff 0% <?php echo $applied_percent; ?>%,

            #ffc107 <?php echo $applied_percent; ?>%
            <?php echo $applied_percent + $interview_percent; ?>%,

            #28a745 <?php echo $applied_percent + $interview_percent; ?>%
            <?php echo $applied_percent + $interview_percent + $selected_percent; ?>%,

            #dc3545 <?php echo $applied_percent + $interview_percent + $selected_percent; ?>%
            100%
        );
        "
    >

        <div class="donut-center">
            <?php echo $total_status; ?>
            <span>Total</span>
        </div>

    </div>

    <div class="chart-legend">

        <div>
            <span class="legend-box applied-box"></span>
            Applied: <?php echo $applied; ?>
        </div>

        <div>
            <span class="legend-box interview-box"></span>
            Interview: <?php echo $interview; ?>
        </div>

        <div>
            <span class="legend-box selected-box"></span>
            Selected: <?php echo $selected; ?>
        </div>

        <div>
            <span class="legend-box rejected-box"></span>
            Rejected: <?php echo $rejected; ?>
        </div>

    </div>

</div>

</div>

</body>

</html>