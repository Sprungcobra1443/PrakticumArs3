<?php
// conn to databse
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "crud_kontakter";

// create conn
$conn = new mysqli($servername, $username, $password, $dbname);

// check conn
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// add member
if (isset($_POST['add'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO members (firstname, lastname, birthday, phone, email) VALUES ('$firstname', '$lastname', '$birthday', '$phone', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Ny medlem tillagd!";
    } else {
        echo "Fel: " . $sql . "<br>" . $conn->error;
    }
}

//update member
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE members SET firstname='$firstname', lastname='$lastname', birthday='$birthday', phone='$phone', email='$email' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Medlem uppdaterad!";
    } else {
        echo "Fel: " . $sql . "<br>" . $conn->error;
    }
}

// delete member
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM members WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Medlem raderad!";
    } else {
        echo "Fel: " . $sql . "<br>" . $conn->error;
    }
}

// get all data
$sql = "SELECT * FROM members";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>CRUD för Medlemmar</title>
</head>
<body>
    <h2>Lägg till ny medlem</h2>
    <form method="POST" action="">
        <input type="text" name="firstname" placeholder="Förnamn" required>
        <input type="text" name="lastname" placeholder="Efternamn" required>
        <input type="date" name="birthday" placeholder="Födelsedag" required>
        <input type="text" name="phone" placeholder="Telefonnummer" required>
        <input type="email" name="email" placeholder="E-post" required>
        <button type="submit" name="add">Lägg till</button>
    </form>

    <h2>Medlemslista</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Förnamn</th>
            <th>Efternamn</th>
            <th>Födelsedag</th>
            <th>Telefonnummer</th>
            <th>E-post</th>
            <th>Åtgärder</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['birthday']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="?edit=<?php echo $row['id']; ?>">Redigera</a>
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Är du säker på att du vill radera den här medlemmen?');">Radera</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php
    //if edit clicked open edit menu
    if (isset($_GET['edit'])):
        $id = $_GET['edit'];
        $sql = "SELECT * FROM members WHERE id='$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <h2>Redigera medlem</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" required>
        <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" required>
        <input type="date" name="birthday" value="<?php echo $row['birthday']; ?>" required>
        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
        <button type="submit" name="update">Uppdatera</button>
    </form>
    <?php endif; ?>

</body>
</html>

<?php
// close connection
$conn->close();
?>