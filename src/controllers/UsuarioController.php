<?php

require_once __DIR__ . '/../services/UsuarioService.php';
require_once __DIR__ . '/../config/JwtToken.php';

class UsuarioController
{
    private $usuarioService;

    public function __construct(?UsuarioService $usuarioService = null)
    {
        $this->usuarioService = $usuarioService ?? new UsuarioService();
    }

    public function crearTokenYCookie($usuario)
    {
        $payload = [
            'id' => $usuario->getId(),
            'nombre' => $usuario->getNombre(),
            'email' => $usuario->getEmail(),
            'rol' => $usuario->getRol(),
            'exp' => time() + (86400 * 7)
        ];
        
        $token = JwtToken::encode($payload);
        
        setcookie('auth_token', $token, time() + (86400 * 7), '/', '', false, true);
        
        return $token;
    }
    
    public function verificarToken()
    {
        if (!isset($_COOKIE['auth_token'])) {
            return null;
        }
        
        $payload = JwtToken::decode($_COOKIE['auth_token']);
        
        if (!$payload || $payload['exp'] < time()) {
            $this->cerrarSesion();
            return null;
        }
        
        return $payload;
    }
    
    public function cerrarSesion()
    {
        setcookie('auth_token', '', time() - 3600, '/', '', false, true);
        session_destroy();
    }

    public function getAll()
    {
        return $this->usuarioService->getAll();
    }

    public function getById($id)
    {
        return $this->usuarioService->getById($id);
    }

    public function registrarUsuario($data)
    {
        return $this->usuarioService->registrar(
            $data['nombre'] ?? '',
            $data['email'] ?? '',
            $data['telefono'] ?? '',
            $data['password'] ?? '',
            $data['rol'] ?? 'cliente'
        );
    }

    public function loginUsuario($email, $password)
    {
        return $this->usuarioService->login($email, $password);
    }

    public function actualizarUsuario($id, $data)
    {
        return $this->usuarioService->actualizar(
            $id,
            $data['nombre'] ?? '',
            $data['email'] ?? '',
            $data['telefono'] ?? '',
            $data['rol'] ?? null
        );
    }

    public function eliminarUsuario($id)
    {
        return $this->usuarioService->eliminar($id);
    }

    public function cambiarPasswordUsuario($id, $nueva_password)
    {
        return $this->usuarioService->cambiarContrasena($id, $nueva_password);
    }
}