<?php
include "db.php";
include "auth.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $company_name = $_POST['company_name'];
    $job_title = $_POST['job_title'];
    $location = $_POST['location'];
    $application_date = $_POST['application_date'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO jobs 
            (company_name, job_title, location, application_date, status, notes)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssss",
        $company_name,
        $job_title,
        $location,
        $application_date,
        $status,
        $notes
    );

    if ($stmt->execute()) {
        $message = "Job application saved successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Job | Job Tracker</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
        }

        /* Navbar */

        .navbar {
            background: #222;
            padding: 18px 40px;
            display: flex;
            align-items: center;
            gap: 35px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 17px;
            font-weight: 500;
        }

        .navbar a:hover {
            color: #0d6efd;
        }

        /* Main container */

        .container {
            width: 90%;
            max-width: 800px;
            margin: 50px auto;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 32px;
            color: #222;
        }

        .title p {
            margin-top: 8px;
            color: #666;
            font-size: 15px;
        }

        /* Form card */

        .form-card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.10);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 4px rgba(13, 110, 253, 0.25);
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        /* Buttons */

        .button-area {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .save-btn {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 7px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        .save-btn:hover {
            background: #0b5ed7;
        }

        .back-btn {
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 7px;
            font-size: 16px;
        }

        .back-btn:hover {
            background: #5c636a;
        }

        /* Success message */

        .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        /* Responsive */

        @media (max-width: 600px) {

            .navbar {
                padding: 15px;
                gap: 15px;
            }

            .navbar a {
                font-size: 14px;
            }

            .container {
                width: 94%;
                margin: 30px auto;
            }

            .form-card {
                padding: 22px;
            }

            .title h1 {
                font-size: 26px;
            }

            .button-area {
                flex-direction: column;
            }

            .save-btn,
            .back-btn {
                width: 100%;
                text-align: center;
            }
        }

    </style>
</head>

<body>

    <!-- Navbar -->

    <div class="navbar">

        <a href="index.php">🏠 Dashboard</a>

        <a href="jobs.php">📋 My Jobs</a>

        <a href="add_job.php">➕ Add Job</a>

    </div>


    <!-- Main Content -->

    <div class="container">

        <div class="title">

            <h1>➕ Add New Job</h1>

            <p>Keep track of your job applications easily</p>

        </div>


        <div class="form-card">

            <?php if ($message != "") { ?>

                <div class="success">
                    <?php echo $message; ?>
                </div>

            <?php } ?>


            <form method="POST">


                <!-- Company -->

                <div class="form-group">

                    <label for="company_name">
                        🏢 Company Name
                    </label>

                    <input
                        type="text"
                        id="company_name"
                        name="company_name"
                        placeholder="Enter company name"
                        required
                    >

                </div>


                <!-- Job Title -->

                <div class="form-group">

                    <label for="job_title">
                        💼 Job Title
                    </label>

                    <input
                        type="text"
                        id="job_title"
                        name="job_title"
                        placeholder="e.g. Software Developer"
                        required
                    >

                </div>


                <!-- Location -->

                <div class="form-group">

                    <label for="location">
                        📍 Location
                    </label>

                    <input
                        type="text"
                        id="location"
                        name="location"
                        placeholder="e.g. Ahmedabad"
                        required
                    >

                </div>


                <!-- Application Date -->

                <div class="form-group">

                    <label for="application_date">
                        📅 Application Date
                    </label>

                    <input
                        type="date"
                        id="application_date"
                        name="application_date"
                        required
                    >

                </div>


                <!-- Status -->

                <div class="form-group">

                    <label for="status">
                        📌 Application Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                    >

                        <option value="Applied">
                            Applied
                        </option>

                        <option value="Interview">
                            Interview
                        </option>

                        <option value="Selected">
                            Selected
                        </option>

                        <option value="Rejected">
                            Rejected
                        </option>

                    </select>

                </div>


                <!-- Notes -->

                <div class="form-group">

                    <label for="notes">
                        📝 Notes
                    </label>

                    <textarea
                        id="notes"
                        name="notes"
                        placeholder="Add any notes about this application..."
                    ></textarea>

                </div>


                <!-- Buttons -->

                <div class="button-area">

                    <button
                        type="submit"
                        class="save-btn"
                    >
                        💾 Save Job
                    </button>

                    <a
                        href="jobs.php"
                        class="back-btn"
                    >
                        ← Back to Jobs
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>