<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Uppgifter</title>
    <link rel="stylesheet" href="Calculator.css">
</head>
<body>

    <!-- Uppgift 2: Antal tecken i strängen -->
    <?php
    $text = "tomosarts future crypto site";
    echo "<h3>Uppgift 2: Antal tecken i strängen</h3>";
    echo "Antal tecken i strängen är: " . strlen($text) . "<br>";
    ?>

    <!-- Uppgift 3: Byt ut ordet "future" mot "PAST" -->
    <?php
    $updatedText = str_replace("future", "PAST", $text);
    echo "<h3>Uppgift 3: Byt ut ordet 'future' mot 'PAST'</h3>";
    echo $updatedText . "<br>";
    ?>

    <!-- Uppgift 4: Jämför två strängar -->
    <?php
    $str1 = "Future";
    $str2 = "future";
    echo "<h3>Uppgift 4: Jämför två strängar</h3>";
    if (strcasecmp($str1, $str2) == 0) {
        echo "Strängarna är lika.<br>";
    } else {
        echo "Strängarna är inte lika.<br>";
    }
    ?>

    <!-- Uppgift 5: Läs innehållet i filen tomosarts.txt -->
    <?php
    $filename = "tomosarts.txt";
    echo "<h3>Uppgift 5: Läs innehållet i filen tomosarts.txt</h3>";
    if (file_exists($filename)) {
        $content = file_get_contents($filename);
        echo nl2br($content) . "<br>";
    } else {
        echo "Filen existerar inte.<br>";
    }
    ?>

    <!-- Uppgift 6: Formulär för att skriva in namn -->
    <h3>Uppgift 6: Formulär för att skriva in namn</h3>
    <form method="POST">
        <label for="name">Namn:</label>
        <input type="text" id="name" name="name">
        <input type="submit" value="Skicka">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {
        $name = htmlspecialchars($_POST["name"]);
        echo "Hej, " . $name . "!<br>";
    }
    ?>

    <!-- Uppgift 7: Switch-sats för att skriva ut aktivitet beroende på dagen -->
    <?php
    $day = "Monday";
    echo "<h3>Uppgift 7: Switch-sats för att skriva ut aktivitet beroende på dagen</h3>";
    switch($day) {
        case "Monday":
            echo "Start the week with a workout in the Gym.<br>";
            break;
        case "Tuesday":
            echo "Attend a yoga class.<br>";
            break;
        case "Wednesday":
            echo "Go for a mid-week run.<br>";
            break;
        case "Thursday":
            echo "Join a cycling group.<br>";
            break;
        case "Friday":
            echo "Relax with some meditation.<br>";
            break;
        case "Saturday":
            echo "Hike in the mountains.<br>";
            break;
        case "Sunday":
            echo "Rest and recover.<br>";
            break;
        default:
            echo "Unknown day.<br>";
    }
    ?>

    <!-- Uppgift 8: Sortera en array och skriv ut den -->
    <?php
    $numbers = [4, 2, 8, 1, 9];
    sort($numbers);
    echo "<h3>Uppgift 8: Sortera en array</h3>";
    echo "Sorterad array: " . implode(", ", $numbers) . "<br>";
    ?>

    <!-- Uppgift 9 och 10: Formulär för namn, ålder och kalkylator -->
    <h3>Uppgift 9: Formulär för namn och ålder</h3>
    <form method="POST">
        <label for="name_age">Namn:</label>
        <input type="text" id="name_age" name="name_age"><br>
        <label for="age">Ålder:</label>
        <input type="text" id="age" name="age"><br>
        <input type="submit" value="Skicka">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name_age"]) && isset($_POST["age"])) {
        $name = htmlspecialchars($_POST["name_age"]);
        $age = htmlspecialchars($_POST["age"]);
        echo "Namn: " . $name . "<br>";
        echo "Ålder: " . $age . "<br>";
    }
    ?>

    <h3>Uppgift 10: Kalkylator</h3>
    <form method="POST">
        <label for="num1">Nummer 1:</label>
        <input type="number" id="num1" name="num1"><br>
        <label for="num2">Nummer 2:</label>
        <input type="number" id="num2" name="num2"><br>
        <label for="operation">Operation:</label>
        <select id="operation" name="operation">
            <option value="addition">Addition</option>
            <option value="subtraction">Subtraktion</option>
            <option value="multiplication">Multiplikation</option>
            <option value="division">Division</option>
        </select><br>
        <input type="submit" value="Beräkna">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["num1"]) && isset($_POST["num2"]) && isset($_POST["operation"])) {
        $num1 = (float) $_POST["num1"];
        $num2 = (float) $_POST["num2"];
        $operation = $_POST["operation"];
        $result = "";

        switch($operation) {
            case "addition":
                $result = $num1 + $num2;
                break;
            case "subtraction":
                $result = $num1 - $num2;
                break;
            case "multiplication":
                $result = $num1 * $num2;
                break;
            case "division":
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = "Division by zero is not allowed.";
                }
                break;
            default:
                $result = "Invalid operation.";
        }

        echo "Resultatet är: " . $result . "<br>";
    }
    ?>
</body>
</html>
