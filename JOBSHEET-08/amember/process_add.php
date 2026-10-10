<?php
session_start();
require __DIR__ . '/../includes/connection.php';

$member_id = trim($_POST['member_id'] ?? '');
$name      = trim($_POST['name'] ?? '');
$address   = trim($_POST['address'] ?? '');
$phone     = trim($_POST['phone'] ?? '');

$errors = [];
if ($member_id === '') {
    $errors[] = "Member ID is required.";
}
if ($name === '') {
    $errors[] = "Name is required.";
}
if ($phone !== '' && !preg_match('/^\+?[0-9]{8,15}$/', $phone)) {
    $errors[] = "Phone must be 8-15 digits (optional leading +).";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: add.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO members(member_id, name, address, phone)
     VALUES (:member_id, :name, :address, :phone)
     RETURNING id"
);

// Exercise 7.4 #1: show a tidy message when member_id violates the UNIQUE constraint
try {
    $stmt->execute([
        'member_id' => $member_id,
        'name'      => $name,
        'address'   => $address !== '' ? $address : null,
        'phone'     => $phone !== '' ? $phone : null,
    ]);
} catch (PDOException $e) {
    // 23505 = unique_violation in PostgreSQL
    if ($e->getCode() === '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Member ID is already in use, please use another one.'];
        header('Location: add.php');
        exit;
    }
    throw $e;
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Member added successfully.'];
header('Location: list.php');
exit;
