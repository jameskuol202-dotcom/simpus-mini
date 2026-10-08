<?php
$page_title = "Member List";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarAnggota = $_SESSION['anggota'] ?? [];
?>
  <section>
    <h2>Member List</h2>
    <?php if ($flash): ?>
      <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
    <?php endif; ?>
    <div class="search-box">
      <label for="search-input">Search Member Name</label>
      <input type="text" id="search-input" placeholder="Type a member name...">
    </div>
    <div class="table-responsive">
      <table>
        <thead>
          <tr><th>NIM</th><th>Name</th><th>Email</th><th>Study Program</th><th>Actions</th></tr>
        </thead>
        <tbody>
          <?php if (empty($daftarAnggota)): ?>
          <tr>
            <td colspan="5">No member data yet. Please add one via the "Add Member" menu.</td>
          </tr>
          <?php else: ?>
            <?php foreach ($daftarAnggota as $a): ?>
          <tr>
            <td><?php echo htmlspecialchars($a['nim']); ?></td>
            <td><?php echo htmlspecialchars($a['nama']); ?></td>
            <td><?php echo htmlspecialchars($a['email']); ?></td>
            <td><?php echo htmlspecialchars($a['prodi']); ?></td>
            <td>
              <button type="button">Edit</button>
              <button type="button" class="btn-hapus">Delete</button>
            </td>
          </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
