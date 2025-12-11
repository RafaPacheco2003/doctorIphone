<?php 
session_start();
ob_start();

$title = "Agendar Cita";

require_once __DIR__ . '/../../controllers/ServicioController.php';
require_once __DIR__ . '/../../controllers/ModeloController.php';
require_once __DIR__ . '/../../controllers/CitaController.php';
require_once __DIR__ . '/../../middleware/AuthMiddleware.php';

// Solo clientes pueden agendar citas
$usuario = AuthMiddleware::requiereCliente();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_cita'])) {
    try {
        $citaController = new CitaController();
        
        $data = [
            'usuario_id' => $usuario['id'],
            'servicio_id' => $_POST['servicio_id'] ?? '',
            'modelo_id' => $_POST['modelo_id'] ?? null,
            'fecha' => $_POST['fecha'] ?? '',
            'hora' => $_POST['hora'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'estado' => 'pendiente'
        ];

        $citaController->createCita($data);
        $success = 'Cita creada exitosamente';
        header('refresh:2;url=/home');
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

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

<section class="bg-gradient-to-br from-gray-50 to-gray-100 py-16 min-h-screen">
    <div class="container mx-auto px-6 max-w-4xl">

        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold mb-3 text-gray-800">Agendar Cita</h1>
            <p class="text-gray-600 text-lg">Completa el formulario en 4 sencillos pasos para reservar tu reparación</p>
        </div>

        <?php if ($error): ?>
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation text-2xl"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-2xl"></i>
                <span><?= htmlspecialchars($success) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" id="formCita">
            <input type="hidden" name="crear_cita" value="1">
            <input type="hidden" name="servicio_id" id="servicio_id">
            <input type="hidden" name="modelo_id" id="modelo_id_hidden">
            <input type="hidden" name="fecha" id="fecha_hidden">
            <input type="hidden" name="hora" id="hora_hidden">
            <input type="hidden" name="descripcion" id="descripcion_hidden">

        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="grid grid-cols-4 gap-4 mb-8">
                <div id="step-1" class="step flex flex-col items-center relative">
                    <div class="step-circle w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center font-bold shadow-lg text-lg">
                        1
                    </div>
                    <p class="step-label mt-3 text-sm font-semibold text-red-700">Servicio</p>
                    <div class="step-line absolute top-6 left-1/2 w-full h-0.5 bg-gray-200 -z-10 hidden md:block"></div>
                </div>
                <div id="step-2" class="step flex flex-col items-center relative">
                    <div class="step-circle w-12 h-12 rounded-full border-2 border-gray-300 bg-white flex items-center justify-center text-gray-400 font-bold text-lg">
                        2
                    </div>
                    <p class="step-label mt-3 text-sm font-medium text-gray-500">Dispositivo</p>
                    <div class="step-line absolute top-6 left-1/2 w-full h-0.5 bg-gray-200 -z-10 hidden md:block"></div>
                </div>
                <div id="step-3" class="step flex flex-col items-center relative">
                    <div class="step-circle w-12 h-12 rounded-full border-2 border-gray-300 bg-white flex items-center justify-center text-gray-400 font-bold text-lg">
                        3
                    </div>
                    <p class="step-label mt-3 text-sm font-medium text-gray-500">Fecha & Hora</p>
                    <div class="step-line absolute top-6 left-1/2 w-full h-0.5 bg-gray-200 -z-10 hidden md:block"></div>
                </div>
                <div id="step-4" class="step flex flex-col items-center">
                    <div class="step-circle w-12 h-12 rounded-full border-2 border-gray-300 bg-white flex items-center justify-center text-gray-400 font-bold text-lg">
                        4
                    </div>
                    <p class="step-label mt-3 text-sm font-medium text-gray-500">Confirmar</p>
                </div>
            </div>

            <div id="view-step-1">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Selecciona el Servicio</h2>
                <div id="error-step-1" class="hidden mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded flex items-center gap-2">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <span>Por favor selecciona un servicio para continuar</span>
                </div>
                <div id="cards" class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <?php foreach ($servicios as $servicio): ?>
                        <?php include __DIR__ . "/../components/scheduleComponents/card-servicio.php"; ?>
                    <?php endforeach; ?>
                </div>
                <div class="flex justify-end mt-8">
                    <button type="button" onclick="goToStep(2)" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 font-semibold shadow-lg flex items-center gap-2">
                        Siguiente <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div id="view-step-2" class="hidden">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Selecciona tu Dispositivo</h2>
                <div id="error-step-2" class="hidden mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded flex items-center gap-2">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <span>Por favor selecciona el modelo de tu dispositivo</span>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <label class="flex items-center gap-2 font-semibold text-gray-700 mb-3">
                        <i class="fa-solid fa-mobile-screen text-red-600"></i>
                        Modelo de Dispositivo
                    </label>
                    <select id="modelo" class="border-2 border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition w-full text-gray-700 bg-white">
                        <option value="">-- Selecciona tu modelo --</option>
                        <?php foreach ($modelos as $modelo): ?>
                            <option value="<?= $modelo->getId() ?>">
                                <?= htmlspecialchars($modelo->getMarca()) ?> - <?= htmlspecialchars($modelo->getModelo()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex justify-between mt-8">
                    <button type="button" onclick="goToStep(1)" class="bg-white border-2 border-gray-300 px-6 py-3 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Atrás
                    </button>
                    <button type="button" onclick="goToStep(3)" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 font-semibold shadow-lg flex items-center gap-2">
                        Siguiente <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div id="view-step-3" class="hidden">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Fecha y Hora de tu Cita</h2>
                <div id="error-step-3" class="hidden mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded flex items-center gap-2">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <span id="error-step-3-text">Por favor selecciona fecha y hora</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <label class="flex items-center gap-2 font-semibold text-gray-700 mb-3">
                            <i class="fa-regular fa-calendar text-red-600"></i>
                            Fecha Deseada
                        </label>
                        <input type="date" id="fecha" class="border-2 border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition w-full bg-white">
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <label class="flex items-center gap-2 font-semibold text-gray-700 mb-3">
                            <i class="fa-regular fa-clock text-red-600"></i>
                            Hora Preferida
                        </label>
                        <select id="hora" class="border-2 border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition w-full bg-white">
                            <option value="">-- Selecciona una hora --</option>
                            <option value="09:00:00">09:00 AM</option>
                            <option value="10:00:00">10:00 AM</option>
                            <option value="11:00:00">11:00 AM</option>
                            <option value="12:00:00">12:00 PM</option>
                            <option value="13:00:00">01:00 PM</option>
                            <option value="14:00:00">02:00 PM</option>
                            <option value="15:00:00">03:00 PM</option>
                            <option value="16:00:00">04:00 PM</option>
                            <option value="17:00:00">05:00 PM</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-8">
                    <button type="button" onclick="goToStep(2)" class="bg-white border-2 border-gray-300 px-6 py-3 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Atrás
                    </button>
                    <button type="button" onclick="goToStep(4)" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 font-semibold shadow-lg flex items-center gap-2">
                        Siguiente <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div id="view-step-4" class="hidden">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Describe el Problema</h2>
                <div id="error-step-4" class="hidden mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded flex items-center gap-2">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <span>Por favor describe el problema (mínimo 10 caracteres)</span>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <label class="flex items-center gap-2 font-semibold text-gray-700 mb-3">
                        <i class="fa-solid fa-comment-dots text-red-600"></i>
                        Detalles del Problema
                    </label>
                    <textarea id="descripcion" class="border-2 border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition w-full bg-white resize-none" rows="6" placeholder="Ejemplo: La pantalla está rota, no enciende el dispositivo, la batería dura poco, etc."></textarea>
                    <p class="text-sm text-gray-500 mt-2">
                        <span id="char-count">0</span> / 500 caracteres
                    </p>
                </div>
                <div class="flex justify-between items-center mt-8">
                    <button type="button" onclick="goToStep(3)" class="bg-white border-2 border-gray-300 px-6 py-3 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Atrás
                    </button>
                    <button type="button" onclick="finalizarCita()" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 font-semibold shadow-lg flex items-center gap-2">
                        <i class="fa-solid fa-check-circle"></i> Confirmar Cita
                    </button>
                </div>
            </div>
        </div>
        
        </form>

    </div>
</section>

<script>
let servicioSeleccionado = null;

function selectCard(card) {
    document.querySelectorAll('.card-servicio').forEach(c => {
        c.classList.remove('bg-red-100', 'border-red-600', 'shadow-lg');
        c.classList.add('border-gray-300');
    });
    card.classList.add('bg-red-100', 'border-red-600', 'shadow-lg');
    card.classList.remove('border-gray-300');
    
    servicioSeleccionado = card.dataset.servicioId;
    document.getElementById('servicio_id').value = servicioSeleccionado;
    hideError('error-step-1');
}

function hideError(errorId) {
    const errorDiv = document.getElementById(errorId);
    if(errorDiv) {
        errorDiv.classList.add('hidden');
    }
}

function showError(errorId, message = null) {
    const errorDiv = document.getElementById(errorId);
    if(errorDiv) {
        if(message) {
            const textSpan = errorDiv.querySelector('span');
            if(textSpan) textSpan.textContent = message;
        }
        errorDiv.classList.remove('hidden');
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function validateStep1() {
    if(!servicioSeleccionado) {
        showError('error-step-1');
        return false;
    }
    return true;
}

function validateStep2() {
    const modelo = document.getElementById('modelo').value;
    if(!modelo) {
        showError('error-step-2');
        return false;
    }
    document.getElementById('modelo_id_hidden').value = modelo;
    return true;
}

function validateStep3() {
    const fecha = document.getElementById('fecha').value;
    const hora = document.getElementById('hora').value;
    
    if(!fecha || !hora) {
        showError('error-step-3', 'Por favor selecciona fecha y hora');
        return false;
    }
    
    const fechaSeleccionada = new Date(fecha);
    const hoy = new Date();
    hoy.setHours(0, 0, 0, 0);
    
    if(fechaSeleccionada < hoy) {
        showError('error-step-3', 'La fecha no puede ser anterior a hoy');
        return false;
    }
    
    const diasSemana = fechaSeleccionada.getDay();
    if(diasSemana === 0 || diasSemana === 6) {
        showError('error-step-3', 'No trabajamos los fines de semana. Selecciona un día entre lunes y viernes');
        return false;
    }
    
    document.getElementById('fecha_hidden').value = fecha;
    document.getElementById('hora_hidden').value = hora;
    return true;
}

function validateStep4() {
    const descripcion = document.getElementById('descripcion').value.trim();
    
    if(!descripcion) {
        showError('error-step-4', 'Por favor describe el problema');
        return false;
    }
    
    if(descripcion.length < 10) {
        showError('error-step-4', 'La descripción debe tener al menos 10 caracteres');
        return false;
    }
    
    if(descripcion.length > 500) {
        showError('error-step-4', 'La descripción no puede exceder 500 caracteres');
        return false;
    }
    
    document.getElementById('descripcion_hidden').value = descripcion;
    return true;
}

function goToStep(step) {
    const currentStep = getCurrentStep();
    
    if(step > currentStep) {
        if(currentStep === 1 && !validateStep1()) return;
        if(currentStep === 2 && !validateStep2()) return;
        if(currentStep === 3 && !validateStep3()) return;
    }
    
    hideError('error-step-1');
    hideError('error-step-2');
    hideError('error-step-3');
    hideError('error-step-4');
    
    document.querySelectorAll('[id^="view-step"]').forEach(view => view.classList.add('hidden'));
    document.getElementById(`view-step-${step}`).classList.remove('hidden');
    
    updateStepIndicators(step);
}

function getCurrentStep() {
    for(let i = 1; i <= 4; i++) {
        if(!document.getElementById(`view-step-${i}`).classList.contains('hidden')) {
            return i;
        }
    }
    return 1;
}

function updateStepIndicators(step) {
    document.querySelectorAll('.step').forEach((s, index) => {
        const circle = s.querySelector('.step-circle');
        const label = s.querySelector('.step-label');
        const stepNum = index + 1;
        
        circle.classList.remove('bg-red-600', 'text-white', 'border-2', 'border-gray-300', 'text-gray-400', 'bg-white');
        label.classList.remove('text-red-700', 'text-gray-500', 'font-semibold', 'font-medium');
        
        if(stepNum === step) {
            circle.classList.add('bg-red-600', 'text-white');
            label.classList.add('text-red-700', 'font-semibold');
        } else {
            circle.classList.add('border-2', 'border-gray-300', 'text-gray-400', 'bg-white');
            label.classList.add('text-gray-500', 'font-medium');
        }
    });
}

function finalizarCita() {
    if(!validateStep4()) return;
    
    const btn = event.target;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Procesando...';
    
    document.getElementById('formCita').submit();
}

document.getElementById('descripcion').addEventListener('input', function() {
    const count = this.value.length;
    document.getElementById('char-count').textContent = count;
    
    if(count > 500) {
        this.value = this.value.substring(0, 500);
        document.getElementById('char-count').textContent = 500;
    }
    
    if(count > 0) {
        hideError('error-step-4');
    }
});

document.getElementById('fecha').addEventListener('change', function() {
    if(this.value) {
        hideError('error-step-3');
    }
});

document.getElementById('hora').addEventListener('change', function() {
    if(this.value) {
        hideError('error-step-3');
    }
});

document.getElementById('modelo').addEventListener('change', function() {
    if(this.value) {
        hideError('error-step-2');
    }
});

const today = new Date().toISOString().split('T')[0];
document.getElementById('fecha').setAttribute('min', today);

</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../layout/main.php";
?>
