<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How It Works - Job Tracker</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            background: #f7f8ff;
        }

        .view-demo-button {
    position: absolute;

    left: 8%;
    top: 80%;

    width: 30%;
    height: 11%;

    display: block;

    background: transparent;
    border: none;

    cursor: pointer;

    z-index: 999;
}

       .how-it-works {
    position: relative;
    width: 100vw;
    height: 100vh;

    display: flex;
    justify-content: center;
    align-items: center;
}

        .how-it-works img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }
    </style>
</head>

<body>

<div class="how-it-works">
    <img src="pics/steps2.png" alt="How It Works">

     <a href="login.php" class="view-demo-button"></a>
</div>

</body>
</html>