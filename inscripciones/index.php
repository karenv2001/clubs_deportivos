<?php
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $pdo->prepare("DELETE FROM inscripciones WHERE inscripcion_id = ?")->execute([$_POST['eliminar']]);
    header("Location: index.php?msg=eliminada");
    exit;
}

// junto las tres tablas para mostrar nombres y no solo los ids
$sql = "SELECT i.inscripcion_id, c.nombre AS club, c.deporte, m.nombre, m.apellido, i.fecha_inscripcion
        FROM inscripciones i
        JOIN clubes c ON c.club_id = i.club_id
        JOIN miembros m ON m.miembro_id = i.miembro_id
        ORDER BY i.inscripcion_id";
$lista = $pdo->query($sql)->fetchAll();
?>
<div class="d-flex justify-content-between mb-3">
  <h3>Inscripciones</h3>
  <a href="form.php" class="btn btn-azul">+ Nueva inscripción</a>
</div>
<?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-success">Inscripción <?= e($_GET['msg']) ?> correctamente.</div>
<?php endif; ?>
<div class="card tarjeta"><div class="table-responsive">
<table class="table table-striped mb-0">
  <thead class="tabla-cabecera"><tr>
    <th>ID</th><th>Club</th><th>Deporte</th><th>Miembro</th><th>Fecha</th><th>Acciones</th>
  </tr></thead>
  <tbody>
  <?php foreach ($lista as $i): ?>
    <tr>
      <td><?= $i['inscripcion_id'] ?></td>
      <td><?= e($i['club']) ?></td>
      <td><?= e($i['deporte']) ?></td>
      <td><?= e($i['nombre'] . ' ' . $i['apellido']) ?></td>
      <td><?= e($i['fecha_inscripcion']) ?></td>
      <td>
        <a href="form.php?id=<?= $i['inscripcion_id'] ?>" class="btn btn-sm btn-warning">Editar</a>
        <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar esta inscripción?');">
          <button name="eliminar" value="<?= $i['inscripcion_id'] ?>" class="btn btn-sm btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table></div></div>
<?php include '../includes/footer.php'; ?>
