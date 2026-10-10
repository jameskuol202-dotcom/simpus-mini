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
    <form method="post" action="process_add.php">
      <label for="title">Title</label><br>
      <input type="text" id="title" name="title" required><br><br>
      <label for="author">Author</label><br>
      <input type="text" id="author" name="author" required><br><br>
      <label for="year">Year</label><br>
      <input type="number" id="year" name="year" min="1900" max="2026" required><br><br>
      <label for="isbn">ISBN</label><br>
      <input type="text" id="isbn" name="isbn"><br><br>
      <label for="stock">Stock</label><br>
      <input type="number" id="stock" name="stock" min="0" value="0" required><br><br>
      <label for="category">Category</label><br>
      <input type="text" id="category" name="category"><br><br>
      <button type="submit">Save</button>
    </form>
  </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
