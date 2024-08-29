<?php
$maleCount = 0;
$femaleCount = 0;
$ratings = [
    'Very Good' => 0,
    'Good' => 0,
    'Neutral' => 0,
    'Bad' => 0,
    'Very Bad' => 0,
];

$results = file('results.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($results as $result) {
    list($gender, $rating) = explode(',', $result);
    $gender = trim(strtolower($gender));
    $rating = trim($rating);
    
    if ($gender == 'male') {
        $maleCount++;
    } elseif ($gender == 'female') {
        $femaleCount++;
    }

    if (array_key_exists($rating, $ratings)) {
        $ratings[$rating]++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratings Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="pieChart" width="400" height="400"></canvas>
    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female', 'Very Good', 'Good', 'Neutral', 'Bad', 'Very Bad'],
                datasets: [{
                    label: 'Ratings Distribution',
                    data: [<?= $maleCount ?>, <?= $femaleCount ?>, <?= implode(',', $ratings) ?>],
                    backgroundColor: [
                        '#36A2EB', 
                        '#FF6384', 
                        '#FFFFFF', 
                        '#CCCCCC', 
                        '#888888', 
                        '#444444',
                        '#000000' 
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
</body>
</html>
