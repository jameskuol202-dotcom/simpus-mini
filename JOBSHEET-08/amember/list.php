<?php

require __DIR__ . '/../includes/connection.php';

$daftarMember = $pdo->query("SELECT * FROM members ORDER BY id DESC")
    ->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Member List</title>
</head>
<body>

    <h2>Member List</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Member ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>

        <?php foreach ($daftarMember as $member) : ?>
        <tr>
            <td><?php echo $member['id']; ?></td>
            <td><?php echo $member['member_id']; ?></td>
            <td><?php echo $member['name']; ?></td>
            <td><?php echo $member['address']; ?></td>
            <td><?php echo $member['phone']; ?></td>
        </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>