<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <script src="tinymce_7.3.0\tinymce\js\tinymce\tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
<h1>Add a New To-Do Item</h1>
    <form action="create.php" method="post">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" maxlength="30" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="basic-example" name="description"></textarea><br><br>
        
        <label for="due_date">Due Date:</label><br>
        <input type="date" id="due_date" name="due_date" required><br><br>
        
        <label for="status">Priority Status:</label><br>
        <select id="status" name="status">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select><br><br>
        
        <button type="submit">Add To-Do</button>
    </form>

    <?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "todouser";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    // SQL query to insert data
    $sql = "INSERT INTO todos (title, description, due_date, status)
            VALUES ('$title', '$description', '$due_date', '$status')";
    
    // Execute the query and check if successful
    if ($conn->query($sql) === TRUE) {
        echo "New To-Do item added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
<?php
echo '<p></p>';
echo '<button onclick="window.location.href=\'index.php\'">Go to Home</button>';
?>
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