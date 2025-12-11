<?php
session_start();

require_once __DIR__ . '/../../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../../controllers/UsuarioController.php';

AuthMiddleware::redirigirSiAutenticado();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $usuarioController = new UsuarioController();
        
        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'email' => $_POST['email'] ?? '',
            'telefono' => $_POST['telefono'] ?? '',
            'password' => $_POST['password'] ?? '',
            'rol' => $_POST['rol'] ?? 'cliente'
        ];

        $id = $usuarioController->registrarUsuario($data);
        
        $usuario = $usuarioController->getById($id);
        
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['usuario_nombre'] = $usuario->getNombre();
        $_SESSION['usuario_email'] = $usuario->getEmail();
        $_SESSION['usuario_rol'] = $usuario->getRol();
        
        $usuarioController->crearTokenYCookie($usuario);
        
        // Redirigir según el rol
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
    <title>Registro - Doctor Phone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-900 mb-3">Doctor Phone</h1>
            <p class="text-gray-600">Crea tu cuenta</p>
        </div>

        <?php if ($error): ?>
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-900 mb-2">
                    Nombre Completo
                </label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    placeholder="Juan Pérez"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 transition"
                    required
                >
            </div>

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
                <label for="telefono" class="block text-sm font-medium text-gray-900 mb-2">
                    Teléfono
                </label>
                <input 
                    type="tel" 
                    id="telefono" 
                    name="telefono" 
                    placeholder="5512345678"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 transition"
                    required
                >
            </div>

            <div>
                <label for="rol" class="block text-sm font-medium text-gray-900 mb-2">
                    Tipo de Usuario
                </label>
                <select 
                    id="rol" 
                    name="rol" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 transition"
                    required
                >
                    <option value="cliente">Cliente</option>
                    <option value="admin">Administrador</option>
                </select>
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
                Registrarse
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-gray-600">
                ¿Ya tienes una cuenta? 
                <a href="/login" class="text-red-600 hover:text-red-700 font-semibold">
                    Inicia Sesión
                </a>
            </p>
        </div>

    </div>

</body>
</html>
