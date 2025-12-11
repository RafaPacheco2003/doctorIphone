<?php

require_once __DIR__ . '/BaseModel.php';

class ModeloCelular extends BaseModel
{
    private $id;
    private $marca;
    private $modelo;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getModelo() {
        return $this->modelo;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
        return $this;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
        return $this;
    }

    public function getNombreCompleto() {
        return $this->marca . ' ' . $this->modelo;
    }
}
?>
