<?php
session_start();

// 1. Gästbok
$messages = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = htmlspecialchars($_POST['message']);
    file_put_contents('guestbook.txt', $message . "\n", FILE_APPEND);
    $messages = file_exists('guestbook.txt') ? file('guestbook.txt') : [];
}

// 2. Dynamisk Dropdown-meny
$background_color = isset($_POST['color']) ? htmlspecialchars($_POST['color']) : '#FFFFFF';

// 3. Enkel Inloggning
$correct_username = "admin";
$correct_password = "password123";
$login_error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == $correct_username && $password == $correct_password) {
        $login_message = "Inloggning lyckades! Välkommen, " . htmlspecialchars($username) . "!";
    } else {
        $login_error = "Fel användarnamn eller lösenord!";
    }
}

// 4. Dynamisk Lista
$list = isset($_POST['list']) ? $_POST['list'] : [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item'])) {
    $item = htmlspecialchars($_POST['item']);
    $list[] = $item;
}

// 5. Enkel Räknare med Session
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['increment'])) {
    $_SESSION['counter']++;
}

// 6. Filuppladdning
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploaded_files'])) {
    $uploads_dir = 'uploads/';
    foreach ($_FILES['uploaded_files']['error'] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['uploaded_files']['tmp_name'][$key];
            $name = basename($_FILES['uploaded_files']['name'][$key]);
            move_uploaded_file($tmp_name, $uploads_dir . $name);
        }
    }
}

// 7. Enkel Kalkylator med Sessionshantering
if (!isset($_SESSION['calculations'])) {
    $_SESSION['calculations'] = [];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operator'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];
    $result = null;
    switch ($operator) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
            $result = $num2 != 0 ? $num1 / $num2 : 'Error';
            break;
    }
    $calculation = "$num1 $operator $num2 = $result";
    $_SESSION['calculations'][] = $calculation;
}

// 8. Formulär med lösenordsinmatning
$password_length = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
    $password_length = strlen($_POST['password']);
}

// 9. Formulär med radio-knappar
$gender = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gender'])) {
    $gender = $_POST['gender'];
}

// 10. Dropdown-lista med städer
$city = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['city'])) {
    $city = $_POST['city'];
}

// 11. Anpassad CSS för felmeddelanden
$errors = ['name' => '', 'email' => '', 'message' => ''];
$input = ['name' => '', 'email' => '', 'message' => ''];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    foreach ($input as $field => $value) {
        if (empty($_POST[$field])) {
            $errors[$field] = "Fältet " . ucfirst($field) . " är obligatoriskt.";
        } else {
            $input[$field] = htmlspecialchars($_POST[$field]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>PHP Uppgifter</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-color: <?= $background_color ?>;">
    <h1>PHP Uppgifter</h1>

    <!-- 1. Gästbok -->
    <section>
        <h2>Gästbok</h2>
        <form method="post">
            <textarea name="message" required></textarea><br>
            <button type="submit">Skicka</button>
        </form>
        <h3>Tidigare meddelanden</h3>
        <?php foreach ($messages as $msg): ?>
            <p><?= nl2br(htmlspecialchars($msg)) ?></p>
        <?php endforeach; ?>
    </section>

    <!-- 2. Dynamisk Dropdown-meny -->
    <section>
        <h2>Dynamisk Dropdown-meny</h2>
        <form method="post">
            <label for="color">Välj en färg:</label>
            <select name="color" id="color">
                <option value="#FF0000">Röd</option>
                <option value="#00FF00">Grön</option>
                <option value="#0000FF">Blå</option>
                <option value="#FFFF00">Gul</option>
                <option value="#FF00FF">Lila</option>
            </select>
            <button type="submit">Ändra Bakgrundsfärg</button>
        </form>
    </section>

    <!-- 3. Enkel Inloggning -->
    <section>
        <h2>Inloggning</h2>
        <form method="post">
            <label for="username">Användarnamn:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Lösenord:</label>
            <input type="password" name="password" id="password" required><br>
            <button type="submit">Logga in</button>
        </form>
        <?php if ($login_error): ?>
            <p class="error"><?= htmlspecialchars($login_error) ?></p>
        <?php elseif (isset($login_message)): ?>
            <p><?= htmlspecialchars($login_message) ?></p>
        <?php endif; ?>
    </section>

    <!-- 4. Dynamisk Lista -->
    <section>
        <h2>Dynamisk Lista</h2>
        <form method="post">
            <input type="text" name="item" required>
            <button type="submit">Lägg till</button>
        </form>
        <h3>Listan</h3>
        <ul>
            <?php foreach ($list as $listItem): ?>
                <li><?= htmlspecialchars($listItem) ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- 5. Enkel Räknare med Session -->
    <section>
        <h2>Räknare</h2>
        <h3><?= $_SESSION['counter'] ?></h3>
        <form method="post">
            <button type="submit" name="increment">Öka med 1</button>
        </form>
    </section>

    <!-- 6. Filuppladdning -->
    <section>
        <h2>Filuppladdning</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="uploaded_files[]" multiple required>
            <button type="submit">Ladda upp</button>
        </form>
    </section>

    <!-- 7. Enkel Kalkylator med Sessionshantering -->
    <section>
        <h2>Kalkylator</h2>
        <form method="post">
            <input type="number" name="num1" required>
            <select name="operator">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
            <input type="number" name="num2" required>
            <button type="submit">Beräkna</button>
        </form>
        <h3>Tidigare beräkningar</h3>
        <ul>
            <?php foreach ($_SESSION['calculations'] as $calc): ?>
                <li><?= htmlspecialchars($calc) ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- 8. Formulär med lösenordsinmatning -->
    <section>
        <h2>Lösenordslängd</h2>
        <form method="post">
            <label for="password">Ange lösenord:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Visa Längd</button>
        </form>
        <p>Lösenordets längd: <?= $password_length ?></p>
    </section>

    <!-- 9. Formulär med radio-knappar -->
    <section>
        <h2>Välj Kön</h2>
        <form method="post">
            <input type="radio" name="gender" value="Man" id="male" <?= $gender == 'Man' ? 'checked' : '' ?>>
            <label for="male">Man</label>
            <input type="radio" name="gender" value="Kvinna" id="female" <?= $gender == 'Kvinna' ? 'checked' : '' ?>>
            <label for="female">Kvinna</label>
            <button type="submit">Bekräfta</button>
        </form>
        <p>Valt kön: <?= htmlspecialchars($gender) ?></p>
    </section>

    <!-- 10. Dropdown-lista med städer -->
    <section>
        <h2>Välj en stad</h2>
        <form method="post">
            <select name="city">
                <option value="Stockholm">Stockholm</option>
                <option value="Göteborg">Göteborg</option>
                <option value="Malmö">Malmö</option>
                <option value="Uppsala">Uppsala</option>
                <option value="Helsingfors">Helsingfors</option>
                <option value="Åbo">Åbo</option>
                <option value="Tammerfors">Tammerfors</option>
                <option value="Uleåborg">Uleåborg</option>
                <option value="Esbo">Esbo</option>
                <option value="Vasa">Vasa</option>
            </select>
            <button type="submit">Bekräfta</button>
        </form>
        <p>Vald stad: <?= htmlspecialchars($city) ?></p>
    </section>

    <!-- 11. Anpassad CSS för felmeddelanden -->
    <section>
        <h2>Kontakta oss</h2>
        <form method="post">
            <label for="name">Namn:</label>
            <input type="text" name="name" id="name" value="<?= $input['name'] ?>">
            <span class="error"><?= $errors['name'] ?></span><br>

            <label for="email">E-post:</label>
            <input type="email" name="email" id="email" value="<?= $input['email'] ?>">
            <span class="error"><?= $errors['email'] ?></span><br>

            <label for="message">Meddelande:</label>
            <textarea name="message" id="message"><?= $input['message'] ?></textarea>
            <span class="error"><?= $errors['message'] ?></span><br>

            <button type="submit">Skicka</button>
        </form>
    </section>

</body>
</html>
