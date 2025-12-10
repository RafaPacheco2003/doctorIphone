<?php

require_once __DIR__ . '/BaseServices.php';
require_once __DIR__ . '/../repositories/ModeloRepository.php';

class ModeloService extends BaseServices
{
    public function __construct()
    {
        parent::__construct(new ModeloRepository());
    }

    public function getAllModelos()
    {
        return $this->getAll();
    }

    public function getModeloById($id)
    {
        return $this->getById($id);
    }

    public function createModelo($data)
    {
        if (empty($data['marca'])) {
            throw new Exception("La marca del modelo es obligatoria");
        }

        if (empty($data['modelo'])) {
            throw new Exception("El nombre del modelo es obligatorio");
        }

        return $this->create($data);
    }

    public function updateModelo($id, $data)
    {
        $modelo = $this->getById($id);
        if (!$modelo) {
            throw new Exception("Modelo no encontrado");
        }

        return $this->update($id, $data);
    }

    public function deleteModelo($id)
    {
        $modelo = $this->getById($id);
        if (!$modelo) {
            throw new Exception("Modelo no encontrado");
        }

        return $this->delete($id);
    }

    public function getModelosByMarca($marca)
    {
        $todosLosModelos = $this->getAll();
        
        return array_filter($todosLosModelos, function($modelo) use ($marca) {
            return strtolower($modelo->getMarca()) === strtolower($marca);
        });
    }

    public function getModelosOrderByMarca($orden = 'asc')
    {
        $modelos = $this->getAll();
        
        usort($modelos, function($a, $b) use ($orden) {
            if ($orden === 'desc') {
                return $b->getMarca() <=> $a->getMarca();
            }
            return $a->getMarca() <=> $b->getMarca();
        });
        
        return $modelos;
    }
}

?>
