<?php

require_once __DIR__ . '/BaseModel.php';

class Cita extends BaseModel
{
    private $id;
    private $usuario_id;
    private $servicio_id;
    private $modelo_id;
    private $fecha;
    private $hora;
    private $descripcion;
    private $estado;
    private $fecha_creada;
    
    private $usuario_nombre;
    private $servicio_nombre;
    private $modelo_nombre;

    public function getId() {
        return $this->id;
    }

    public function getUsuarioId() {
        return $this->usuario_id;
    }

    public function getServicioId() {
        return $this->servicio_id;
    }

    public function getModeloId() {
        return $this->modelo_id;
    }
    
    public function getUsuarioNombre() {
        return $this->usuario_nombre;
    }
    
    public function getServicioNombre() {
        return $this->servicio_nombre;
    }
    
    public function getModeloNombre() {
        return $this->modelo_nombre;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFechaCreada() {
        return $this->fecha_creada;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function setServicioId($servicio_id) {
        $this->servicio_id = $servicio_id;
        return $this;
    }

    public function setModeloId($modelo_id) {
        $this->modelo_id = $modelo_id;
        return $this;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
        return $this;
    }

    public function setHora($hora) {
        $this->hora = $hora;
        return $this;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setEstado($estado) {
        if (in_array($estado, ['pendiente', 'confirmada', 'cancelada'])) {
            $this->estado = $estado;
        }
        return $this;
    }

    public function setFechaCreada($fecha_creada) {
        $this->fecha_creada = $fecha_creada;
        return $this;
    }
    
    public function setUsuarioNombre($usuario_nombre) {
        $this->usuario_nombre = $usuario_nombre;
        return $this;
    }
    
    public function setServicioNombre($servicio_nombre) {
        $this->servicio_nombre = $servicio_nombre;
        return $this;
    }
    
    public function setModeloNombre($modelo_nombre) {
        $this->modelo_nombre = $modelo_nombre;
        return $this;
    }

    public function isPendiente() {
        return $this->estado === 'pendiente';
    }

    public function isConfirmada() {
        return $this->estado === 'confirmada';
    }

    public function isCancelada() {
        return $this->estado === 'cancelada';
    }

    public function confirmar() {
        $this->estado = 'confirmada';
        return $this;
    }

    public function cancelar() {
        $this->estado = 'cancelada';
        return $this;
    }

    public function getFechaHoraCompleta() {
        return $this->fecha . ' ' . $this->hora;
    }
}
?>
