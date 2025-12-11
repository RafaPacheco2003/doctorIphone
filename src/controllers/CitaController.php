<?php

require_once __DIR__ . '/../services/CitaService.php';

class CitaController
{
    private $citaService;
    
    public function __construct(?CitaService $citaService = null)
    {
        $this->citaService = $citaService ?? new CitaService();
    }

    public function getAll()
    {
        return $this->citaService->getAll();
    }

    public function getById($id)
    {
        return $this->citaService->getById($id);
    }

    public function createCita($data)
    {
        return $this->citaService->create($data);
    }

    public function actualizarCita($id, $data)
    {
        return $this->citaService->update($id, $data);
    }

    public function eliminarCita($id)
    {
        return $this->citaService->delete($id);
    }

    public function getCitasByUsuario($usuario_id)
    {
        return $this->citaService->getCitasByUsuario($usuario_id);
    }

    public function confirmarCita($id)
    {
        return $this->citaService->confirmarCita($id);
    }

    public function cancelarCita($id)
    {
        return $this->citaService->cancelarCita($id);
    }

    public function getCitasPendientes()
    {
        return $this->citaService->getCitasPendientes();
    }
}
