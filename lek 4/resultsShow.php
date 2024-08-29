<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "You must log in to view this page.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results Show</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 80%;
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .mood-images {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .mood-images .image-item {
            text-align: center;
        }

        .mood-images img {
            width: 128px;
            height: 128px;
            display: block;
            margin: 0 auto;
        }

        .results {
            margin-top: 20px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        #show-chart-btn, #export-pdf-btn {
            padding: 10px 20px;
            background-color: #000000;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        #show-chart-btn:hover, #export-pdf-btn:hover {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
        }

        #chart-container {
            display: none;
            margin-top: 20px;
            text-align: center;
        }

        img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
        }

        .logout {
            margin-top: 20px;
            text-align: center;
        }

        .logout a {
            text-decoration: none;
            color: #ffffff;
            background-color: #000000;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Results</h1>

        <div class="mood-images">
            <div class="image-item">
                <img src="Assets/PHPRating11.png" alt="Very Good" class="hover-image" 
                     data-original-src="Assets/PHPRating11.png"
                     data-light-hover="Assets/PHPRating10.png"
                     data-dark-hover="Assets/PHPRating10.png">
                     <p> Very Good </p>
            </div>
            <div class="image-item">
                <img src="Assets/PHPRating02.png" alt="Good" class="hover-image" 
                     data-original-src="Assets/PHPRating02.png"
                     data-light-hover="Assets/PHPRating01.png"
                     data-dark-hover="Assets/PHPRating01.png">
                     <p> Good </p>
            </div>
            <div class="image-item">
                <img src="Assets/PHPRating05.png" alt="Neutral" class="hover-image" 
                     data-original-src="Assets/PHPRating05.png"
                     data-light-hover="Assets/PHPRating04.png"
                     data-dark-hover="Assets/PHPRating04.png">
                     <p> Neutral </p>
            </div>
            <div class="image-item">
                <img src="Assets/PHPRating08.png" alt="Bad" class="hover-image" 
                     data-original-src="Assets/PHPRating08.png"
                     data-light-hover="Assets/PHPRating07.png"
                     data-dark-hover="Assets/PHPRating07.png">
                     <p> Bad </p>
            </div>
            <div class="image-item">
                <img src="Assets/PHPRating14.png" alt="Very Bad" class="hover-image" 
                     data-original-src="Assets/PHPRating14.png"
                     data-light-hover="Assets/PHPRating13.png"
                     data-dark-hover="Assets/PHPRating13.png">
                     <p> Very Bad </p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gender</th>
                    <th>Mood</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $results = file('results.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $id = 1;
                foreach ($results as $result) {
                    list($gender, $mood, $timestamp) = explode(',', $result);
                    echo "<tr>
                            <td>$id</td>
                            <td>$gender</td>
                            <td>$mood</td>
                            <td>$timestamp</td>
                          </tr>";
                    $id++;
                }
                ?>
            </tbody>
        </table>

        <button id="show-chart-btn" onclick="openChart()">Show Chart</button>
        <form action="exportPDF.php" method="post" style="display: inline;">
            <button type="submit" id="export-pdf-btn" class="button">Export to PDF</button>
        </form>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const darkMode = localStorage.getItem('darkMode') === 'enabled';
            updateHoverImages(darkMode ? 'dark-mode' : 'light-mode');

            document.getElementById('dark-mode-toggle')?.addEventListener('click', function() {
                const isDarkMode = document.body.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
                updateHoverImages(isDarkMode ? 'dark-mode' : 'light-mode');
            });
        });

        function updateHoverImages(mode) {
            document.querySelectorAll('.hover-image').forEach(img => {
                img.src = img.getAttribute('data-original-src');
                img.setAttribute('data-hover', mode === 'dark-mode' ? img.getAttribute('data-dark-hover') : img.getAttribute('data-light-hover'));
            });
        }

        const hoverAudio = new Audio('Coin Pick Up - Sound Effect - 2017.mp3');

        document.querySelectorAll('.hover-image').forEach(img => {
         const originalSrc = img.src;

            img.addEventListener('mouseover', function() {
                if (!this.classList.contains('hovered')) {
                 this.src = this.getAttribute('data-hover');
                    this.style.transform = 'scale(1)';
                    hoverAudio.currentTime = 0;
                    hoverAudio.play(); 
             }
            });

            img.addEventListener('mouseout', function() {
                if (!this.classList.contains('hovered')) {
                    this.src = originalSrc;
                    this.style.transform = 'scale(1)';
                }
            });

            img.addEventListener('click', function() {
                document.querySelectorAll('.hover-image').forEach(otherImg => {
                    otherImg.src = otherImg.getAttribute('data-original-src');
                    otherImg.style.transform = 'scale(1)';
                    otherImg.classList.remove('hovered');
                });

                this.src = this.getAttribute('data-hover');
                this.style.transform = 'scale(1)';
                this.classList.add('hovered');
            });

            img.setAttribute('data-original-src', originalSrc);
        });

        function openChart() {
            window.open('CircleDiagram.php', 'Chart', 'width=600,height=400');
        }

        function exportPDF() {
            window.location.href = 'exportPDF.php';
        }
    </script>
</body>
</html>
