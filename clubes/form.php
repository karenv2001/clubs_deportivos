<?php
include '../includes/header.php';
$id = $_GET['id'] ?? null;
$club = ['nombre' => '', 'deporte' => '', 'ubicacion' => '', 'fecha_fundacion' => ''];

// si viene un id cargo los datos para editar
if ($id) {
    $s = $pdo->prepare("SELECT * FROM clubes WHERE club_id = ?");
    $s->execute([$id]);
    $club = $s->fetch() ?: $club;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [trim($_POST['nombre']), trim($_POST['deporte']), trim($_POST['ubicacion']), $_POST['fecha_fundacion'] ?: null];
    if ($id) {
        $sql = "UPDATE clubes SET nombre=?, deporte=?, ubicacion=?, fecha_fundacion=? WHERE club_id=?";
        $datos[] = $id;
        $msg = "actualizado";
    } else {
        $sql = "INSERT INTO clubes (nombre, deporte, ubicacion, fecha_fundacion) VALUES (?,?,?,?)";
        $msg = "guardado";
    }
    $pdo->prepare($sql)->execute($datos);
    header("Location: index.php?msg=$msg");
    exit;
}
?>
<h3><?= $id ? 'Editar club' : 'Nuevo club' ?></h3>
<div class="card tarjeta p-4">
<form method="post">
  <div class="mb-3"><label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" maxlength="100" required value="<?= e($club['nombre']) ?>"></div>
  <div class="mb-3"><label class="form-label">Deporte</label>
    <input type="text" name="deporte" class="form-control" maxlength="50" required value="<?= e($club['deporte']) ?>"></div>
  <div class="mb-3"><label class="form-label">Ubicación</label>
    <input type="text" name="ubicacion" class="form-control" maxlength="150" value="<?= e($club['ubicacion']) ?>"></div>
  <div class="mb-3"><label class="form-label">Fecha de fundación</label>
    <input type="date" name="fecha_fundacion" class="form-control" value="<?= e($club['fecha_fundacion']) ?>"></div>
  <button class="btn btn-azul">Guardar</button>
  <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form></div>
<?php include '../includes/footer.php'; ?>
