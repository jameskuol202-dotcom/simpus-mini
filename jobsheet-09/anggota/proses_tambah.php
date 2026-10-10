<?php
session_start();

$nim     = trim($_POST['nim'] ?? '');
$nama    = trim($_POST['nama'] ?? '');
$email   = trim($_POST['email'] ?? '');
$telepon = trim($_POST['telepon'] ?? '');
$prodi   = trim($_POST['prodi'] ?? '');

$errors = [];
if ($nim === '') {
    $errors[] = "Student ID is required.";
} elseif (!preg_match('/^[0-9]{5,15}$/', $nim)) {
    $errors[] = "Student ID must be 5-15 digits.";
} else {
    foreach ($_SESSION['anggota'] ?? [] as $a) {
        if ($a['nim'] === $nim) {
            $errors[] = "Student ID is already registered.";
            break;
        }
    }
}
if ($nama === '') {
    $errors[] = "Name is required.";
} elseif (!preg_match('/^[\p{L} .\'-]+$/u', $nama)) {
    $errors[] = "Name may only contain letters, spaces, and . ' -";
}
if ($email === '') {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email format is invalid.";
}
if ($telepon !== '' && !preg_match('/^\+?[0-9]{8,15}$/', $telepon)) {
    $errors[] = "Phone must be 8-15 digits (optional leading +).";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}
$_SESSION['anggota'][] = [
    'nim' => $nim, 'nama' => $nama, 'email' => $email,
    'telepon' => $telepon, 'prodi' => $prodi,
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Member added successfully.'];
header('Location: list.php');
exit;
