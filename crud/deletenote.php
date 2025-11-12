<?php
include 'connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM notes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: viewnote.php");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>Error deleting note: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='text-align:center; color:red;'>No note ID provided.</p>";
}

$conn->close();
?>
