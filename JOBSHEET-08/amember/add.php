<?php
// amember/add.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Member</title>
</head>
<body>
    <h2>Add New Member</h2>

    <form action="process_add.php" method="POST">
        <label>Member ID:</label><br>
        <input type="text" name="member_id" required><br><br>

        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Address:</label><br>
        <input type="text" name="address"><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone"><br><br>

        <button type="submit">Add Member</button>
    </form>
</body>
</html>