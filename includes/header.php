<?php
session_start();

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
</head>
<body>

<header>
    <h1>SIMPUS-Mini</h1>

    <nav>
        <ul>
            <li><a href="<?php echo $base; ?>index.php">Home</a></li>
            <li><a href="<?php echo $base; ?>book/list.php">Book List</a></li>
            <li><a href="<?php echo $base; ?>book/add.php">Add Book</a></li>
            <li><a href="<?php echo $base; ?>amember/list.php">Member List</a></li>
            <li><a href="<?php echo $base; ?>amember/add.php">Add Member</a></li>
        </ul>
    </nav>
</header>

<main>