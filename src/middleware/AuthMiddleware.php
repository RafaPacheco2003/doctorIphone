<?php

class AuthMiddleware
{
    public static function redirigirSiAutenticado()
    {
        require_once __DIR__ . '/../controllers/UsuarioController.php';
        
        $usuarioController = new UsuarioController();
        $usuario = $usuarioController->verificarToken();

        if ($usuario) {
            if ($usuario['rol'] === 'admin') {
                header('Location: /dashboard');
            } else {
                header('Location: /home');
            }
            exit;
        }
    }

    public static function requiereAutenticacion()
    {
        require_once __DIR__ . '/../controllers/UsuarioController.php';
        
        $usuarioController = new UsuarioController();
        $usuario = $usuarioController->verificarToken();

        if (!$usuario) {
            header('Location: /login');
            exit;
        }

        return $usuario;
    }
    
    public static function requiereAdmin()
    {
        require_once __DIR__ . '/../controllers/UsuarioController.php';
        
        $usuarioController = new UsuarioController();
        $usuario = $usuarioController->verificarToken();

        if (!$usuario) {
            header('Location: /login');
            exit;
        }

        if ($usuario['rol'] !== 'admin') {
            header('Location: /home');
            exit;
        }

        return $usuario;
    }
    
    public static function requiereCliente()
    {
        require_once __DIR__ . '/../controllers/UsuarioController.php';
        
        $usuarioController = new UsuarioController();
        $usuario = $usuarioController->verificarToken();

        if (!$usuario) {
            header('Location: /login');
            exit;
        }

        if ($usuario['rol'] !== 'cliente') {
            header('Location: /dashboard');
            exit;
        }

        return $usuario;
    }
}
