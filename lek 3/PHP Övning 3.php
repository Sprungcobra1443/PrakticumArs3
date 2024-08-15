<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PHP Övning 3</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

    <?php
        $code = array("PHP", "JavaScript", "Python", "CSS");

        echo "<h2>Programmeringsspråk:</h2>";
        foreach ($code as $language) {
            echo $language . "<br>";
        }

        $bakelser = array(
            array("Kaka", 1.50, 10),
            array("Bulle", 5.00, 4),
            array("Pirog", 2.50, 12)
        );

        echo "<h2>Bakelser:</h2>";

        printf("%-10s %-6s %-6s<br>", "Namn:", "Pris:", "Antal:");
        foreach ($bakelser as $bakelse) {

            printf("%-10s %-6.2f %-6d<br>", $bakelse[0], $bakelse[1], $bakelse[2]);
        }

        echo "<h3>Priset på bullarna är " . $bakelser[1][1] . " och antal piroger är " . $bakelser[2][2] . "</h3>";

        $antalBakelser = count($bakelser);
        echo "<h3>Antal olika bakelser: " . $antalBakelser . "</h3>";

        $totalAntal = 0;
        foreach ($bakelser as $bakelse) {
            $totalAntal += $bakelse[2];
        }
        echo "<h3>Totalt antal varor: " . $totalAntal . "</h3>";
    ?>
        
    </body>
</html>
