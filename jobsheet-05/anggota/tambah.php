<?php
$page_title = "Add Member";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
  <section>
    <h2>Add Member</h2>
    <?php if ($flash): ?>
      <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
    <?php endif; ?>
    <form id="form-tambah" method="post" action="proses_tambah.php">
      <label for="nim">Student ID (NIM)</label>
      <input type="text" id="nim" name="nim" required>
      <label for="nama">Full Name</label>
      <input type="text" id="nama" name="nama" required>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
      <label for="telepon">Phone</label>
      <input type="text" id="telepon" name="telepon">
      <label for="prodi">Study Program</label>
      <input type="text" id="prodi" name="prodi">
      <button type="submit">Save</button>
    </form>
  </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
