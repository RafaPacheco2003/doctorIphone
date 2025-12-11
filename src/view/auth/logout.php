<?php
session_start();

require_once __DIR__ . '/../../controllers/UsuarioController.php';

$usuarioController = new UsuarioController();
$usuarioController->cerrarSesion();

header('Location: /login');
exit;
