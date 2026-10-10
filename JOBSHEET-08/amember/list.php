<?php
$page_title = "Member List";
require __DIR__ . '/../includes/connection.php';
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarMember = $pdo->query("SELECT * FROM members ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
  <section>
    <h2>Member List</h2>
    <?php if ($flash): ?>
      <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
    <?php endif; ?>
    <table border="1" cellpadding="8" cellspacing="0">
      <thead>
        <tr><th>Member ID</th><th>Name</th><th>Address</th><th>Phone</th></tr>
      </thead>
      <tbody>
        <?php if (empty($daftarMember)): ?>
        <tr>
          <td colspan="4">No member data yet. Please add one via the "Add Member" menu.</td>
        </tr>
        <?php else: ?>
          <?php foreach ($daftarMember as $member): ?>
        <tr>
          <td><?php echo htmlspecialchars($member['member_id']); ?></td>
          <td><?php echo htmlspecialchars($member['name']); ?></td>
          <td><?php echo htmlspecialchars($member['address'] ?? '-'); ?></td>
          <td><?php echo htmlspecialchars($member['phone'] ?? '-'); ?></td>
        </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
