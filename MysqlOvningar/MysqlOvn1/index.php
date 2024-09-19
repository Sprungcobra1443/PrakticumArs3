<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Include the database connection file
include 'db_connect.php';

// Write a query to fetch data from a specific table
$sql = "SELECT * FROM employees"; // Replace 'your_table_name' with your actual table name

// Execute the query
$result = $conn->query($sql);

// Check if there are results and display them in a table
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";

    // Fetch the field names (table headers)
    while ($field_info = $result->fetch_field()) {
        echo "<th>" . $field_info->name . "</th>";
    }

    echo "</tr>";

    // Fetch the data rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $data) {
            echo "<td>" . $data . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
</body>
</html> 
