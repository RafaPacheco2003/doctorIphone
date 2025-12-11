<?php

require_once __DIR__ . '/../services/ModeloService.php';

class ModeloController
{
    private $modeloService;
    
    public function __construct(?ModeloService $modeloService = null)
    {
        $this->modeloService = $modeloService ?? new ModeloService();
    }

    public function getAll()
    {
        return $this->modeloService->getAll();
    }

    public function getById($id)
    {
        return $this->modeloService->getById($id);
    }

    public function createModelo($data)
    {
        return $this->modeloService->create($data);
    }

    public function actualizarModelo($id, $data)
    {
        return $this->modeloService->update($id, $data);
    }

    public function eliminarModelo($id)
    {
        return $this->modeloService->delete($id);
    }

}
?>
