<?php
include 'connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM notes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notes</title>
    <link rel="stylesheet" href="css/viewnote.css">
   
    
</head>
<body>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Title</th><th>Content</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row['content'])) . "</td>";
            echo "<td>
                    <a href='editnote.php?id=" . $row['id'] . "' class='action-btn edit-btn'>Edit</a>
                    <a href='deletenote.php?id=" . $row['id'] . "' class='action-btn delete-btn' >Delete</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No notes found.</p>";
    }
    ?>

    <a href="index.php" class="back-btn">Back</a>
</body>
</html>

<?php
$conn->close();
?>
