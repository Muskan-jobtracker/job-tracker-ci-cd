
<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get logged-in user's ID
$user_id = $_SESSION['user_id'];

// Get user details
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User profile not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile - Job Tracker</title>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js"
            crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f7fb;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            height: 70px;
            background: #111827;
            display: flex;
            align-items: center;
            padding: 0 40px;
            color: white;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Profile Icon */
        .profile-icon {
            font-size: 24px;
            color: white;
            text-decoration: none;
            margin-left: 10px;
        }

        /* Profile Container */
        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }

        .profile-card {
            width: 420px;
            background: white;
            border-radius: 15px;
            padding: 35px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* User Circle */
        .user-circle {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #111827;
            color: white;

            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 45px;
        }

        .profile-card h2 {
            margin-bottom: 25px;
            color: #111827;
        }

        .profile-info {
            text-align: left;
            margin-top: 20px;
        }

        .info-box {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-box:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            color: #111827;
            font-weight: 500;
        }

        /* Button */
        .back-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background: #111827;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .back-btn:hover {
            opacity: 0.85;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 0 20px;
            }

            .nav-links {
                gap: 12px;
            }

            .nav-links a {
                font-size: 14px;
            }

            .profile-card {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar">

    <div class="logo">
        Job Tracker
    </div>

    <div class="nav-links">

        <a href="index.php">Dashboard</a>

        <a href="jobs.php">Jobs</a>

        <a href="messages.php">Messages</a>

        <a href="profile.php" class="profile-icon" title="Profile">
            <i class="fa-solid fa-user"></i>
        </a>

        <a href="logout.php">Logout</a>

    </div>

</nav>


<!-- Profile -->
<div class="profile-container">

    <div class="profile-card">

        <div class="user-circle">
            <i class="fa-utility-fill fa-semibold fa-user"></i>
        </div>

        <h2>My Profile</h2>

        <div class="profile-info">

            <div class="info-box">
                <div class="info-label">Name</div>

                <div class="info-value">
                    <?php echo htmlspecialchars($user['name']); ?>
                </div>
            </div>


            <div class="info-box">
                <div class="info-label">Email</div>

                <div class="info-value">
                    <?php echo htmlspecialchars($user['email']); ?>
                </div>
            </div>


    <div class="info-box">
        <div class="info-label">Phone</div>
        <div class="info-value">
            <?php echo htmlspecialchars($user['phone'] ?? 'Not added'); ?>
        </div>
    </div>

    <div class="info-box">
        <div class="info-label">Location</div>
        <div class="info-value">
            <?php echo htmlspecialchars($user['location'] ?? 'Not added'); ?>
        </div>
    </div>

    <div class="info-box">
        <div class="info-label">Education</div>
        <div class="info-value">
            <?php echo htmlspecialchars($user['education'] ?? 'Not added'); ?>
        </div>
    </div>

    <div class="info-box">
        <div class="info-label">Skills</div>
        <div class="info-value">
            <?php echo htmlspecialchars($user['skills'] ?? 'Not added'); ?>
        </div>
    </div>

    <div class="info-box">
        <div class="info-label">LinkedIn</div>
        <div class="info-value">
            <?php echo htmlspecialchars($user['linkedin'] ?? 'Not added'); ?>
        </div>
    </div>

    <div class="info-box">
        <div class="info-label">GitHub</div>
        <div class="info-value">
            <?php echo htmlspecialchars($user['github'] ?? 'Not added'); ?>
        </div>
    </div>

        </div>

        <a href="edit_profile.php" class="back-btn">
    ✏️ Edit Profile
</a>

<a href="index.php" class="back-btn">
    🏠 Back to Dashboard
</a>

    </div>

</div>

</body>
</html>
