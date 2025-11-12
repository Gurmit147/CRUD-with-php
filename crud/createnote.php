<?php
include 'connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO notes (title, content) VALUES ('$title', '$content')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>✅ Note saved successfully!</h2>";
        echo "<a href='index.php'>Go back</a>";
    } else {
        echo "❌ Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
