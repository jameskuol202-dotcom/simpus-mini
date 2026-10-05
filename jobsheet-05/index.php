<?php
$page_title = "Home";
include __DIR__ . '/includes/header.php';
$totalBuku = count($_SESSION['buku'] ?? []);
$totalAnggota = count($_SESSION['anggota'] ?? []);
?>
  <section>
    <h2>Welcome to the Mini Library System</h2>
    <p>Manage books and members of the library.</p>
    <p>Books added this session: <strong><?php echo $totalBuku; ?></strong></p>
    <p>Members added this session: <strong><?php echo $totalAnggota; ?></strong></p>
  </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
