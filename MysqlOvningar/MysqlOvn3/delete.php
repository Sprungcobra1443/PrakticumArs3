<?php
$servername = "localhost";
$username = "root";  // Adjust if needed
$password = "";      // Adjust if needed
$dbname = "todouser";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is provided via GET request
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL query to delete the to-do item
    $sql = "DELETE FROM todos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "To-Do item deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID provided.";
}

// Close the connection
$conn->close();

// Redirect back to the list after deletion
header("Location: index.php");
exit();
?>