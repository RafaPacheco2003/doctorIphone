<?php

require_once __DIR__ . '/BaseServices.php';
require_once __DIR__ . '/../repositories/CitaRepository.php';

class CitaService extends BaseServices
{
    public function __construct()
    {
        parent::__construct(new CitaRepository());
    }

    public function getAllCitas()
    {
        return $this->getAll();
    }

    public function getCitaById($id)
    {
        return $this->getById($id);
    }

    public function createCita($data)
    {
        if (empty($data['usuario_id'])) {
            throw new Exception("El ID del usuario es obligatorio");
        }

        if (empty($data['servicio_id'])) {
            throw new Exception("El servicio es obligatorio");
        }

        if (empty($data['fecha'])) {
            throw new Exception("La fecha es obligatoria");
        }

        if (empty($data['hora'])) {
            throw new Exception("La hora es obligatoria");
        }

        if (!isset($data['estado'])) {
            $data['estado'] = 'pendiente';
        }

        return $this->create($data);
    }

    public function updateCita($id, $data)
    {
        $cita = $this->getById($id);
        if (!$cita) {
            throw new Exception("Cita no encontrada");
        }

        return $this->update($id, $data);
    }

    public function deleteCita($id)
    {
        $cita = $this->getById($id);
        if (!$cita) {
            throw new Exception("Cita no encontrada");
        }

        return $this->delete($id);
    }

    public function getCitasByUsuario($usuario_id)
    {
        return $this->repository->findByUsuarioId($usuario_id);
    }

    public function getCitasByEstado($estado)
    {
        return $this->repository->findByEstado($estado);
    }

    public function getCitasByFecha($fecha)
    {
        return $this->repository->findByFecha($fecha);
    }

    public function confirmarCita($id)
    {
        $cita = $this->getById($id);
        if (!$cita) {
            throw new Exception("Cita no encontrada");
        }

        return $this->update($id, ['estado' => 'confirmada']);
    }

    public function cancelarCita($id)
    {
        $cita = $this->getById($id);
        if (!$cita) {
            throw new Exception("Cita no encontrada");
        }

        return $this->update($id, ['estado' => 'cancelada']);
    }

    public function getCitasPendientes()
    {
        return $this->getCitasByEstado('pendiente');
    }

    public function getCitasConfirmadas()
    {
        return $this->getCitasByEstado('confirmada');
    }

    public function getCitasCanceladas()
    {
        return $this->getCitasByEstado('cancelada');
    }
}
