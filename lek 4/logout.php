<?php
session_start();
session_destroy();
header("Location: RatingPHPProject.php");
exit();
?>
