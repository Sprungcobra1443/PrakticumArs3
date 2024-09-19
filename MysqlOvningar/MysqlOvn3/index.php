<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1>To-Do List</h1>
    <?php
        echo '<button onclick="window.location.href=\'create.php\'">Go to create</button> <p></p>';
    ?>

    <?php
    // Connection setup
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

    // Fetch all to-do items
    $sql = "SELECT * FROM todos ORDER BY due_date ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="table-container">';
        echo '<div class="table-header">';
        echo '<div>ID</div>';
        echo '<div>Title</div>';
        echo '<div>Description</div>';
        echo '<div>Due Date</div>';
        echo '<div>Status</div>';
        echo '<div>Created At</div>';
        echo '<div>Actions</div>';
        echo '</div>';
    
        // Output each row
        while ($row = $result->fetch_assoc()) {
            echo '<div class="table-row">';
            echo '<div>' . $row['id'] . '</div>';
            echo '<div>' . $row['title'] . '</div>';
            echo '<div>' . $row['description'] . '</div>';
            echo '<div>' . $row['due_date'] . '</div>';
            echo '<div>' . ucfirst($row['status']) . '</div>';
            echo '<div>' . $row['created at'] . '</div>';
            echo '<div class="actions">
                    <a href="edit.php?id=' . $row['id'] . '"><button>Edit</button></a>
                    <a href="delete.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this item?\');">
                        <button>Delete</button>
                    </a>
                  </div>';
            echo '</div>';
        }
    
        echo '</div>';
    } else {
        echo 'No to-do items found.';
    }

    // Close the connection
    $conn->close();
    ?>

</body>
</html>