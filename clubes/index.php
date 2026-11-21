<?php
include '../includes/header.php';

// eliminar club
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $pdo->prepare("DELETE FROM clubes WHERE club_id = ?")->execute([$_POST['eliminar']]);
    header("Location: index.php?msg=eliminado");
    exit;
}
$clubes = $pdo->query("SELECT * FROM clubes ORDER BY club_id")->fetchAll();
?>
<div class="d-flex justify-content-between mb-3">
  <h3>Clubes</h3>
  <a href="form.php" class="btn btn-azul">+ Nuevo club</a>
</div>
<?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-success">Club <?= e($_GET['msg']) ?> correctamente.</div>
<?php endif; ?>
<div class="card tarjeta"><div class="table-responsive">
<table class="table table-striped mb-0">
  <thead class="tabla-cabecera"><tr>
    <th>ID</th><th>Nombre</th><th>Deporte</th><th>Ubicación</th><th>Fundación</th><th>Acciones</th>
  </tr></thead>
  <tbody>
  <?php foreach ($clubes as $c): ?>
    <tr>
      <td><?= $c['club_id'] ?></td>
      <td><?= e($c['nombre']) ?></td>
      <td><?= e($c['deporte']) ?></td>
      <td><?= e($c['ubicacion']) ?></td>
      <td><?= e($c['fecha_fundacion']) ?></td>
      <td>
        <a href="form.php?id=<?= $c['club_id'] ?>" class="btn btn-sm btn-warning">Editar</a>
        <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar este club?');">
          <button name="eliminar" value="<?= $c['club_id'] ?>" class="btn btn-sm btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table></div></div>
<?php include '../includes/footer.php'; ?>
