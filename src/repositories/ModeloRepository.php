<?php

require_once __DIR__ . '/BaseRepository.php';
require_once __DIR__ . '/../models/ModeloCelular.php';

class ModeloRepository extends BaseRepository
{
    protected $table = 'modelos_celulares';
    
    public function findAll()
    {
       $data = parent::findAll();
        $modelos = [];
        
        foreach ($data as $row) {
            $modelos[] = new ModeloCelular($row);
        }
        
        return $modelos;
    }

    public function findById($id)
    {
    
        $data = parent::findById($id);
        return $data ? new ModeloCelular($data) : null;
    }

    public function create($data)
    {
        return parent::create($data);
    }

    public function update($id, $data)
    {
       return parent::update($id, $data);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }
    
}

?>