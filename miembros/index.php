<?php
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $pdo->prepare("DELETE FROM miembros WHERE miembro_id = ?")->execute([$_POST['eliminar']]);
    header("Location: index.php?msg=eliminado");
    exit;
}
$miembros = $pdo->query("SELECT * FROM miembros ORDER BY miembro_id")->fetchAll();
?>
<div class="d-flex justify-content-between mb-3">
  <h3>Miembros</h3>
  <a href="form.php" class="btn btn-azul">+ Nuevo miembro</a>
</div>
<?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-success">Miembro <?= e($_GET['msg']) ?> correctamente.</div>
<?php endif; ?>
<div class="card tarjeta"><div class="table-responsive">
<table class="table table-striped mb-0">
  <thead class="tabla-cabecera"><tr>
    <th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th><th>Acciones</th>
  </tr></thead>
  <tbody>
  <?php foreach ($miembros as $m): ?>
    <tr>
      <td><?= $m['miembro_id'] ?></td>
      <td><?= e($m['nombre']) ?></td>
      <td><?= e($m['apellido']) ?></td>
      <td><?= e($m['email']) ?></td>
      <td><?= e($m['telefono']) ?></td>
      <td>
        <a href="form.php?id=<?= $m['miembro_id'] ?>" class="btn btn-sm btn-warning">Editar</a>
        <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar este miembro?');">
          <button name="eliminar" value="<?= $m['miembro_id'] ?>" class="btn btn-sm btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table></div></div>
<?php include '../includes/footer.php'; ?>
