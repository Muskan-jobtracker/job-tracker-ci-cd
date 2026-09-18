<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($name == "" || $email == "" || $password == "") {

        $message = "Please fill all fields.";

    } else {

        $check = $conn->prepare(
            "SELECT id FROM users WHERE email = ?"
        );

        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $message = "Email already registered.";

        } else {

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = $conn->prepare(
                "INSERT INTO users (name, email, password)
                 VALUES (?, ?, ?)"
            );

            $stmt->bind_param(
                "sss",
                $name,
                $email,
                $hashed_password
            );

            if ($stmt->execute()) {

                $message = "Registration successful! You can now login. ✅";

            } else {

                $message = "Registration failed.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Register - Job Tracker</title>

    <style>

        body {
            font-family: Arial;
            background: #f5f5f5;
        }

        .container {
            width: 400px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }

        h1 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }

        .login {
            text-align: center;
            margin-top: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>📝 Register</h1>

    <?php
    if ($message != "") {
        echo "<div class='message'>$message</div>";
    }
    ?>

    <form method="POST">

        <label>Name</label>

        <input
            type="text"
            name="name"
            required
        >

        <label>Email</label>

        <input
            type="email"
            name="email"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">
            Register
        </button>

    </form>

    <div class="login">
        Already have an account?
        <a href="login.php">Login</a>
    </div>

</div>

</body>

</html>