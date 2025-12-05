<?php

require_once __DIR__ . '/BaseModel.php';

class Servicio extends BaseModel
{
    private $id;
    private $nombre;
    private $descripcion;
    private $precio_estimado;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecioEstimado() {
        return $this->precio_estimado;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setPrecioEstimado($precio) {
        $this->precio_estimado = $precio;
        return $this;
    }
}
?>
