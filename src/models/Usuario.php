<?php

require_once __DIR__ . '/BaseModel.php';

class Usuario extends BaseModel
{
    private $id;
    private $nombre;
    private $email;
    private $telefono;
    private $contrasena;
    private $rol;
    private $fecha_registro;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getFechaRegistro() {
        return $this->fecha_creado;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return $this;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
        return $this;
    }

    public function setRol($rol) {
        if (in_array($rol, ['admin', 'cliente'])) {
            $this->rol = $rol;
        }
        return $this;
    }

    public function setFechaRegistro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
        return $this;
    }

}
?>