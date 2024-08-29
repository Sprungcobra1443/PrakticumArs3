<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #000000;
            color: white;
            font-family: Arial, sans-serif;
        }

        .loading-container {
            text-align: center;
        }

        .loading-container img {
            width: 200px;
            height: 200px;
        }

        .loading-text {
            margin-top: 20px;
            font-size: 1.5rem;
        }
    </style>

</head>
<body>
    <div class="loading-container">
        <img src="Assets/LoadScreen.gif" alt="Loading...">
        <div class="loading-text">Loading, please wait...</div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'RatingPHPProject.php';
        }, 3000);
    </script>
</body>
</html>
