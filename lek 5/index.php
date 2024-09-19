<?php
include 'db_connect.php';

$sql = "SELECT first_name, last_name FROM employees WHERE start_date BETWEEN '2006-01-01' AND '2009-12-31'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["first_name"] . " " . $row["last_name"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "0 results";
}

$conn->close();
?>
