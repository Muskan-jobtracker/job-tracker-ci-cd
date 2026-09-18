<?php

include "auth.php";
include "db.php";

$message_sent = false;

if (isset($_POST['send_message'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    $stmt = $conn->prepare(
        "INSERT INTO contact_messages (name, email)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $message_sent = true;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Contact - Job Tracker</title>

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
        .contact-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 20px;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-header h1 {
            font-size: 38px;
        }

        .contact-header h1 i {
            color: #2196f3;
        }

        .contact-header p {
            font-size: 18px;
            color: #555;
        }

        /* Contact Layout */
        .contact-box {
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 30px;
        }

        /* Information */
        .contact-info {
            background: #222;
            color: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .contact-info h2 {
            margin-top: 0;
            font-size: 27px;
        }

        .contact-info p {
            color: #ddd;
            line-height: 1.6;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 18px;
            margin: 28px 0;
        }

        .info-item i {
            width: 45px;
            height: 45px;
            background: #2196f3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .info-item span {
            font-size: 16px;
        }

        /* Form */
        .contact-form {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        .contact-form h2 {
            margin-top: 0;
            font-size: 27px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group label i {
            color: #2196f3;
            margin-right: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2196f3;
            box-shadow: 0 0 5px rgba(33,150,243,0.2);
        }

        textarea {
            resize: vertical;
        }

        .send-btn {
            width: 100%;
            padding: 14px;
            background: #2196f3;
            border: none;
            border-radius: 7px;
            color: white;
            font-size: 17px;
            cursor: pointer;
        }

        .send-btn:hover {
            background: #1976d2;
        }

        /* Responsive */
        @media(max-width: 800px) {

            .contact-box {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-wrap: wrap;
                gap: 15px;
            }

            .success-message {
             background: #e8f5e9;
             color: #2e7d32;
             padding: 14px;
             border-radius: 7px;
             margin-bottom: 20px;
             text-align: center;
             font-weight: bold;
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


<div class="contact-container">

    <div class="contact-header">

        <h1>
            <i class="fa-solid fa-envelope"></i>
            Contact Us
        </h1>

        <p>
            Have a question or suggestion? We'd love to hear from you.
        </p>

    </div>


    <div class="contact-box">

        <!-- Contact Information -->

        <div class="contact-info">

            <h2>Get In Touch</h2>

            <p>
                If you have any questions, feedback or suggestions
                about Job Tracker, feel free to contact us.
            </p>


            <div class="info-item">

                <i class="fa-solid fa-envelope"></i>

                <span>
                    jobtracker@example.com
                </span>

            </div>


            <div class="info-item">

                <i class="fa-solid fa-phone"></i>

                <span>
                    +91 XXXXX XXXXX
                </span>

            </div>


            <div class="info-item">

                <i class="fa-solid fa-location-dot"></i>

                <span>
                    Gujarat, India
                </span>

            </div>

        </div>


        <!-- Contact Form -->

        <div class="contact-form">

            <h2>
                <i class="fa-solid fa-message"></i>
                Send Us a Message
            </h2>

             <div class="success-message">
             <i class="fa-solid fa-circle-check"></i>
                 Message sent successfully!
            </div>


            <form method="POST" action="">

                <div class="form-group">

                    <label>
                        <i class="fa-solid fa-user"></i>
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter your name"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        <i class="fa-solid fa-envelope"></i>
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        <i class="fa-solid fa-message"></i>
                        Message
                    </label>

                    <textarea
                        name="message"
                        rows="6"
                        placeholder="Write your message..."
                        required
                    ></textarea>

                </div>


                <button
                    type="submit"
                    name="send_message"
                    class="send-btn"
                >

                    <i class="fa-solid fa-paper-plane"></i>
                    Send Message

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
