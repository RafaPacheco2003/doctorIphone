<?php
session_start();

require_once __DIR__ . '/../../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../../controllers/UsuarioController.php';

AuthMiddleware::redirigirSiAutenticado();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $usuarioController = new UsuarioController();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $usuario = $usuarioController->loginUsuario($email, $password);
        
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['usuario_nombre'] = $usuario->getNombre();
        $_SESSION['usuario_email'] = $usuario->getEmail();
        $_SESSION['usuario_rol'] = $usuario->getRol();
        
        $usuarioController->crearTokenYCookie($usuario);
        
        if ($usuario->getRol() === 'admin') {
            header('Location: /dashboard');
        } else {
            header('Location: /home');
        }
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Doctor Phone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-900 mb-3">Doctor Phone</h1>
            <p class="text-gray-600">Inicia sesión en tu cuenta</p>
        </div>

        <?php if ($error): ?>
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                    Correo Electrónico
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="correo@ejemplo.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 transition"
                    required
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-900 mb-2">
                    Contraseña
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 transition"
                    required
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition"
            >
                Iniciar Sesión
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-gray-600">
                ¿No tienes una cuenta? 
                <a href="/register" class="text-red-600 hover:text-red-700 font-semibold">
                    Regístrate
                </a>
            </p>
        </div>

    </div>

</body>
</html>
