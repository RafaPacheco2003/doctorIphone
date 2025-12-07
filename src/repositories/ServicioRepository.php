<?php

require_once __DIR__ . '/BaseRepository.php';
require_once __DIR__ . '/../models/Servicio.php';

class ServicioRepository extends BaseRepository
{
    protected $table = 'servicios';

    public function findAll()
    {
       $data = parent::findAll();
        $servicios = [];
        
        foreach ($data as $row) {
            $servicios[] = new Servicio($row);
        }
        
        return $servicios;
    }

    // Obtener un registro por ID
    public function findById($id)
    {
    
        $data = parent::findById($id);
        return $data ? new Servicio($data) : null;
    }

    // Crear un nuevo registro
    public function create($data)
    {
        return parent::create($data);
    }

    // Actualizar un registro
    public function update($id, $data)
    {
       return parent::update($id, $data);
    }

    // Eliminar un registro
    public function delete($id)
    {
        return parent::delete($id);
    }



}


?>