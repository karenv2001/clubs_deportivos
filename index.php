<?php
include 'includes/header.php';
$totalClubes = $pdo->query("SELECT COUNT(*) FROM clubes")->fetchColumn();
$totalMiembros = $pdo->query("SELECT COUNT(*) FROM miembros")->fetchColumn();
$totalInsc = $pdo->query("SELECT COUNT(*) FROM inscripciones")->fetchColumn();
?>
<h2 class="mb-4">Gestión de Clubs Deportivos</h2>
<div class="row g-3">
  <div class="col-md-4"><div class="card tarjeta p-3 text-center">
    <h5>Clubes</h5><h1><?= $totalClubes ?></h1>
    <a href="clubes/index.php" class="btn btn-azul">Administrar</a></div></div>
  <div class="col-md-4"><div class="card tarjeta p-3 text-center">
    <h5>Miembros</h5><h1><?= $totalMiembros ?></h1>
    <a href="miembros/index.php" class="btn btn-azul">Administrar</a></div></div>
  <div class="col-md-4"><div class="card tarjeta p-3 text-center">
    <h5>Inscripciones</h5><h1><?= $totalInsc ?></h1>
    <a href="inscripciones/index.php" class="btn btn-azul">Administrar</a></div></div>
</div>
<?php include 'includes/footer.php'; ?>
