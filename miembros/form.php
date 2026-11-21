<?php
include '../includes/header.php';
$id = $_GET['id'] ?? null;
$m = ['nombre' => '', 'apellido' => '', 'email' => '', 'telefono' => ''];

if ($id) {
    $s = $pdo->prepare("SELECT * FROM miembros WHERE miembro_id = ?");
    $s->execute([$id]);
    $m = $s->fetch() ?: $m;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [trim($_POST['nombre']), trim($_POST['apellido']), trim($_POST['email']), trim($_POST['telefono'])];
    if ($id) {
        $sql = "UPDATE miembros SET nombre=?, apellido=?, email=?, telefono=? WHERE miembro_id=?";
        $datos[] = $id;
        $msg = "actualizado";
    } else {
        $sql = "INSERT INTO miembros (nombre, apellido, email, telefono) VALUES (?,?,?,?)";
        $msg = "guardado";
    }
    $pdo->prepare($sql)->execute($datos);
    header("Location: index.php?msg=$msg");
    exit;
}
?>
<h3><?= $id ? 'Editar miembro' : 'Nuevo miembro' ?></h3>
<div class="card tarjeta p-4">
<form method="post">
  <div class="row">
    <div class="col-md-6 mb-3"><label class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" maxlength="80" required value="<?= e($m['nombre']) ?>"></div>
    <div class="col-md-6 mb-3"><label class="form-label">Apellido</label>
      <input type="text" name="apellido" class="form-control" maxlength="80" required value="<?= e($m['apellido']) ?>"></div>
  </div>
  <div class="mb-3"><label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" maxlength="100" value="<?= e($m['email']) ?>"></div>
  <div class="mb-3"><label class="form-label">Teléfono</label>
    <input type="text" name="telefono" class="form-control" maxlength="20" value="<?= e($m['telefono']) ?>"></div>
  <button class="btn btn-azul">Guardar</button>
  <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form></div>
<?php include '../includes/footer.php'; ?>
