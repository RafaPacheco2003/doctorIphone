<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ .'../../repositories/ServicioRepository.php';


class ServicioService extends BaseService
{
    private $servicioRepository;

    public function __construct()
    {
        $this->servicioRepository = new ServicioRepository();
    }

    // Métodos del servicio que utilizan el repositorio
    public function obtenerTodosLosServicios()
    {
        return $this->servicioRepository->getAllServicios();
    }

    public function obtenerServicioPorId($id)
    {
        return $this->servicioRepository->getServicioById($id);
    }

    public function crearServicio($servicio)
    {
        return $this->servicioRepository->createServicio($servicio);
    }

    public function actualizarServicio($id, $servicio)
    {
        return $this->servicioRepository->updateServicio($id, $servicio);
    }

    public function eliminarServicio($id)
    {
        return $this->servicioRepository->deleteServicio($id);
    }
}

?>