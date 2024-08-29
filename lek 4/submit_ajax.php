<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = $_POST['gender'];
    $selectedImage = $_POST['selected_image'];

    $timestamp = date("H:i, d-m-Y");

    $data = "$gender, $selectedImage, $timestamp\n";

    file_put_contents('results.txt', $data, FILE_APPEND);

    echo "Success";
}
?>
