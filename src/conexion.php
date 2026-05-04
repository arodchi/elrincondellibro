<?php
$host = 'db';
$usuario = 'user';
$contrasena = 'pass123';
$base_datos = 'elrincondellibro';

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
