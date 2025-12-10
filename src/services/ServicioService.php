<?php

require_once __DIR__ . '/BaseServices.php';
require_once __DIR__ . '/../repositories/ServicioRepository.php';

class ServicioService extends BaseServices
{
    public function __construct()
    {
        parent::__construct(new ServicioRepository());
    }

    /**
     * Obtener todos los servicios activos
     * @return array
     */
    public function getAllServicios()
    {
        return $this->getAll();
    }

    /**
     * Obtener un servicio por ID
     * @param int $id
     * @return Servicio|null
     */
    public function getServicioById($id)
    {
        return $this->getById($id);
    }

    /**
     * Crear un nuevo servicio con validación
     * @param array $data
     * @return int|bool
     */
    public function createServicio($data)
    {
        // Validaciones de negocio
        if (empty($data['nombre'])) {
            throw new Exception("El nombre del servicio es obligatorio");
        }

        if (isset($data['precio_estimado']) && $data['precio_estimado'] < 0) {
            throw new Exception("El precio no puede ser negativo");
        }

        return $this->create($data);
    }

    /**
     * Actualizar un servicio existente
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateServicio($id, $data)
    {
        // Verificar que el servicio existe
        $servicio = $this->getById($id);
        if (!$servicio) {
            throw new Exception("Servicio no encontrado");
        }

        // Validaciones
        if (isset($data['precio_estimado']) && $data['precio_estimado'] < 0) {
            throw new Exception("El precio no puede ser negativo");
        }

        return $this->update($id, $data);
    }

    /**
     * Eliminar un servicio
     * @param int $id
     * @return bool
     */
    public function deleteServicio($id)
    {
        // Verificar que el servicio existe
        $servicio = $this->getById($id);
        if (!$servicio) {
            throw new Exception("Servicio no encontrado");
        }

        return $this->delete($id);
    }

    /**
     * Buscar servicios por rango de precio
     * @param float $precioMin
     * @param float $precioMax
     * @return array
     */
    public function getServiciosByPrecioRange($precioMin, $precioMax)
    {
        $todosLosServicios = $this->getAll();
        
        return array_filter($todosLosServicios, function($servicio) use ($precioMin, $precioMax) {
            $precio = $servicio->getPrecioEstimado();
            return $precio >= $precioMin && $precio <= $precioMax;
        });
    }

    /**
     * Obtener servicios ordenados por precio
     * @param string $orden 'asc' o 'desc'
     * @return array
     */
    public function getServiciosOrderByPrecio($orden = 'asc')
    {
        $servicios = $this->getAll();
        
        usort($servicios, function($a, $b) use ($orden) {
            if ($orden === 'desc') {
                return $b->getPrecioEstimado() <=> $a->getPrecioEstimado();
            }
            return $a->getPrecioEstimado() <=> $b->getPrecioEstimado();
        });
        
        return $servicios;
    }
}

?>