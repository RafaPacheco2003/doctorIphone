<?php 
ob_start();

$title = "Agendar Cita";

require_once __DIR__ . '/../../controllers/ServicioController.php';
require_once __DIR__ . '/../../controllers/ModeloController.php';

try {
    $servicioController = new ServicioController();
    $servicios = $servicioController->getAll();
    
    $modeloController = new ModeloController();
    $modelos = $modeloController->getAll();
} catch (Exception $e) {
    $servicios = [];
    $modelos = [];
    error_log("Error al cargar datos: " . $e->getMessage());
}
?>

<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">

        <h1 class="text-3xl font-bold mb-6 text-center">Agendar Cita</h1>
        <p class="text-center text-gray-700 mb-6">Completa el formulario para reservar tu reparación</p>

        <div class="grid grid-cols-4 gap-10 text-center mt-8">
            <div id="step-1" class="step flex flex-col items-center">
                <div class="step-circle w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center font-bold shadow">
                    1
                </div>
                <p class="step-label mt-2 text-sm text-red-700">Servicio</p>
            </div>
            <div id="step-2" class="step flex flex-col items-center">
                <div class="step-circle w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-400 font-bold">
                    2
                </div>
                <p class="step-label mt-2 text-sm text-gray-500">Dispositivo</p>
            </div>
            <div id="step-3" class="step flex flex-col items-center">
                <div class="step-circle w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-400 font-bold">
                    3
                </div>
                <p class="step-label mt-2 text-sm text-gray-500">Fecha</p>
            </div>
            <div id="step-4" class="step flex flex-col items-center">
                <div class="step-circle w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-400 font-bold">
                    4
                </div>
                <p class="step-label mt-2 text-sm text-gray-500">Detalle</p>
            </div>
        </div>

        <div id="view-step-1" class="mt-10">
            <div id="cards" class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <?php foreach ($servicios as $servicio): ?>
                    <?php include __DIR__ . "/../components/scheduleComponents/card-servicio.php"; ?>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end mt-6">
                <button onclick="goToStep(2)" class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition">
                    Siguiente >
                </button>
            </div>
        </div>

        <div id="view-step-2" class="hidden mt-10">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-left">Tu Dispositivo</h2>
            <div class="grid grid-cols-1 gap-4">
                <label class="font-semibold text-gray-700 mb-2">Modelo</label>
                <select id="modelo" class="border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition w-full">
                    <option value="">Selecciona un modelo</option>
                    <?php foreach ($modelos as $modelo): ?>
                        <option value="<?= $modelo->getId() ?>">
                            <?= htmlspecialchars($modelo->getMarca()) ?> - <?= htmlspecialchars($modelo->getModelo()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex justify-between mt-6">
                <button onclick="goToStep(1)" class="bg-white border border-gray-300 px-6 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition font-medium">
                    &lt; Atrás
                </button>
                <button onclick="goToStep(3)" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium">
                    Siguiente >
                </button>
            </div>
        </div>

        <div id="view-step-3" class="hidden mt-10">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-left">Fecha y Hora</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            
                <div class="flex flex-col">
                    <label class="font-semibold text-gray-700 mb-2">Fecha deseada</label>
                    <input type="date" id="fecha" class="border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition w-full">
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold text-gray-700 mb-2">Hora preferida</label>
                    <select class="border border-gray-300 rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition w-full">
                        <option value="">Selecciona una hora</option>
                        <option>09:00 AM</option>
                        <option>10:00 AM</option>
                        <option>11:00 AM</option>
                        <option>12:00 PM</option>
                        <option>01:00 PM</option>
                        <option>02:00 PM</option>
                        <option>03:00 PM</option>
                        <option>04:00 PM</option>
                        <option>05:00 PM</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-between items-center mt-10">
                <button onclick="goToStep(2)" class="bg-white border border-gray-300 px-6 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition font-medium">
                    &lt; Atrás
                </button>
                <button onclick="goToStep(4)" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium">
                    Siguiente &gt;
                </button>
            </div>
        </div>

        <div id="view-step-4" class="hidden mt-10">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-left">Describe el problema</h2>
            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-2">Detalles adicionales</label>
                <textarea class="border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition w-full" rows="5" placeholder="Describe el problema con tu dispositivo..."></textarea>
            </div>
            <div class="flex justify-between items-center mt-10">
                <button onclick="goToStep(3)" class="bg-white border border-gray-300 px-6 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition font-medium">
                    &lt; Atrás
                </button>
                <button class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium">
                    Finalizar
                </button>
            </div>
        </div>

    </div>
</section>

<script>
function selectCard(card) {
    document.querySelectorAll('.card-servicio').forEach(c => {
        c.classList.remove('bg-red-100', 'border-red-600');
        c.classList.add('border-gray-300');
    });
    card.classList.add('bg-red-100', 'border-red-600');
    card.classList.remove('border-gray-300');
}

function goToStep(step) {
    if(step === 2) {
        const selected = document.querySelector('.card-servicio.bg-red-100');
        if(!selected) {
            alert('Por favor selecciona un servicio para continuar.');
            return;
        }
    }

    if(step === 3) {
        const modelo = document.getElementById('modelo').value;
        if(!modelo) {
            alert('Por favor selecciona un modelo para continuar.');
            return;
        }
    }

    if(step === 4) {
        const fecha = document.querySelector('#view-step-3 input[type="date"]').value;
        const hora = document.querySelector('#view-step-3 select').value;
        if(!fecha || !hora) {
            alert('Por favor selecciona fecha y hora para continuar.');
            return;
        }
    }

    if(step === 5) {
        const detalle = document.querySelector('#view-step-4 textarea').value.trim();
        if(!detalle) {
            alert('Por favor describe el problema para continuar.');
            return;
        }
    }

    document.querySelectorAll('[id^="view-step"]').forEach(view => view.classList.add('hidden'));
    document.getElementById(`view-step-${step}`).classList.remove('hidden');

    document.querySelectorAll('.step').forEach(s => {
        s.querySelector('.step-circle').classList.remove('bg-red-600', 'text-white');
        s.querySelector('.step-circle').classList.add('border', 'text-gray-500', 'bg-white');
        s.querySelector('.step-label').classList.remove('text-red-700');
        s.querySelector('.step-label').classList.add('text-gray-500');
    });

    const current = document.getElementById(`step-${step}`);
    current.querySelector('.step-circle').classList.add('bg-red-600', 'text-white');
    current.querySelector('.step-circle').classList.remove('border', 'bg-white', 'text-gray-500');
    current.querySelector('.step-label').classList.add('text-red-700');
    current.querySelector('.step-label').classList.remove('text-gray-500');
}

</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../layout/main.php";
?>
