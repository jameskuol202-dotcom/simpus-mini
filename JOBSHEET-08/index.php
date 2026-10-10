<?php
$page_title = "Home";
require __DIR__ . '/includes/connection.php';

$totalBook = $pdo->query("SELECT COUNT(*) FROM books")->fetchColumn();
$totalAmember = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();

include __DIR__ . '/includes/header.php';
?>
  <section>
    <h2>Dashboard</h2>
    <div class="stats">
      <div class="card">
        <h3>Total Books</h3>
        <p><?php echo $totalBook; ?></p>
      </div>
      <div class="card">
        <h3>Total Members</h3>
        <p><?php echo $totalAmember; ?></p>
      </div>
    </div>
  </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
