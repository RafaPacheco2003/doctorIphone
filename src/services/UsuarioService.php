<?php

require_once __DIR__ . '/BaseServices.php';
require_once __DIR__ . '/../repositories/UsuarioRepository.php';

class UsuarioService extends BaseServices {

    public function __construct() {
        parent::__construct(new UsuarioRepository());
    }

    // Registrar usuario
    public function registrar($nombre, $email, $telefono, $password, $rol = 'cliente')
    {
        if (empty($email) || empty($password)) {
            throw new Exception('Email y contraseña obligatorios');
        }

        if ($this->repository->findByEmail($email)) {
            throw new Exception('Este email ya existe');
        }

        $data = [
            'nombre'     => $nombre,
            'email'      => $email,
            'telefono'   => $telefono,
            'contrasena' => password_hash($password, PASSWORD_DEFAULT),
            'rol'        => $rol
        ];

        return $this->repository->create($data);
    }

    // Login
    public function login($email, $password)
    {
        $usuario = $this->repository->findByEmail($email);

        if (!$usuario || !password_verify($password, $usuario->getContrasena())) {
            throw new Exception('Credenciales inválidas');
        }

        return $usuario;
    }

    // Actualizar usuario
    public function actualizar($id, $nombre, $email, $telefono, $rol = null)
    {
        $usuario = $this->repository->findById($id);

        if (!$usuario) {
            throw new Exception('Usuario no encontrado');
        }

        $data = [
            'nombre'   => $nombre,
            'email'    => $email,
            'telefono' => $telefono,
        ];

        if ($rol !== null) {
            $data['rol'] = $rol;
        }

        return $this->repository->update($id, $data);
    }

    // Cambiar contraseña
    public function cambiarContrasena($id, $nueva)
    {
        if (strlen($nueva) < 6) {
            throw new Exception('Contraseña muy corta');
        }

        $data = [
            'contrasena' => password_hash($nueva, PASSWORD_DEFAULT)
        ];

        return $this->repository->update($id, $data);
    }

    // Eliminar
    public function eliminar($id)
    {
        return $this->repository->delete($id);
    }
}
