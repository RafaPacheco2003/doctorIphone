<?php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Doctor Phone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<header class="shadow bg-white">
    <div class="container mx-auto py-4 px-4 flex justify-between items-center">
        <div class="flex items-center gap-6">
            <h1 class="text-2xl font-bold">📱 Dr. <span class="text-red-600">iPhone</span></h1>

            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="#" class="text-gray-700 text-sm hover:text-gray-900">Inicio</a></li>
                    <li><a href="#" class="text-gray-700 text-sm hover:text-gray-900">Servicios</a></li>
                    <li><a href="#" class="text-gray-700 text-sm hover:text-gray-900">Modelos</a></li>
                </ul>
            </nav>
        </div>

        <div class="flex items-center gap-6">
            <div class="flex items-center gap-2">
                <i class="fa-regular fa-user text-gray-700 text-base"></i>
                <span class="text-sm text-gray-800">Rodrigo Chi</span>
            </div>

            <a href="#" class="text-sm bg-white hover:bg-gray-200 text-gray-800 px-3 py-1 border border-gray-300 rounded-lg flex items-center gap-2">
                <i class="fa-solid fa-right-from-bracket"></i>
                Salir
            </a>
        </div>
    </div>
</header>

<main>
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-xl font-bold mb-6">Panel de Administración</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="bg-gray-50 p-4 rounded-lg shadow border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                    <i class="fa-solid fa-screwdriver-wrench text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold">Total Reparaciones</h2>
                    <p class="text-3xl font-bold text-blue-600">150</p>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                    <i class="fa-solid fa-clock text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold">Pendientes</h2>
                    <p class="text-3xl font-bold text-yellow-600">45</p>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-green-100 text-green-600 rounded-full">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold">Completadas</h2>
                    <p class="text-3xl font-bold text-green-600">105</p>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-purple-100 text-purple-600 rounded-full">
                    <i class="fa-solid fa-mobile-screen text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-semibold">Equipos Recibidos</h2>
                    <p class="text-3xl font-bold text-purple-600">20</p>
                </div>
            </div>
        </div>

        <div class="mt-12 mb-12">
            <div class="flex space-x-4 border-b">
                <button class="tab px-4 py-2 text-gray-500 border-b-2 border-transparent" onclick="cambiarTab(0)">Gestión de Citas</button>
                <button class="tab px-4 py-2 text-gray-500 border-b-2 border-transparent" onclick="cambiarTab(1)">Gestión de Usuarios</button>
                <button class="tab px-4 py-2 text-gray-500 border-b-2 border-transparent" onclick="cambiarTab(2)">Gestión de Modelos</button>
            </div>

            <div class="contenido w-full overflow-x-auto mt-6">
                <table class="table-fixed w-full text-sm">
                    <thead class="bg-gray-100 text-left [&>tr>th]:py-3 [&>tr>th]:px-2">
                        <tr>
                            <th class="text-gray-500">Cliente</th>
                            <th class="text-gray-500">Dispositivo</th>
                            <th class="text-gray-500">Fecha</th>
                            <th class="text-gray-500">Estado</th>
                            <th class="text-gray-500 text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="[&>tr>td]:py-3 [&>tr>td]:px-2">
                        <tr class="hover:bg-gray-50">
                            <td>The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                            <td>Malcolm Lockyer</td>
                            <td>1961</td>
                            <td><span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Error</span></td>
                            <td class="text-right"><i class="fa-solid fa-eye text-gray-400"></i></td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td>Witchy Woman</td>
                            <td>The Eagles</td>
                            <td>1972</td>
                            <td><span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pendiente</span></td>
                            <td class="text-right"><i class="fa-solid fa-eye text-gray-400"></i></td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td>Shining Star</td>
                            <td>Earth, Wind, and Fire</td>
                            <td>1975</td>
                            <td><span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Completado</span></td>
                            <td class="text-right"><i class="fa-solid fa-eye text-gray-400"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="contenido hidden w-full overflow-x-auto mt-6">
                <table class="table-fixed w-full text-sm">
                    <thead class="bg-gray-100 text-left [&>tr>th]:py-3 [&>tr>th]:px-2">
                        <tr>
                            <th class="text-gray-500">Usuario</th>
                            <th class="text-gray-500">Teléfono</th>
                            <th class="text-gray-500">Correo</th>
                            <th class="text-gray-500">Rol</th>
                            <th class="text-gray-500 text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="[&>tr>td]:py-3 [&>tr>td]:px-2">
                        <tr class="hover:bg-gray-50">
                            <td>Juan Perez</td>
                            <td>555-1234</td>
                            <td class="break-words whitespace-normal">juan.perez@example.com</td>
                            <td>Admin</td>
                            <td class="text-right"><i class="fa-solid fa-eye text-gray-400"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="contenido hidden mt-6">
                Gestión de Modelos
            </div>
        </div>
    </div>
</main>

<script>
    function cambiarTab(index) {
        const tabs = document.querySelectorAll('.tab');
        const contenidos = document.querySelectorAll('.contenido');

        tabs.forEach(t => t.classList.remove('text-red-600', 'border-red-600'));
        contenidos.forEach(c => c.classList.add('hidden'));

        tabs[index].classList.add('text-red-600', 'border-red-600');
        contenidos[index].classList.remove('hidden');
    }

    cambiarTab(0);
</script>

</body>
</html>
