<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RatingPHPProject</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Give us a rating</h1>
        <button id="dark-mode-toggle">Toggle Dark Mode</button>
    </header>

    <main>
        <form id="rating-form">
            <div class="gender-selection">
                <label>
                    <input type="radio" name="gender" value="Male" required> Male
                </label>
                <label>
                    <input type="radio" name="gender" value="Female" required> Female
                </label>
                <label>
                    <input type="radio" name="gender" value="Other" required> Other
                </label>
            </div>

            <div class="image-row">  
                <div class="image-container">
                    <img src="Assets/PHPRating11.png" alt="Very Good" class="hover-image" 
                         data-original-src="Assets/PHPRating11.png"
                         data-light-hover="Assets/PHPRating10.png"
                         data-dark-hover="Assets/PHPRating09.png"
                         data-value="Very Good">
                </div>
                <div class="image-container">
                    <img src="Assets/PHPRating02.png" alt="Good" class="hover-image" 
                         data-original-src="Assets/PHPRating02.png"
                         data-light-hover="Assets/PHPRating01.png"
                         data-dark-hover="Assets/PHPRating00.png"
                         data-value="Good">
                </div>
                <div class="image-container">
                    <img src="Assets/PHPRating05.png" alt="Neutral" class="hover-image" 
                         data-original-src="Assets/PHPRating05.png"
                         data-light-hover="Assets/PHPRating04.png"
                         data-dark-hover="Assets/PHPRating03.png"
                         data-value="Neutral">
                </div>
                <div class="image-container">
                    <img src="Assets/PHPRating08.png" alt="Bad" class="hover-image" 
                         data-original-src="Assets/PHPRating08.png"
                         data-light-hover="Assets/PHPRating07.png"
                         data-dark-hover="Assets/PHPRating06.png"
                         data-value="Bad">
                </div>
                <div class="image-container">
                    <img src="Assets/PHPRating14.png" alt="Very Bad" class="hover-image" 
                         data-original-src="Assets/PHPRating14.png"
                         data-light-hover="Assets/PHPRating13.png"
                         data-dark-hover="Assets/PHPRating12.png"
                         data-value="Very Bad">
                </div>
            </div>

            <input type="hidden" name="selected_image" id="selected-image" required>

            <button type="submit">Submit</button>
        </form>

        <button id="check-results-btn">Login</button>

        <div class="credentials">
            <p>Username: admin </p>
            <p>Password: Icorrectpassword+&&</p>
        </div>

    </main>

    <div id="login-modal" style="display: none;">
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const darkModeToggle = document.getElementById('dark-mode-toggle');
            const body = document.body;

            const darkMode = localStorage.getItem('darkMode') === 'enabled';
            if (darkMode) {
                body.classList.add('dark-mode');
            }
            updateHoverImages(darkMode ? 'dark-mode' : 'light-mode');

            darkModeToggle.addEventListener('click', function() {
                const isDarkMode = body.classList.toggle('dark-mode');
                if (isDarkMode) {
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    localStorage.removeItem('darkMode');
                }
                updateHoverImages(isDarkMode ? 'dark-mode' : 'light-mode');
            });
        });

        function updateHoverImages(mode) {
            document.querySelectorAll('.hover-image').forEach(img => {
                img.src = img.getAttribute('data-original-src'); 
                img.setAttribute('data-hover', mode === 'dark-mode' ? img.getAttribute('data-dark-hover') : img.getAttribute('data-light-hover'));
            });
        }

        document.getElementById('rating-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('submit_ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Submission successful!');
                document.getElementById('rating-form').reset();
            })
            .catch(error => {
                alert('There was an error with your submission. Please try again.');
            });
        });

        document.getElementById('check-results-btn').addEventListener('click', function() {
            document.getElementById('login-modal').style.display = 'block';
        });

        const hoverAudio = new Audio('Coin Pick Up - Sound Effect - 2017.mp3');

        document.querySelectorAll('.hover-image').forEach(img => {
        const originalSrc = img.src;

        img.addEventListener('mouseover', function() {
        if (!this.classList.contains('hovered')) {
         this.src = this.getAttribute('data-hover');
            this.style.transform = 'scale(2)';
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
                this.style.transform = 'scale(2)';
                this.classList.add('hovered');

                document.getElementById('selected-image').value = this.getAttribute('data-value');
            });

            img.setAttribute('data-original-src', originalSrc);
        });
    </script>
</body>
</html>
