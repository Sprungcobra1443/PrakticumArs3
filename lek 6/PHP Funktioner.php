<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Funktioner</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #ffffff;
            margin-bottom: 20px;
        }
        h4 {
            color: #b0b0b0;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: bold;
            color: #b0b0b0;
        }
        .form-control {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #2c2c2c;
            color: #e0e0e0;
            border: 1px solid #444;
            border-radius: 4px;
            width: 100%;
        }
        .form-control:focus {
            background-color: #383838;
            border-color: #616161;
        }
        .form-select {
            padding: 10px;
            background-color: #2c2c2c;
            color: #e0e0e0;
            border: 1px solid #444;
            border-radius: 4px;
            width: 100%;
            margin-bottom: 10px;
        }
        .form-select:focus {
            background-color: #383838;
            border-color: #616161;
        }
        .btn {
            background-color: #000000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #730404;
        }
        p {
            background-color: #2c2c2c;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #444;
            color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Funktioner i PHP</h2>

        <!-- 1. Räkna area av en rektangel/kvadrat -->
        <h4>1. Beräkna Area</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="length" class="form-label">Längd:</label>
                <input type="number" step="any" class="form-control" id="length" name="length" required>
            </div>
            <div class="mb-3">
                <label for="width" class="form-label">Bredd:</label>
                <input type="number" step="any" class="form-control" id="width" name="width" required>
            </div>
            <button type="submit" class="btn btn-primary" name="calculate_area">Beräkna Area</button>
        </form>
        <?php
        if (isset($_POST['calculate_area'])) {
            function calculate_area($length, $width) {
                if (is_numeric($length) && is_numeric($width)) {
                    $area = $length * $width;
                    return "Area: " . number_format($area, 2) . " kvadratmeter";
                } else {
                    return "Fel: Båda värdena måste vara siffror.";
                }
            }
            echo "<p>" . calculate_area($_POST['length'], $_POST['width']) . "</p>";
        }
        ?>

        <!-- 2. Räkna medeltal -->
        <h4>2. Räkna Medeltal</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="numbers" class="form-label">Skriv kommaseparerade tal:</label>
                <input type="text" class="form-control" id="numbers" name="numbers" required>
            </div>
            <button type="submit" class="btn btn-primary" name="calculate_average">Räkna Medeltal</button>
        </form>
        <?php
        if (isset($_POST['calculate_average'])) {
            function calculate_average($numbers) {
                $numberArray = explode(",", $numbers);
                $sum = 0;
                $count = count($numberArray);

                foreach ($numberArray as $number) {
                    if (!is_numeric($number)) {
                        return "Fel: Alla värden måste vara siffror.";
                    }
                    $sum += $number;
                }

                $average = $sum / $count;
                return "<p>Medeltal: " . number_format($average, 2) . "</p>";
            }

            echo calculate_average($_POST['numbers']);
        }
        ?>

        <!-- 3. Enkel Addition -->
        <h4>3. Enkel Addition</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="num1_add" class="form-label">Tal 1:</label>
                <input type="number" step="any" class="form-control" id="num1_add" name="num1_add" required>
            </div>
            <div class="mb-3">
                <label for="num2_add" class="form-label">Tal 2:</label>
                <input type="number" step="any" class="form-control" id="num2_add" name="num2_add" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_numbers">Lägg till</button>
        </form>
        <?php
        if (isset($_POST['add_numbers'])) {
            function add($a, $b) {
                return $a + $b;
            }

            echo "<p>Summan av " . $_POST['num1_add'] . " och " . $_POST['num2_add'] . " är: " . add($_POST['num1_add'], $_POST['num2_add']) . "</p>";
        }
        ?>

        <!-- 4. Enkel Kalkylator -->
        <h4>4. Enkel Kalkylator</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="num1_calc" class="form-label">Tal 1:</label>
                <input type="number" step="any" class="form-control" id="num1_calc" name="num1_calc" required>
            </div>
            <div class="mb-3">
                <label for="num2_calc" class="form-label">Tal 2:</label>
                <input type="number" step="any" class="form-control" id="num2_calc" name="num2_calc" required>
            </div>
            <div class="mb-3">
                <label for="operation" class="form-label">Operation:</label>
                <select class="form-select" id="operation" name="operation">
                    <option value="add">Addition</option>
                    <option value="subtract">Subtraktion</option>
                    <option value="multiply">Multiplikation</option>
                    <option value="divide">Division</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="calculate_operation">Beräkna</button>
        </form>
        <div class="mt-3">
            <?php
            if (isset($_POST['calculate_operation'])) {
                $num1 = $_POST['num1_calc'];
                $num2 = $_POST['num2_calc'];
                $operation = $_POST['operation'];

                function subtract($a, $b) {
                    return $a - $b;
                }

                function multiply($a, $b) {
                    return $a * $b;
                }

                function divide($a, $b) {
                    if ($b == 0) {
                        return "Fel: Division med noll är inte tillåten.";
                    }
                    return $a / $b;
                }

                switch ($operation) {
                    case "add":
                        echo "<p>Resultat: " . add($num1, $num2) . "</p>";
                        break;
                    case "subtract":
                        echo "<p>Resultat: " . subtract($num1, $num2) . "</p>";
                        break;
                    case "multiply":
                        echo "<p>Resultat: " . multiply($num1, $num2) . "</p>";
                        break;
                    case "divide":
                        echo "<p>Resultat: " . divide($num1, $num2) . "</p>";
                        break;
                    default:
                        echo "<p>Fel: Okänd operation.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
