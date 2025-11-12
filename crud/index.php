<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Note App</title>
</head>
<body>
    <div id="container">
    <form action="createnote.php" method="POST">
        <h1>Create Note</h1>
        <label for="note-title">Title:</label><br>
        <input type="text" id="note-title" name="title" ><br><br>
        
        <label for="note-content">Content:</label><br>
        <textarea id="note-content" name="content" rows="4" cols="50" ></textarea><br><br>
        
        <input type="submit" value="Save Note">
        
    </form>
    <button id="view-notes" onclick="window.location.href='viewnote.php'">View Notes</button>
</div>
</body>
</html>