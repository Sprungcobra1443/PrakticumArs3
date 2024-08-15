<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PHP Övning 4</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        
    <?php

$i = 0;
while ($i < 7) {
    echo "hej på dej<br>";
    $i++;
}

$resultat = "";
$j = 0;
while ($j <= 10) {
    $resultat .= $j;
    $j++;
}
echo $resultat . "<br>";

for ($k = 0; $k < 7; $k++) {
    echo "hej på dej<br>";
}

$capital = array(
    "Finland" => "Helsingfors",
    "Sverige" => "Stockholm",
    "Japan" => "Tokyo",
    "Tyskland" => "Berlin"
);

foreach ($capital as $country => $city) {
    echo "$city är huvudstaden i $country<br>";
}

$bilar = "audi,jeep,volkswagen,ford,opel";
$bilArray = explode(",", $bilar);

foreach ($bilArray as $bil) {
    echo "$bil<br>";
}

$rad = 5;

if ($rad == 0) {
    echo "Värdet är noll<br>";
} elseif ($rad == 1) {
    echo "Endast en rad<br>";
} elseif ($rad >= 2 && $rad <= 10) {
    $m = 1;
    while ($m <= $rad) {
        echo "rad $m<br>";
        $m++;
    }
} else {
    echo "För mycket rader eller ogiltigt värde<br>";
}

$fodelsedatum = array(
    "Paul" => "14.03.1977",
    "Lisa" => "22.07.1984",
    "Anna" => "11.11.1992",
    "Erik" => "05.06.1980"
);

$manader = array(
    1 => "januari",
    2 => "februari",
    3 => "mars",
    4 => "april",
    5 => "maj",
    6 => "juni",
    7 => "juli",
    8 => "augusti",
    9 => "september",
    10 => "oktober",
    11 => "november",
    12 => "december"
);

foreach ($fodelsedatum as $namn => $datum) {
    $delar = explode(".", $datum);
    $manad = intval($delar[1]);
    $manadsnamn = $manader[$manad];  

    echo "$namn är född i $manadsnamn<br>";
}

$finlands_stader = array(
    "Helsingfors" => 601035,
    "Esbo" => 255121,
    "Tammerfors" => 216586,
    "Vanda" => 204545,
    "Åbo" => 179529
);

asort($finlands_stader);

foreach ($finlands_stader as $stad => $inv) {
    echo "$stad ($inv)<br>";
}

?>


    </body>
</html>
