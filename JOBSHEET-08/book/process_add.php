<?php

require __DIR__ . '/../includes/connection.php';

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$year = trim($_POST['year'] ?? '');

if ($title === '' || $author === '' || !is_numeric($year)) {
    die('Data tidak valid.');
}

$stmt = $pdo->prepare(
    "INSERT INTO books(title, author, year)
     VALUES (:title, :author, :year)
     RETURNING id"
);

$stmt->execute([
    'title' => $title,
    'author' => $author,
    'year' => (int) $year,
]);

session_start();

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Book berhasil ditambahkan.'
];

header('Location: list.php');
exit;