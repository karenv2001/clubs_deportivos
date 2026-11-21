<?php
ob_start();
require_once __DIR__ . '/../config/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión de Clubs Deportivos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f4f7fb; }
    .navbar { background: #1F4E79; }
    .tabla-cabecera th { background: #2E74B5; color: #fff; }
    .tarjeta { border: 0; border-top: 4px solid #2E74B5; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    .btn-azul { background: #2E74B5; color: #fff; }
    .btn-azul:hover { background: #1F4E79; color: #fff; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE ?>/index.php">Clubs Deportivos</a>
    <div class="navbar-nav">
      <a class="nav-link" href="<?= BASE ?>/clubes/index.php">Clubes</a>
      <a class="nav-link" href="<?= BASE ?>/miembros/index.php">Miembros</a>
      <a class="nav-link" href="<?= BASE ?>/inscripciones/index.php">Inscripciones</a>
    </div>
  </div>
</nav>
<div class="container">
