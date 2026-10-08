<?php

require __DIR__ . '/../includes/connection.php';

$member_id = trim($_POST['member_id'] ?? '');
$name = trim($_POST['name'] ?? '');
$address = trim($_POST['address'] ?? '');
$phone = trim($_POST['phone'] ?? '');

if ($member_id === '' || $name === '') {
    die('Data tidak valid.');
}

$stmt = $pdo->prepare(
    "INSERT INTO members(member_id, name, address, phone)
     VALUES (:member_id, :name, :address, :phone)
     RETURNING id"
);

$stmt->execute([
    'member_id' => $member_id,
    'name' => $name,
    'address' => $address,
    'phone' => $phone,
]);

session_start();

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Member berhasil ditambahkan.'
];

header('Location: list.php');
exit;