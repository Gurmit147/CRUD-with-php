<?php
include 'connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM notes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $note = $result->fetch_assoc();

    if (!$note) {
        echo "<p>Note not found!</p>";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE notes SET title = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $id);

    if ($stmt->execute()) {
        header("Location: viewnote.php");
        exit;
    } else {
        echo "<p style='color:red;'>Error updating note: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Note</title>
</head>
<body>
    <div id="container">
        <form action="editnote.php" method="POST">
            <h1>Edit Note</h1>
            
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($note['id'] ?? ''); ?>">
            
            <label for="note-title">Title:</label><br>
            <input type="text" id="note-title" name="title" value="<?php echo htmlspecialchars($note['title'] ?? ''); ?>" required><br><br>
            
            <label for="note-content">Content:</label><br>
            <textarea id="note-content" name="content" rows="4" cols="50" required><?php echo htmlspecialchars($note['content'] ?? ''); ?></textarea><br><br>
            
            <input type="submit" value="Save Note">
        </form>

    </div>
</body>
</html>
