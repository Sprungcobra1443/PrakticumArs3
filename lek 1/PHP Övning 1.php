<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PHP Övning 1</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

    <?php
    $myschool = "Prakticum";
    $heltal = 4;
    $decimaltal = 2.5;
    ?>

        <p><?php echo $myschool; ?></p>
        <p><?php echo "$heltal * $decimaltal = " . ($heltal * $decimaltal); ?></p>
        <p><?php echo '<a href="https://www.prakticum.fi/">Besök Prakticum</a>'; ?></p>
    </body>
</html>