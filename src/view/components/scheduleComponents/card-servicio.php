<div 
    class="card-servicio border border-gray-300 bg-white rounded-lg p-4 flex flex-col cursor-pointer transition"
    onclick="selectCard(this)"
    data-servicio-id="<?= $servicio->getId() ?>"
>
    <h3 class="text-base font-semibold mb-2">
        <?= htmlspecialchars($servicio->getNombre()) ?>
    </h3>

    <span class="text-gray-500">
        $<?= number_format($servicio->getPrecioEstimado(), 2) ?>
    </span>
</div>
            