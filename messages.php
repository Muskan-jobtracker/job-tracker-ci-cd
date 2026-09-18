<?php
include "auth.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "db.php";

// Get all contact messages
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Contact Messages - Job Tracker</title>

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

        /* Container */

        .container {
            max-width: 1150px;
            margin: 45px auto;
            padding: 20px;
        }

        .page-title {
            text-align: center;
            margin-bottom: 35px;
        }

        .page-title h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .page-title h1 i {
            color: #2196f3;
        }

        .page-title p {
            color: #666;
            font-size: 17px;
        }

        /* Message Card */

        .message-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
            border-left: 5px solid #2196f3;
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-icon {
            width: 45px;
            height: 45px;
            background: #2196f3;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info h3 {
            margin: 0 0 5px;
        }

        .email {
            color: #666;
            font-size: 14px;
        }

        .date {
            color: #888;
            font-size: 14px;
        }

        .message-text {
            background: #f7f9fc;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
            color: #444;
        }

        /* No Messages */

        .no-messages {
            background: white;
            padding: 50px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        .no-messages i {
            font-size: 50px;
            color: #2196f3;
            margin-bottom: 15px;
        }

        .no-messages h2 {
            margin-bottom: 10px;
        }

        .no-messages p {
            color: #666;
        }

        /* Responsive */

        @media(max-width: 700px) {

            .navbar {
                flex-wrap: wrap;
                gap: 15px;
            }

            .message-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
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

    <a href="messages.php">
        <i class="fa-solid fa-message"></i> Messages
    </a>

    <a href="logout.php">
        🚪 Logout
    </a>

</div>


<!-- Main -->

<div class="container">

    <div class="page-title">

        <h1>
            <i class="fa-solid fa-envelope-open-text"></i>
            Contact Messages
        </h1>

        <p>
            View messages submitted through the Contact Us page.
        </p>

    </div>


    <?php if ($result && $result->num_rows > 0): ?>

        <?php while ($row = $result->fetch_assoc()): ?>

            <div class="message-card">

                <div class="message-header">

                    <div class="user-info">

                        <div class="user-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>

                            <h3>
                                <?php echo htmlspecialchars($row['name']); ?>
                            </h3>

                            <div class="email">
                                <i class="fa-solid fa-envelope"></i>
                                <?php echo htmlspecialchars($row['email']); ?>
                            </div>

                        </div>

                    </div>


                    <div class="date">

                        <i class="fa-regular fa-clock"></i>

                        <?php echo htmlspecialchars($row['created_at']); ?>

                    </div>

                </div>


                <div class="message-text">

                    <i class="fa-solid fa-message"></i>

                    <?php echo nl2br(htmlspecialchars($row['message'])); ?>

                </div>

            </div>

        <?php endwhile; ?>


    <?php else: ?>

        <div class="no-messages">

            <i class="fa-regular fa-envelope"></i>

            <h2>No Messages Yet</h2>

            <p>
                Contact messages will appear here when someone
                submits the Contact Us form.
            </p>

        </div>

    <?php endif; ?>

</div>

</body>
</html>