<?php
$page_title = "Add Book";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
  <section>
    <h2>Add Book</h2>
    <?php if ($flash): ?>
      <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
    <?php endif; ?>
    <form id="form-tambah" method="post" action="proses_tambah.php">
      <label for="judul">Title</label>
      <input type="text" id="judul" name="judul" required>
      <label for="pengarang">Author</label>
      <input type="text" id="pengarang" name="pengarang" required>
      <label for="tahun">Year</label>
      <input type="number" id="tahun" name="tahun" min="1900" max="2026" required>
      <label for="isbn">ISBN</label>
      <input type="text" id="isbn" name="isbn">
      <label for="stok">Stock</label>
      <input type="number" id="stok" name="stok" min="0" required>
      <label for="kategori">Category</label>
      <input type="text" id="kategori" name="kategori">
      <button type="submit">Save</button>
    </form>
  </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
