<?php
session_start();
include "db.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$message = "";

// Get current user information
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}

// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $education = trim($_POST['education']);
    $skills = trim($_POST['skills']);
  //  $linkedin = trim($_POST['linkedin']);
    $github = trim($_POST['github']);

    $update_sql = "UPDATE users SET
                    name = ?,
                    email = ?,
                    phone = ?,
                    location = ?,
                    education = ?,
                    skills = ?,
                    linkedin = ?,
                    github = ?
                   WHERE id = ?";

    $stmt = $conn->prepare($update_sql);

    $stmt->bind_param(
        "ssssssssi",
        $name,
        $email,
        $phone,
        $location,
        $education,
        $skills,
        $linkedin,
        $github,
        $user_id
    );

    if ($stmt->execute()) {

        // Update session name
        $_SESSION['user'] = $name;

        $message = "Profile updated successfully!";

        // Reload updated data
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

    } else {
        $message = "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Profile - Job Tracker</title>

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

/* Container */

.profile-container {
    display: flex;
    justify-content: center;
    padding: 50px 20px;
}

/* Form Card */

.profile-card {
    width: 550px;
    background: white;
    border-radius: 15px;
    padding: 35px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.profile-card h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #111827;
}

/* Form */

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;
    font-size: 14px;
    font-weight: bold;
    color: #374151;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 7px;
    font-size: 15px;
    outline: none;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #2563eb;
}

.form-group textarea {
    height: 90px;
    resize: vertical;
}

/* Buttons */

.button-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 25px;
}

.save-btn,
.cancel-btn {
    padding: 12px 25px;
    border-radius: 7px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    font-size: 15px;
}

.save-btn {
    background: #2563eb;
    color: white;
}

.save-btn:hover {
    background: #1d4ed8;
}

.cancel-btn {
    background: #6b7280;
    color: white;
}

.cancel-btn:hover {
    background: #4b5563;
}

/* Success message */

.message {
    background: #d1fae5;
    color: #065f46;
    padding: 12px;
    border-radius: 7px;
    text-align: center;
    margin-bottom: 20px;
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

        <a href="profile.php">Profile</a>

        <a href="logout.php">Logout</a>

    </div>

</nav>


<!-- Edit Profile -->

<div class="profile-container">

    <div class="profile-card">

        <h2>✏️ Edit Profile</h2>

        <?php if ($message != "") { ?>

            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>

        <?php } ?>


        <form method="POST">

            <div class="form-group">

                <label>Full Name</label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo htmlspecialchars($user['name']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($user['email']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"
                    placeholder="Enter phone number"
                >

            </div>


            <div class="form-group">

                <label>Location</label>

                <input
                    type="text"
                    name="location"
                    value="<?php echo htmlspecialchars($user['location'] ?? ''); ?>"
                    placeholder="Enter your location"
                >

            </div>


            <div class="form-group">

                <label>Education</label>

                <input
                    type="text"
                    name="education"
                    value="<?php echo htmlspecialchars($user['education'] ?? ''); ?>"
                    placeholder="Example: B.Tech Computer Engineering"
                >

            </div>


            <div class="form-group">

                <label>Skills</label>

                <textarea
                    name="skills"
                    placeholder="Example: Python, SQL, PHP, HTML, CSS, JavaScript"
                ><?php echo htmlspecialchars($user['skills'] ?? ''); ?></textarea>

            </div>


            <div class="form-group">

                <label>LinkedIn Profile</label>

                <input
                    type="text"
                    name="linkedin"
                    value="<?php echo htmlspecialchars($user['linkedin'] ?? ''); ?>"
                    placeholder="LinkedIn profile link"
                >

            </div>


            <div class="form-group">

                <label>GitHub Profile</label>

                <input
                    type="text"
                    name="github"
                    value="<?php echo htmlspecialchars($user['github'] ?? ''); ?>"
                    placeholder="GitHub profile link"
                >

            </div>


            <div class="button-container">

                <button type="submit" class="save-btn">
                    💾 Save Profile
                </button>

                <a href="profile.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>
