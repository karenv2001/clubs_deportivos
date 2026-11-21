<?php
// datos de conexion a MySQL (cambiar el puerto si el tuyo no es el 3306)
$host = "localhost";
$puerto = 3306;
$bd = "clubs_deportivos";
$usuario = "root";
$clave = "root";

// carpeta del proyecto dentro de htdocs
define('BASE', '/clubs_deportivos');

try {
    $pdo = new PDO("mysql:host=$host;port=$puerto;dbname=$bd;charset=utf8mb4", $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// para mostrar texto sin que rompa el HTML
function e($texto) {
    return htmlspecialchars($texto ?? '');
}
