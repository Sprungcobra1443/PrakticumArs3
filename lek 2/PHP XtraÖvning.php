<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP Övning 2 - Utökad</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Calculator.css"> <!-- Om du vill lägga till CSS -->
</head>
<body>

    <?php
    // 2. Skapa en variabel $text och skriv ut antalet tecken i strängen
    $text = "tomosarts future crypto site";
    echo "<p>Antal tecken i strängen: " . strlen($text) . "</p>"; // Använder strlen()

    // 3. Byt ut ordet "future" mot "PAST"
    $text = str_replace("future", "PAST", $text);
    echo "<p>Uppdaterad sträng: $text</p>"; // Använder str_replace()

    // 4. Jämför två strängar och skriv ut om de är lika eller inte
    $str1 = "Future";
    $str2 = "future";
    if (strcasecmp($str1, $str2) == 0) {
        echo "<p>Strängarna är lika (case insensitive jämförelse).</p>";
    } else {
        echo "<p>Strängarna är inte lika.</p>";
    }

    // 5. Läs innehållet i en fil och skriv ut det
    $filename = "tomosarts.txt";
    if (file_exists($filename)) {
        $content = file_get_contents($filename); // Läser innehållet i filen
        echo "<pre>$content</pre>";
    } else {
        echo "<p>Filen tomosarts.txt finns inte.</p>";
    }
    ?>

    <!-- 6. Formulär för att skriva in namn -->
    <form method="POST">
        <label for="name">Skriv in ditt namn:</label>
        <input type="text" id="name" name="name">
        <button type="submit">Skicka</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
        $name = htmlspecialchars($_POST['name']); // Skyddar mot XSS
        echo "<p>Hej, $name!</p>";
    }
    ?>

    <?php
    // 7. Använd en switch-sats för att skriva ut en aktivitet beroende på dagen
    $day = "Monday"; // Exempelvärde
    switch ($day) {
        case "Monday":
            echo "<p>Start the week with a workout in the Gym.</p>";
            break;
        case "Tuesday":
            echo "<p>Take a yoga class.</p>";
            break;
        case "Wednesday":
            echo "<p>Go for a run in the park.</p>";
            break;
        case "Thursday":
            echo "<p>Join a dance class.</p>";
            break;
        case "Friday":
            echo "<p>Play a game of tennis.</p>";
            break;
        case "Saturday":
            echo "<p>Go hiking in the mountains.</p>";
            break;
        case "Sunday":
            echo "<p>Rest and relax at home.</p>";
            break;
        default:
            echo "<p>Ogiltig dag.</p>";
            break;
    }

    // 8. Skapa och sortera en array
    $numbers = array(4, 2, 8, 1, 9);
    sort($numbers); // Sorterar arrayen i stigande ordning
    echo "<p>Sorterade nummer: " . implode(", ", $numbers) . "</p>";
    ?>

    <!-- 9. Formulär för att skriva in namn och ålder -->
    <form method="POST">
        <label for="username">Skriv in ditt namn:</label>
        <input type="text" id="username" name="username">
        <label for="age">Skriv in din ålder:</label>
        <input type="number" id="age" name="age">
        <button type="submit">Skicka</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['age'])) {
        $username = htmlspecialchars($_POST['username']); // Skyddar mot XSS
        $age = htmlspecialchars($_POST['age']);
        echo "<p>Namn: $username, Ålder: $age</p>";
    }
    ?>

    <!-- 10. Kalkylator med formulär -->
    <form method="POST">
        <label for="num1">Nummer 1:</label>
        <input type="number" id="num1" name="num1" required>
        <label for="num2">Nummer 2:</label>
        <input type="number" id="num2" name="num2" required>
        <label for="operation">Välj operation:</label>
        <select id="operation" name="operation">
            <option value="add">Addition</option>
            <option value="subtract">Subtraktion</option>
            <option value="multiply">Multiplikation</option>
            <option value="divide">Division</option>
        </select>
        <button type="submit">Beräkna</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operation'])) {
        $num1 = (float)$_POST['num1'];
        $num2 = (float)$_POST['num2'];
        $operation = $_POST['operation'];
        $result = 0;

        switch ($operation) {
            case "add":
                $result = $num1 + $num2;
                break;
            case "subtract":
                $result = $num1 - $num2;
                break;
            case "multiply":
                $result = $num1 * $num2;
                break;
            case "divide":
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    echo "<p>Fel: Division med 0 är inte tillåtet.</p>";
                    exit;
                }
                break;
        }
        echo "<p>Resultat: $result</p>";
    }
    ?>

</body>
</html>
