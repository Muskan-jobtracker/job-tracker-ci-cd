<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Tracker Application</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 150%;
            height: 150%;
            overflow: hidden;
        }

        body {
            background: #f7f8ff;
        }

        .landing-page {
            position: relative;
            width: 100vw;
            height: 100vh;
        }

        .landing-page img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        /* REAL clickable button */
       /* Clickable Get Started area */
.get-started-button {
    position: absolute;

    left: 25.2%;
    top: 70%;

    width: 18.5%;
    height: 10%;

    display: block;

    background: transparent;
    border: none;

    cursor: pointer;

    z-index: 999;
}

        /* TESTING ONLY */
        .get-started-button:hover {
            background: rgba(0, 0, 255, 0.10);
            border-radius: 25px;
        }
    </style>
</head>

<body>

<div class="landing-page">

    <img src="pics/getstart2.png" alt="Job Tracker">

   <a href="steps.php" class="get-started-button"></a>

   

</div>

</body>
</html>
