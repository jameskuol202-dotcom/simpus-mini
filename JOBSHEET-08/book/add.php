<?php
// book/add.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body>
    <h2>Add New Book</h2>
    <form action="process_add.php" method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Author:</label><br>
        <input type="text" name="author" required><br><br>

        <label>Year:</label><br>
        <input type="number" name="year" required><br><br>

        <button type="submit">Add Book</button>
    </form>
</body>
</html>