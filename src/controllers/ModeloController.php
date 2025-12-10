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

    public function index()
    {
        $modelos = $this->modeloService->getAll();
        $this->response(array_map(fn($m) => $m->toArray(), $modelos));
    }

    public function show($id)
    {
        $modelo = $this->modeloService->getById($id);
        if ($modelo) {
            $this->response($modelo->toArray());
        } else {
            http_response_code(404);
            $this->response(['error' => 'Modelo no encontrado']);
        }
    }

    public function store($data)
    {
        $result = $this->modeloService->create($data);
        if ($result) {
            http_response_code(201);
            $this->response(['success' => true, 'message' => 'Modelo creado exitosamente']);
        } else {
            http_response_code(500);
            $this->response(['error' => 'Error al crear el modelo']);
        }
    }

    public function updateModelo($id, $data)
    {
        $result = $this->modeloService->update($id, $data);
        if ($result) {
            $this->response(['success' => true, 'message' => 'Modelo actualizado exitosamente']);
        } else {
            http_response_code(500);
            $this->response(['error' => 'Error al actualizar el modelo']);
        }
    }

    public function destroy($id)
    {
        $result = $this->modeloService->delete($id);
        if ($result) {
            $this->response(['success' => true, 'message' => 'Modelo eliminado exitosamente']);
        } else {
            http_response_code(500);
            $this->response(['error' => 'Error al eliminar el modelo']);
        }
    }

    private function response($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>
