<?php

require __DIR__ . '/includes/connection.php';

$totalBook = $pdo->query("SELECT COUNT(*) FROM books")->fetchColumn();
$totalAmember = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();

?>

<!DOCTYPE html>
<html>
<head>
    <title>SIMPUS Mini</title>
</head>
<body>

    <h1>SIMPUS Mini</h1>

    <p>Total Book: <?php echo $totalBook; ?></p>
    <p>Total Member: <?php echo $totalAmember; ?></p>

</body>
</html>