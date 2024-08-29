<?php
session_start();

$valid_username = 'admin';
$valid_password = md5('Icorrectpassword+&&');

$max_attempts = 3;
$lockout_duration = 20 * 60;


if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (!isset($_SESSION['lockout_time'])) {
    $_SESSION['lockout_time'] = 0;
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (time() < $_SESSION['lockout_time']) {
        $error_message = 'You have been locked out. Please try again later.';
    } else {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if ($username === $valid_username && $password === $valid_password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['login_attempts'] = 0; 
            header("Location: resultsShow.php");
            exit();
        } else {
            $_SESSION['login_attempts']++;

            if ($_SESSION['login_attempts'] >= $max_attempts) {
                $_SESSION['lockout_time'] = time() + $lockout_duration;
                $error_message = 'Too many incorrect attempts. Please try again in 20 minutes.';
            } else {
                $error_message = 'Incorrect username or password. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>

        @keyframes flash-red {
            0%, 100% {
                border-color: red;
            }
            50% {
                border-color: transparent;
            }
        }

        input[type="text"].error,
        input[type="password"].error {
            animation: flash-red 0.5s ease-in-out 3;
            border-color: red;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="login-modal" style="display: block;">
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required class="<?= !empty($error_message) ? 'error' : '' ?>">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required class="<?= !empty($error_message) ? 'error' : '' ?>">
            
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($error_message)): ?>
            <p class="error-message"><?= $error_message ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
