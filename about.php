<?php
include "auth.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>About - Job Tracker</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #111;
        }

        /* Navbar */
        .navbar {
            background: #222;
            padding: 18px 25px;
            display: flex;
            align-items: center;
            gap: 35px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 20px;
        }

        .navbar a:hover {
            color: #2196f3;
        }

        /* Main */
        .about-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 20px;
        }

        .about-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .about-header h1 {
            font-size: 38px;
            margin-bottom: 10px;
        }

        .about-header h1 i {
            color: #2196f3;
        }

        .about-header p {
            font-size: 18px;
            color: #555;
        }

        /* Main Card */
        .intro-card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
            text-align: center;
            margin-bottom: 35px;
        }

        .intro-icon {
            font-size: 45px;
            color: #2196f3;
            margin-bottom: 15px;
        }

        .intro-card h2 {
            font-size: 28px;
        }

        .intro-card p {
            font-size: 17px;
            line-height: 1.7;
            color: #555;
        }

        /* Feature Cards */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .feature-card {
            background: white;
            padding: 30px 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
            border-top: 4px solid #2196f3;
        }

        .feature-card i {
            font-size: 35px;
            color: #2196f3;
            margin-bottom: 15px;
        }

        .feature-card h3 {
            font-size: 21px;
            margin: 10px 0;
        }

        .feature-card p {
            color: #666;
            line-height: 1.5;
        }

        /* Technology */
        .technology {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
            text-align: center;
        }

        .technology h2 {
            margin-bottom: 25px;
        }

        .tech-list {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .tech {
            padding: 12px 20px;
            background: #f0f7ff;
            border-radius: 8px;
            color: #1976d2;
            font-weight: bold;
        }

        /* Responsive */
        @media(max-width: 800px) {
            .features {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-wrap: wrap;
                gap: 15px;
            }
        }

    </style>
</head>

<body>

<!-- Navbar -->
<div class="navbar">

    <a href="index.php">
        🏠 Dashboard
    </a>

    <a href="jobs.php">
        📄 My Jobs
    </a>

    <a href="add_job.php">
        ➕ Add Job
    </a>

    <a href="about.php">
        <i class="fa-solid fa-circle-info"></i> About
    </a>

    <a href="contact.php">
        <i class="fa-solid fa-envelope"></i> Contact
    </a>

    <a href="logout.php">
        🚪 Logout
    </a>

</div>


<div class="about-container">

    <div class="about-header">

        <h1>
            <i class="fa-solid fa-circle-info"></i>
            About Job Tracker
        </h1>

        <p>
            Manage your job applications easily and efficiently.
        </p>

    </div>


    <div class="intro-card">

        <div class="intro-icon">
            <i class="fa-solid fa-briefcase"></i>
        </div>

        <h2>What is Job Tracker?</h2>

        <p>
            Job Tracker is a web-based application designed to help
            users manage and monitor their job applications in one place.
            It allows users to add jobs, search applications, track
            application status and manage their job search process.
        </p>

    </div>


    <div class="features">

        <div class="feature-card">

            <i class="fa-solid fa-briefcase"></i>

            <h3>Manage Jobs</h3>

            <p>
                Add and manage all your job applications
                from one place.
            </p>

        </div>


        <div class="feature-card">

            <i class="fa-solid fa-chart-line"></i>

            <h3>Track Progress</h3>

            <p>
                Track whether your application is applied,
                under interview, selected or rejected.
            </p>

        </div>


        <div class="feature-card">

            <i class="fa-solid fa-magnifying-glass"></i>

            <h3>Search & Filter</h3>

            <p>
                Quickly find job applications using
                search and status filters.
            </p>

        </div>

    </div>


    <!-- <div class="technology">

        <h2>
            <i class="fa-solid fa-code"></i>
            Technologies Used
        </h2>

        <div class="tech-list">

            <div class="tech">HTML</div>

            <div class="tech">CSS</div>

            <div class="tech">JavaScript</div>

            <div class="tech">PHP</div>

            <div class="tech">MySQL</div>

        </div>

    </div> -->

</div>

</body>
</html>