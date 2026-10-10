<?php
$page_title = "Book List";
require __DIR__ . '/../includes/connection.php';
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarBook = $pdo->query("SELECT * FROM books ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
  <section>
    <h2>Book List</h2>
    <?php if ($flash): ?>
      <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
    <?php endif; ?>
    <table border="1" cellpadding="8" cellspacing="0">
      <thead>
        <tr><th>Title</th><th>Author</th><th>Year</th><th>ISBN</th><th>Stock</th><th>Category</th></tr>
      </thead>
      <tbody>
        <?php if (empty($daftarBook)): ?>
        <tr>
          <td colspan="6">No book data yet. Please add one via the "Add Book" menu.</td>
        </tr>
        <?php else: ?>
          <?php foreach ($daftarBook as $book): ?>
        <tr>
          <td><?php echo htmlspecialchars($book['title']); ?></td>
          <td><?php echo htmlspecialchars($book['author']); ?></td>
          <td><?php echo $book['year']; ?></td>
          <td><?php echo htmlspecialchars($book['isbn'] ?? '-'); ?></td>
          <td><?php echo $book['stock']; ?></td>
          <td><?php echo htmlspecialchars($book['category'] ?? '-'); ?></td>
        </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
