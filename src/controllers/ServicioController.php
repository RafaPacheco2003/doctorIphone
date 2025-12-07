<?php

require_once __DIR__ . '/../services/ServicioService.php';

class ServicioController
{
    private $servicioService;
    
    public function __construct(?ServicioService $servicioService = null)
    {
        $this->servicioService = $servicioService ?? new ServicioService();
    }

    public function getAll()
    {
        return $this->servicioService->getAll();
    }

    public function index()
    {
        $servicios = $this->servicioService->getAll();
        $this->response(array_map(fn($s) => $s->toArray(), $servicios));
    }

    public function show($id)
    {
        $servicio = $this->servicioService->getById($id);
        if ($servicio) {
            $this->response($servicio->toArray());
        } else {
            http_response_code(404);
            $this->response(['error' => 'Servicio no encontrado']);
        }
    }

    public function store($data)
    {
        $result = $this->servicioService->create($data);
        if ($result) {
            http_response_code(201);
            $this->response(['success' => true, 'message' => 'Servicio creado exitosamente']);
        } else {
            http_response_code(500);
            $this->response(['error' => 'Error al crear el servicio']);
        }
    }

    public function updateServicio($id, $data)
    {
        $result = $this->servicioService->update($id, $data);
        if ($result) {
            $this->response(['success' => true, 'message' => 'Servicio actualizado exitosamente']);
        } else {
            http_response_code(500);
            $this->response(['error' => 'Error al actualizar el servicio']);
        }
    }

    public function destroy($id)
    {
        $result = $this->servicioService->delete($id);
        if ($result) {
            $this->response(['success' => true, 'message' => 'Servicio eliminado exitosamente']);
        } else {
            http_response_code(500);
            $this->response(['error' => 'Error al eliminar el servicio']);
        }
    }

    private function response($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>