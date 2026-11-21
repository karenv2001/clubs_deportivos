<?php
include '../includes/header.php';
$id = $_GET['id'] ?? null;
$i = ['club_id' => '', 'miembro_id' => '', 'fecha_inscripcion' => date('Y-m-d')];
$error = '';

if ($id) {
    $s = $pdo->prepare("SELECT * FROM inscripciones WHERE inscripcion_id = ?");
    $s->execute([$id]);
    $i = $s->fetch() ?: $i;
}

// listas para los select
$clubes = $pdo->query("SELECT club_id, nombre FROM clubes ORDER BY nombre")->fetchAll();
$miembros = $pdo->query("SELECT miembro_id, nombre, apellido FROM miembros ORDER BY apellido")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [$_POST['club_id'], $_POST['miembro_id'], $_POST['fecha_inscripcion']];
    try {
        if ($id) {
            $sql = "UPDATE inscripciones SET club_id=?, miembro_id=?, fecha_inscripcion=? WHERE inscripcion_id=?";
            $datos[] = $id;
            $msg = "actualizada";
        } else {
            $sql = "INSERT INTO inscripciones (club_id, miembro_id, fecha_inscripcion) VALUES (?,?,?)";
            $msg = "guardada";
        }
        $pdo->prepare($sql)->execute($datos);
        header("Location: index.php?msg=$msg");
        exit;
    } catch (PDOException $ex) {
        // 23000 = el miembro ya estaba inscrito en ese club
        $error = ($ex->getCode() == 23000) ? "Ese miembro ya está inscrito en ese club." : $ex->getMessage();
        $i = ['club_id' => $_POST['club_id'], 'miembro_id' => $_POST['miembro_id'], 'fecha_inscripcion' => $_POST['fecha_inscripcion']];
    }
}
?>
<h3><?= $id ? 'Editar inscripción' : 'Nueva inscripción' ?></h3>
<?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
<div class="card tarjeta p-4">
<form method="post">
  <div class="mb-3"><label class="form-label">Club</label>
    <select name="club_id" class="form-select" required>
      <option value="">Seleccione un club</option>
      <?php foreach ($clubes as $c): ?>
        <option value="<?= $c['club_id'] ?>" <?= $c['club_id'] == $i['club_id'] ? 'selected' : '' ?>><?= e($c['nombre']) ?></option>
      <?php endforeach; ?>
    </select></div>
  <div class="mb-3"><label class="form-label">Miembro</label>
    <select name="miembro_id" class="form-select" required>
      <option value="">Seleccione un miembro</option>
      <?php foreach ($miembros as $m): ?>
        <option value="<?= $m['miembro_id'] ?>" <?= $m['miembro_id'] == $i['miembro_id'] ? 'selected' : '' ?>><?= e($m['apellido'] . ' ' . $m['nombre']) ?></option>
      <?php endforeach; ?>
    </select></div>
  <div class="mb-3"><label class="form-label">Fecha de inscripción</label>
    <input type="date" name="fecha_inscripcion" class="form-control" required value="<?= e($i['fecha_inscripcion']) ?>"></div>
  <button class="btn btn-azul">Guardar</button>
  <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form></div>
<?php include '../includes/footer.php'; ?>
