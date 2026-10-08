<?php

require __DIR__ . '/../includes/connection.php';

$daftarBook = $pdo->query("SELECT * FROM books ORDER BY id DESC")
    ->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
</head>
<body>
    <h2>Book List</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
        </tr>

        <?php foreach ($daftarBook as $book) : ?>
        <tr>
            <td><?php echo $book['id']; ?></td>
            <td><?php echo $book['title']; ?></td>
            <td><?php echo $book['author']; ?></td>
            <td><?php echo $book['year']; ?></td>
        </tr>
        <?php endforeach; ?>

    </table>
</body>
</html>