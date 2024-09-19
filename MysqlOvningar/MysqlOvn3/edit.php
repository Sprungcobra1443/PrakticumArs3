<?php
$servername = "localhost";
$username = "root";  // Adjust if needed
$password = "";      // Adjust if needed
$dbname = "todouser";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    // SQL query to update data
    $sql = "UPDATE todos SET 
            title='$title', 
            description='$description', 
            due_date='$due_date', 
            status='$status' 
            WHERE id=$id";
    
    // Execute the query and check if successful
    if ($conn->query($sql) === TRUE) {
        echo "To-Do item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit To-Do Item</title>
    <link rel="stylesheet" href="styles.css">
    <script src="tinymce_7.3.0\tinymce\js\tinymce\tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

    <h1>Edit To-Do Item</h1>

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

    // Get the to-do item by id
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM todos WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "No To-Do item found with ID: $id";
            exit();
        }
    } else {
        echo "No ID provided. Please return to index <p>\n</p>";
        echo '<button onclick="window.location.href=\'index.php\'">Go to Home</button>';
        exit();
    }
    ?>

    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" maxlength="30" value="<?php echo $row['title']; ?>" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="basic-example" name="description"><?php echo $row['description']; ?></textarea><br><br>

        <label for="due_date">Due Date:</label><br>
        <input type="date" id="due_date" name="due_date" value="<?php echo $row['due_date']; ?>" required><br><br>

        <label for="status">Priority Status:</label><br>
        <select id="status" name="status">
            <option value="low" <?php if($row['status'] == 'low') echo 'selected'; ?>>Low</option>
            <option value="medium" <?php if($row['status'] == 'medium') echo 'selected'; ?>>Medium</option>
            <option value="high" <?php if($row['status'] == 'high') echo 'selected'; ?>>High</option>
        </select><br><br>

        <button type="submit">Update To-Do</button>
    </form>
    <button onclick="window.location.href='index.php'">Go to Home</button>
    <script>
        tinymce.init({
            selector: 'textarea#basic-example',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});
    </script>
</body>
</html>