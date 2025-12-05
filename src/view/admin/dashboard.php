<?php
// Configuración y conexión a la base de datos
require_once __DIR__ . '/../../repositories/UsuarioRepository.php';
require_once __DIR__ . '/../../repositories/CitaRepository.php';

// Obtener datos para el dashboard
$usuarioRepo = new UsuarioRepository();
$usuarios = $usuarioRepo->findAll();
$totalUsuarios = count($usuarios);

// Datos de ejemplo (puedes conectar con repositorios reales)
$citasHoy = 12;
$reparacionesActivas = 8;
$ingresosMes = 45200;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Doctor Phone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📱 Doctor Phone Admin</h1>
            <div class="flex items-center gap-4">
                <span>Admin: <strong>Juan Pérez</strong></span>
                <a href="#" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                    Cerrar Sesión
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mx-auto px-4 py-8">
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Usuarios</p>
                        <p class="text-3xl font-bold text-blue-600"><?php echo $totalUsuarios; ?></p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Citas Hoy</p>
                        <p class="text-3xl font-bold text-green-600"><?php echo $citasHoy; ?></p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Reparaciones</p>
                        <p class="text-3xl font-bold text-yellow-600"><?php echo $reparacionesActivas; ?></p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Ingresos Mes</p>
                        <p class="text-3xl font-bold text-purple-600">$<?php echo number_format($ingresosMes, 0); ?></p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Usuarios Recientes -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-800">Usuarios Recientes</h2>
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            + Nuevo Usuario
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach (array_slice($usuarios, 0, 5) as $usuario): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo $usuario->getId(); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo htmlspecialchars($usuario->getNombre()); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($usuario->getEmail()); ?></td>
                                <td class="px-6 py-4">
                                    <?php if ($usuario->getRol() === 'admin'): ?>
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Admin</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Cliente</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 mr-3">Editar</a>
                                    <a href="#" class="text-red-600 hover:text-red-800">Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Citas Pendientes -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Citas Pendientes</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="border-l-4 border-yellow-500 bg-yellow-50 p-4 rounded">
                            <p class="font-semibold text-gray-800">Juan Pérez</p>
                            <p class="text-sm text-gray-600">Cambio de pantalla</p>
                            <p class="text-xs text-gray-500 mt-2">Hoy - 14:30</p>
                        </div>
                        <div class="border-l-4 border-green-500 bg-green-50 p-4 rounded">
                            <p class="font-semibold text-gray-800">Ana Martínez</p>
                            <p class="text-sm text-gray-600">Cambio de batería</p>
                            <p class="text-xs text-gray-500 mt-2">Hoy - 16:00</p>
                        </div>
                        <div class="border-l-4 border-blue-500 bg-blue-50 p-4 rounded">
                            <p class="font-semibold text-gray-800">Pedro Ruiz</p>
                            <p class="text-sm text-gray-600">Diagnóstico</p>
                            <p class="text-xs text-gray-500 mt-2">Mañana - 10:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
