<?php
require_once __DIR__ . '/../../../controllers/UsuarioController.php';

$usuarioController = new UsuarioController();
$usuario = $usuarioController->verificarToken();

$nombreUsuario = 'Invitado';
$isLoggedIn = false;

if ($usuario) {
    $nombreUsuario = $usuario['nombre'];
    $isLoggedIn = true;
} elseif (isset($_SESSION['usuario_nombre'])) {
    $nombreUsuario = $_SESSION['usuario_nombre'];
    $isLoggedIn = true;
}
?>

<header class="shadow bg-white">
    <div class="container mx-auto py-4 px-4 flex justify-between items-center">
        <div class="flex items-center gap-6">
            <h1 class="text-2xl font-bold">📱 Dr. <span class="text-red-600">iPhone</span></h1>

            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="/home" class="text-gray-700 text-sm hover:text-gray-900">Inicio</a></li>
                    <li><a href="/schedule" class="text-gray-700 text-sm hover:text-gray-900">Agendar Cita</a></li>
                    <?php if ($isLoggedIn && isset($usuario['rol']) && $usuario['rol'] === 'admin'): ?>
                        <li><a href="/dashboard" class="text-gray-700 text-sm hover:text-gray-900">Dashboard</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <div class="flex items-center gap-6">
            <?php if ($isLoggedIn): ?>
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-user text-gray-700 text-base"></i>
                    <span class="text-sm text-gray-800"><?= htmlspecialchars($nombreUsuario) ?></span>
                </div>

                <a href="/logout" class="text-sm bg-white hover:bg-gray-200 text-gray-800 px-3 py-1 border border-gray-300 rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Salir
                </a>
            <?php else: ?>
                <a href="/login" class="text-sm bg-white hover:bg-gray-200 text-gray-800 px-3 py-1 border border-gray-300 rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Iniciar Sesión
                </a>
                <a href="/register" class="text-sm bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i>
                    Registrarse
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>
