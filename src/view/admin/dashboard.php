<?php
session_start();

require_once __DIR__ . '/../../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../../controllers/ModeloController.php';
require_once __DIR__ . '/../../controllers/CitaController.php';
require_once __DIR__ . '/../../controllers/UsuarioController.php';

AuthMiddleware::requiereAdmin();

$modeloController = new ModeloController();
$citaController = new CitaController();
$usuarioController = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_modelo'])) {
    try {
        $data = [
            'marca' => 'Apple',
            'modelo' => $_POST['modelo']
        ];
        
        $result = $modeloController->createModelo($data);
        
        if ($result) {
            header('Location: /dashboard');
            exit;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_modelo'])) {
    try {
        $id = $_POST['id'];
        $data = [
            'marca' => 'Apple',
            'modelo' => $_POST['modelo']
        ];
        
        $modeloController->actualizarModelo($id, $data);
        header('Location: /dashboard');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (isset($_GET['eliminar'])) {
    try {
        $modeloController->eliminarModelo($_GET['eliminar']);
        header('Location: /dashboard');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (isset($_GET['confirmar_cita'])) {
    try {
        $citaController->confirmarCita($_GET['confirmar_cita']);
        header('Location: /dashboard');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (isset($_GET['cancelar_cita'])) {
    try {
        $citaController->cancelarCita($_GET['cancelar_cita']);
        header('Location: /dashboard');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (isset($_GET['eliminar_cita'])) {
    try {
        $citaController->eliminarCita($_GET['eliminar_cita']);
        header('Location: /dashboard');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

$modeloEditar = null;
if (isset($_GET['editar'])) {
    $modeloEditar = $modeloController->getById($_GET['editar']);
}

try {
    $modelos = $modeloController->getAll();
    $citas = $citaController->getAll();
    $usuarios = $usuarioController->getAll();
} catch (Exception $e) {
    $modelos = [];
    $citas = [];
    $usuarios = [];
    error_log("Error al cargar datos: " . $e->getMessage());
}

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

<?php include __DIR__ . '/../components/header/header.php'; ?>

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
                <button id="tab-modelos" class="tab px-4 py-2 text-gray-500 border-b-2 border-transparent" onclick="cambiarTab(2)">Gestión de Modelos</button>
            </div>

            <div class="contenido w-full mt-6">
                <div class="overflow-x-auto">
                    <table class="table-fixed w-full text-sm">
                        <thead class="bg-gray-100 text-left [&>tr>th]:py-3 [&>tr>th]:px-2">
                            <tr>
                                <th class="text-gray-500">ID</th>
                                <th class="text-gray-500">Usuario</th>
                                <th class="text-gray-500">Servicio</th>
                                <th class="text-gray-500">Fecha</th>
                                <th class="text-gray-500">Hora</th>
                                <th class="text-gray-500">Estado</th>
                                <th class="text-gray-500 text-right">Acciones</th>
                            </tr>
                        </thead>

                    <tbody class="[&>tr>td]:py-3 [&>tr>td]:px-2">
                        <?php if (!empty($citas)): ?>
                            <?php foreach ($citas as $cita): ?>
                                <tr class="hover:bg-gray-50 border-b border-gray-100">
                                    <td class="text-gray-700"><?= htmlspecialchars($cita->getId()) ?></td>
                                    <td class="text-gray-700 font-medium"><?= htmlspecialchars($cita->getUsuarioNombre() ?? 'N/A') ?></td>
                                    <td class="text-gray-700"><?= htmlspecialchars($cita->getServicioNombre() ?? 'N/A') ?></td>
                                    <td class="text-gray-700"><?= date('d/m/Y', strtotime($cita->getFecha())) ?></td>
                                    <td class="text-gray-700"><?= date('h:i A', strtotime($cita->getHora())) ?></td>
                                    <td>
                                        <?php if ($cita->getEstado() === 'pendiente'): ?>
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pendiente</span>
                                        <?php elseif ($cita->getEstado() === 'confirmada'): ?>
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Confirmada</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Cancelada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <button onclick="toggleMenuCita(<?= $cita->getId() ?>, event)" class="text-gray-600 hover:text-gray-900 p-2 relative">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-8 text-gray-500">
                                    No hay citas registradas
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>
                
                <?php if (!empty($citas)): ?>
                    <?php foreach ($citas as $cita): ?>
                        <div id="menu-cita-<?= $cita->getId() ?>" class="hidden fixed w-48 bg-white rounded-lg shadow-xl border border-gray-200 z-[9999]">
                            <button onclick="verDetalleCita(<?= $cita->getId() ?>)" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2 rounded-t-lg">
                                <i class="fa-solid fa-eye"></i> Ver Detalle
                            </button>
                            <?php if ($cita->getEstado() === 'pendiente'): ?>
                                <a href="/dashboard?confirmar_cita=<?= $cita->getId() ?>" class="w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-gray-100 flex items-center gap-2 block">
                                    <i class="fa-solid fa-check"></i> Confirmar
                                </a>
                                <a href="/dashboard?cancelar_cita=<?= $cita->getId() ?>" onclick="return confirm('¿Estás seguro de cancelar esta cita?')" class="w-full text-left px-4 py-2 text-sm text-yellow-600 hover:bg-gray-100 flex items-center gap-2 block">
                                    <i class="fa-solid fa-ban"></i> Cancelar
                                </a>
                            <?php endif; ?>
                            <a href="/dashboard?eliminar_cita=<?= $cita->getId() ?>" onclick="return confirm('¿Estás seguro de eliminar esta cita?')" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 flex items-center gap-2 rounded-b-lg block">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="contenido hidden w-full overflow-x-auto mt-6">
                <table class="table-fixed w-full text-sm">
                    <thead class="bg-gray-100 text-left [&>tr>th]:py-3 [&>tr>th]:px-2">
                        <tr>
                            <th class="text-gray-500 w-1/5">Usuario</th>
                            <th class="text-gray-500 w-1/6">Teléfono</th>
                            <th class="text-gray-500 w-1/3">Correo</th>
                            <th class="text-gray-500 w-1/6">Rol</th>
                            <th class="text-gray-500 text-right w-1/6">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="[&>tr>td]:py-3 [&>tr>td]:px-2">
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="font-medium"><?= htmlspecialchars($usuario->getNombre()) ?></td>
                                    <td><?= htmlspecialchars($usuario->getTelefono() ?? 'N/A') ?></td>
                                    <td class="break-words whitespace-normal"><?= htmlspecialchars($usuario->getEmail()) ?></td>
                                    <td>
                                        <span class="px-2 py-1 text-xs rounded-full <?= $usuario->getRol() === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' ?>">
                                            <?= ucfirst($usuario->getRol()) ?>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <button onclick="verCitasUsuario(<?= $usuario->getId() ?>)" class="text-blue-600 hover:text-blue-800" title="Ver citas del usuario">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-6">No hay usuarios registrados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="contenido hidden w-full overflow-x-auto mt-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Lista de Modelos</h2>
                    <button onclick="openModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition text-sm">
                        <i class="fa-solid fa-plus mr-2"></i>Agregar Modelo
                    </button>
                </div>
                
                <table class="table-fixed w-full text-sm">
                    <thead class="bg-gray-100 text-left [&>tr>th]:py-3 [&>tr>th]:px-2">
                        <tr>
                            <th class="text-gray-500">ID</th>
                            <th class="text-gray-500">Marca</th>
                            <th class="text-gray-500">Modelo</th>
                            <th class="text-gray-500 text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="[&>tr>td]:py-3 [&>tr>td]:px-2">
                        <?php if (!empty($modelos)): ?>
                            <?php foreach ($modelos as $modelo): ?>
                                <tr class="hover:bg-gray-50 border-b border-gray-100">
                                    <td class="text-gray-700"><?= htmlspecialchars($modelo->getId()) ?></td>
                                    <td class="text-gray-700 font-medium"><?= htmlspecialchars($modelo->getMarca()) ?></td>
                                    <td class="text-gray-700"><?= htmlspecialchars($modelo->getModelo()) ?></td>
                                    <td class="text-right relative">
                                        <button onclick="toggleMenu(<?= $modelo->getId() ?>)" class="text-gray-600 hover:text-gray-900 p-2">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div id="menu-<?= $modelo->getId() ?>" class="hidden absolute right-0 bottom-full mb-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                                            <a href="/dashboard?editar=<?= $modelo->getId() ?>#modelos" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2 block rounded-t-lg">
                                                Editar
                                            </a>
                                            <a href="/dashboard?eliminar=<?= $modelo->getId() ?>" onclick="return confirm('¿Estás seguro de eliminar este modelo?')" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 flex items-center gap-2 rounded-b-lg block">
                                                Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-8 text-gray-500">
                                    No hay modelos registrados
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<div id="modalAgregarModelo" class="<?= $modeloEditar ? '' : 'hidden' ?> fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800"><?= $modeloEditar ? 'Editar Modelo' : 'Agregar Nuevo Modelo' ?></h3>
            <a href="/dashboard" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </a>
        </div>

        <form method="POST">
            <?php if ($modeloEditar): ?>
                <input type="hidden" name="id" value="<?= $modeloEditar->getId() ?>">
            <?php endif; ?>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Marca</label>
                <input type="text" value="Apple" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Modelo</label>
                <input type="text" name="modelo" required placeholder="Ej: iPhone 15 Pro Max" value="<?= $modeloEditar ? htmlspecialchars($modeloEditar->getModelo()) : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div class="flex gap-3">
                <a href="/dashboard" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-center">
                    Cancelar
                </a>
                <button type="submit" name="<?= $modeloEditar ? 'editar_modelo' : 'agregar_modelo' ?>" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    <?= $modeloEditar ? 'Actualizar' : 'Guardar' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalDetalleCita" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Detalle de Cita</h3>
            <button onclick="closeModalDetalle()" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <div id="detalle-content" class="space-y-3">
        </div>

        <div class="mt-6">
            <button onclick="closeModalDetalle()" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                Cerrar
            </button>
        </div>
    </div>
</div>

<div id="modalCitasUsuario" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Citas del Usuario</h3>
            <button onclick="closeModalCitasUsuario()" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <div id="usuario-info" class="bg-gray-50 p-4 rounded-lg mb-4">
        </div>

        <div id="citas-usuario-content" class="space-y-3">
        </div>

        <div class="mt-6">
            <button onclick="closeModalCitasUsuario()" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                Cerrar
            </button>
        </div>
    </div>
</div>

<script>
    function cambiarTab(index) {
        const tabs = document.querySelectorAll('.tab');
        const contenidos = document.querySelectorAll('.contenido');

        tabs.forEach(t => t.classList.remove('text-red-600', 'border-red-600'));
        contenidos.forEach(c => c.classList.add('hidden'));

        tabs[index].classList.add('text-red-600', 'border-red-600');
        contenidos[index].classList.remove('hidden');
    }

    function toggleMenu(id) {
        const menu = document.getElementById(`menu-${id}`);
        const allMenus = document.querySelectorAll('[id^="menu-"]');
        
        allMenus.forEach(m => {
            if (m.id !== `menu-${id}`) {
                m.classList.add('hidden');
            }
        });
        
        menu.classList.toggle('hidden');
    }

    function toggleMenuCita(id, event) {
        event.stopPropagation();
        const menu = document.getElementById(`menu-cita-${id}`);
        const allMenus = document.querySelectorAll('[id^="menu-cita-"]');
        
        allMenus.forEach(m => {
            if (m.id !== `menu-cita-${id}`) {
                m.classList.add('hidden');
            }
        });
        
        const isHidden = menu.classList.contains('hidden');
        
        if (isHidden) {
            const button = event.currentTarget;
            const rect = button.getBoundingClientRect();
            
            menu.style.top = `${rect.bottom + 5}px`;
            menu.style.left = `${rect.right - 192}px`;
            
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    }

    function verDetalleCita(id) {
        const citas = <?= json_encode(array_map(fn($c) => [
            'id' => $c->getId(),
            'usuario_id' => $c->getUsuarioId(),
            'usuario_nombre' => $c->getUsuarioNombre(),
            'servicio_id' => $c->getServicioId(),
            'servicio_nombre' => $c->getServicioNombre(),
            'modelo_id' => $c->getModeloId(),
            'modelo_nombre' => $c->getModeloNombre(),
            'fecha' => $c->getFecha(),
            'hora' => $c->getHora(),
            'descripcion' => $c->getDescripcion(),
            'estado' => $c->getEstado(),
            'fecha_creada' => $c->getFechaCreada()
        ], $citas)) ?>;
        
        const cita = citas.find(c => c.id == id);
        
        if (cita) {
            const fecha = new Date(cita.fecha).toLocaleDateString('es-ES', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            const hora = new Date('2000-01-01 ' + cita.hora).toLocaleTimeString('es-ES', { 
                hour: '2-digit', 
                minute: '2-digit'
            });
            
            const content = `
                <div class="border-b pb-3">
                    <p class="text-sm text-gray-500">ID de Cita</p>
                    <p class="text-lg font-semibold">#${cita.id}</p>
                </div>
                <div class="border-b pb-3">
                    <p class="text-sm text-gray-500">Cliente</p>
                    <p class="font-medium">${cita.usuario_nombre || 'N/A'}</p>
                </div>
                <div class="border-b pb-3">
                    <p class="text-sm text-gray-500">Servicio</p>
                    <p class="font-medium">${cita.servicio_nombre || 'N/A'}</p>
                </div>
                ${cita.modelo_id ? `
                <div class="border-b pb-3">
                    <p class="text-sm text-gray-500">Modelo de Celular</p>
                    <p class="font-medium">${cita.modelo_nombre || 'N/A'}</p>
                </div>
                ` : ''}
                <div class="border-b pb-3">
                    <p class="text-sm text-gray-500">Fecha y Hora</p>
                    <p class="font-medium">${fecha} - ${hora}</p>
                </div>
                <div class="border-b pb-3">
                    <p class="text-sm text-gray-500">Estado</p>
                    <p class="font-medium capitalize">${cita.estado}</p>
                </div>
                ${cita.descripcion ? `
                <div class="pb-3">
                    <p class="text-sm text-gray-500">Descripción</p>
                    <p class="font-medium">${cita.descripcion}</p>
                </div>
                ` : ''}
            `;
            
            document.getElementById('detalle-content').innerHTML = content;
            document.getElementById('modalDetalleCita').classList.remove('hidden');
        }
    }

    function closeModalDetalle() {
        document.getElementById('modalDetalleCita').classList.add('hidden');
    }

    function verCitasUsuario(usuarioId) {
        const usuarios = <?= json_encode(array_map(fn($u) => [
            'id' => $u->getId(),
            'nombre' => $u->getNombre(),
            'email' => $u->getEmail(),
            'telefono' => $u->getTelefono(),
            'rol' => $u->getRol()
        ], $usuarios)) ?>;
        
        const citas = <?= json_encode(array_map(fn($c) => [
            'id' => $c->getId(),
            'usuario_id' => $c->getUsuarioId(),
            'usuario_nombre' => $c->getUsuarioNombre(),
            'servicio_nombre' => $c->getServicioNombre(),
            'modelo_nombre' => $c->getModeloNombre(),
            'fecha' => $c->getFecha(),
            'hora' => $c->getHora(),
            'descripcion' => $c->getDescripcion(),
            'estado' => $c->getEstado(),
            'fecha_creada' => $c->getFechaCreada()
        ], $citas)) ?>;
        
        const usuario = usuarios.find(u => u.id == usuarioId);
        const citasUsuario = citas.filter(c => c.usuario_id == usuarioId);
        
        if (usuario) {
            const usuarioInfo = `
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-user text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg">${usuario.nombre}</h4>
                        <p class="text-sm text-gray-600">${usuario.email}</p>
                        ${usuario.telefono ? `<p class="text-sm text-gray-600"><i class="fa-solid fa-phone text-xs"></i> ${usuario.telefono}</p>` : ''}
                    </div>
                </div>
            `;
            document.getElementById('usuario-info').innerHTML = usuarioInfo;
            
            if (citasUsuario.length > 0) {
                const citasHTML = citasUsuario.map(cita => {
                    const fecha = new Date(cita.fecha).toLocaleDateString('es-ES', { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                    
                    const hora = new Date('2000-01-01 ' + cita.hora).toLocaleTimeString('es-ES', { 
                        hour: '2-digit', 
                        minute: '2-digit'
                    });
                    
                    let estadoBadge = '';
                    if (cita.estado === 'pendiente') {
                        estadoBadge = '<span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Pendiente</span>';
                    } else if (cita.estado === 'confirmada') {
                        estadoBadge = '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Confirmada</span>';
                    } else if (cita.estado === 'cancelada') {
                        estadoBadge = '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Cancelada</span>';
                    }
                    
                    return `
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h5 class="font-semibold text-gray-800">${cita.servicio_nombre}</h5>
                                    ${cita.modelo_nombre ? `<p class="text-sm text-gray-600"><i class="fa-solid fa-mobile-screen text-xs"></i> ${cita.modelo_nombre}</p>` : ''}
                                </div>
                                ${estadoBadge}
                            </div>
                            <div class="space-y-1 text-sm text-gray-600">
                                <p><i class="fa-regular fa-calendar text-blue-600"></i> ${fecha}</p>
                                <p><i class="fa-regular fa-clock text-blue-600"></i> ${hora}</p>
                                ${cita.descripcion ? `<p class="text-gray-500 mt-2 italic">"${cita.descripcion}"</p>` : ''}
                            </div>
                        </div>
                    `;
                }).join('');
                
                document.getElementById('citas-usuario-content').innerHTML = citasHTML;
            } else {
                document.getElementById('citas-usuario-content').innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-regular fa-calendar-xmark text-4xl mb-3"></i>
                        <p>Este usuario no tiene citas registradas</p>
                    </div>
                `;
            }
            
            document.getElementById('modalCitasUsuario').classList.remove('hidden');
        }
    }
    
    function closeModalCitasUsuario() {
        document.getElementById('modalCitasUsuario').classList.add('hidden');
    }

    function openModal() {
        document.getElementById('modalAgregarModelo').classList.remove('hidden');
    }

    function closeModal() {
        window.location.href = '/dashboard';
    }

    document.addEventListener('click', function(event) {
        const isMenuButton = event.target.closest('button[onclick^="toggleMenu"]');
        if (!isMenuButton) {
            const allMenus = document.querySelectorAll('[id^="menu-"]');
            allMenus.forEach(m => m.classList.add('hidden'));
        }
    });

    <?php if ($modeloEditar || isset($_GET['editar'])): ?>
        cambiarTab(2);
    <?php else: ?>
        cambiarTab(0);
    <?php endif; ?>
</script>

</body>
</html>
