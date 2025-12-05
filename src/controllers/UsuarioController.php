<?php

require_once __DIR__ . '/../services/UsuarioService.php';

class UsuarioController
{
    private $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
    }

    // Obtener todos los usuarios
    public function index()
    {
        $usuarios = $this->usuarioService->getAll();
        $this->response(array_map(fn($u) => $u->toArray(), $usuarios));
    }

    // Obtener usuario por ID
    public function show($id)
    {
        $usuario = $this->usuarioService->getById($id);
        
        if (!$usuario) {
            $this->response(['error' => 'Usuario no encontrado'], 404);
            return;
        }

        $this->response($usuario->toArray());
    }

    // Crear usuario
    public function store($data)
    {
        $id = $this->usuarioService->registrar(
            $data['nombre'] ?? '',
            $data['email'] ?? '',
            $data['telefono'] ?? '',
            $data['password'] ?? '',
            $data['rol'] ?? 'cliente'
        );

        $this->response(['id' => $id, 'message' => 'Usuario creado'], 201);
    }

    // Actualizar usuario
    public function update($id, $data)
    {
        $this->usuarioService->actualizar(
            $id,
            $data['nombre'] ?? '',
            $data['email'] ?? '',
            $data['telefono'] ?? '',
            $data['rol'] ?? null
        );

        $this->response(['message' => 'Usuario actualizado']);
    }

    // Eliminar usuario
    public function delete($id)
    {
        $this->usuarioService->eliminar($id);
        $this->response(['message' => 'Usuario eliminado']);
    }

    // Cambiar contraseña
    public function cambiarPassword($id, $data)
    {
        $this->usuarioService->cambiarContrasena($id, $data['nueva_password'] ?? '');
        $this->response(['message' => 'Contraseña actualizada']);
    }

    // Respuesta JSON
    private function response($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>

