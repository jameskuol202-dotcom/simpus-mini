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
    <form method="post" action="process_add.php">
      <label for="member_id">Member ID</label><br>
      <input type="text" id="member_id" name="member_id" required><br><br>
      <label for="name">Name</label><br>
      <input type="text" id="name" name="name" required><br><br>
      <label for="address">Address</label><br>
      <input type="text" id="address" name="address"><br><br>
      <label for="phone">Phone</label><br>
      <input type="text" id="phone" name="phone"><br><br>
      <button type="submit">Save</button>
    </form>
  </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
