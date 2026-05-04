<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$monto = isset($_POST['monto']) ? (float)$_POST['monto'] : 0;
if ($monto <= 0) {
    header('Location: recargar_monedas.php?error=monto_invalido');
    exit;
}

// Calcular monedas: 1€ = 1 moneda (ajustado para precios más altos)
$monedas_agregar = $monto;

// Actualizar monedas del usuario
$conexion->query("UPDATE usuarios SET monedas = monedas + $monedas_agregar WHERE id_usuarios = $usuario_id");

// Registrar transacción
$conexion->query("INSERT INTO transacciones (usuario_id, tipo, monto) VALUES ($usuario_id, 'recarga', $monto)");

header('Location: recargar_monedas.php?success=1');
exit;
?>