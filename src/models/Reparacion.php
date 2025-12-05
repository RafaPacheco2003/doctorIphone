<?php

require_once __DIR__ . '/BaseModel.php';

class Reparacion extends BaseModel
{
    private $id;
    private $cita_id;
    private $estado; // Enum: 'recibido', 'diagnostico', 'en_reparacion', 'listo', 'entregado'
    private $notas;
    private $costo_final;
    private $fecha_actualizacion;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getCitaId() {
        return $this->cita_id;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getNotas() {
        return $this->notas;
    }

    public function getCostoFinal() {
        return $this->costo_final;
    }

    public function getFechaActualizacion() {
        return $this->fecha_actualizacion;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCitaId($cita_id) {
        $this->cita_id = $cita_id;
        return $this;
    }

    public function setEstado($estado) {
        $estados_validos = ['recibido', 'diagnostico', 'en_reparacion', 'listo', 'entregado'];
        if (in_array($estado, $estados_validos)) {
            $this->estado = $estado;
        }
        return $this;
    }

    public function setNotas($notas) {
        $this->notas = $notas;
        return $this;
    }

    public function setCostoFinal($costo_final) {
        $this->costo_final = $costo_final;
        return $this;
    }

    public function setFechaActualizacion($fecha_actualizacion) {
        $this->fecha_actualizacion = $fecha_actualizacion;
        return $this;
    }

    // Métodos de utilidad para verificar estado
    public function isRecibido() {
        return $this->estado === 'recibido';
    }

    public function isDiagnostico() {
        return $this->estado === 'diagnostico';
    }

    public function isEnReparacion() {
        return $this->estado === 'en_reparacion';
    }

    public function isListo() {
        return $this->estado === 'listo';
    }

    public function isEntregado() {
        return $this->estado === 'entregado';
    }

    // Métodos para cambiar estado
    public function marcarRecibido() {
        $this->estado = 'recibido';
        return $this;
    }

    public function marcarDiagnostico() {
        $this->estado = 'diagnostico';
        return $this;
    }

    public function marcarEnReparacion() {
        $this->estado = 'en_reparacion';
        return $this;
    }

    public function marcarListo() {
        $this->estado = 'listo';
        return $this;
    }

    public function marcarEntregado() {
        $this->estado = 'entregado';
        return $this;
    }

    // Agregar nota
    public function agregarNota($nueva_nota) {
        if ($this->notas) {
            $this->notas .= "\n" . date('Y-m-d H:i:s') . ": " . $nueva_nota;
        } else {
            $this->notas = date('Y-m-d H:i:s') . ": " . $nueva_nota;
        }
        return $this;
    }

    // Obtener el estado en formato legible
    public function getEstadoLegible() {
        $estados = [
            'recibido' => 'Recibido',
            'diagnostico' => 'En Diagnóstico',
            'en_reparacion' => 'En Reparación',
            'listo' => 'Listo para Entrega',
            'entregado' => 'Entregado'
        ];
        return $estados[$this->estado] ?? $this->estado;
    }
}
?>
