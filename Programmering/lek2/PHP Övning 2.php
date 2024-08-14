
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PHP Övning 2</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

    <?php
$i = 3;
$kalle = "kodare"; 
$x = 5; 
$today = date("D"); 

if ($i >= 2) {
    echo "<p>i är större eller lika med 2.</p>";
}

if ($kalle == "kodare") {
    $yrke = "Kalle är kodare.";
} elseif ($kalle == "svetsare") {
    $yrke = "Kalle är svetsare.";
} elseif ($kalle == "kock") {
    $yrke = "Kalle är kock.";
} else {
    $yrke = "Vet inte vad Kalle gör.";
}
echo "<p>$yrke</p>";

switch ($kalle) {
    case "kodare":
        $yrke = "Kalle är kodare.";
        break;
    case "svetsare":
        $yrke = "Kalle är svetsare.";
        break;
    case "kock":
        $yrke = "Kalle är kock.";
        break;
    default:
        $yrke = "Vet inte vad Kalle gör.";
        break;
}
echo "<p>$yrke</p>";

if ($x > 2 && $x < 10) {
    echo "<p>x är större än 2 och mindre än 10.</p>";
}

echo "<p>Idag är det: $today</p>";

if ($today == 'Mon') {
    echo "<p>Idag är det måndag.</p>";
} elseif ($today == 'Tue') {
    echo "<p>Idag är det tisdag.</p>";
} elseif ($today == 'Wed') {
    echo "<p>Idag är det onsdag.</p>";
} elseif ($today == 'Thu') {
    echo "<p>Idag är det torsdag.</p>";
} elseif ($today == 'Fri') {
    echo "<p>Idag är det fredag.</p>";
} elseif ($today == 'Sat') {
    echo "<p>Idag är det lördag.</p>";
} elseif ($today == 'Sun') {
    echo "<p>Idag är det söndag.</p>";
} else {
    echo "<p>Ogiltigt värde.</p>";
}
?>
        
    </body>
</html>
