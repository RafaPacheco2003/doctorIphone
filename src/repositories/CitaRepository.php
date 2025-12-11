<?php

require_once __DIR__ . '/BaseRepository.php';
require_once __DIR__ . '/../models/Cita.php';

class CitaRepository extends BaseRepository
{
    protected $table = 'citas';
    
    public function findAll()
    {
        $sql = "SELECT c.*, u.nombre as usuario_nombre, s.nombre as servicio_nombre, m.modelo as modelo_nombre 
                FROM {$this->table} c
                LEFT JOIN usuarios u ON c.usuario_id = u.id
                LEFT JOIN servicios s ON c.servicio_id = s.id
                LEFT JOIN modelos_celulares m ON c.modelo_id = m.id
                ORDER BY c.fecha_creada DESC";
        
        $stmt = $this->db->query($sql);
        $data = $stmt->fetchAll();
        
        $citas = [];
        foreach ($data as $row) {
            $citas[] = new Cita($row);
        }
        
        return $citas;
    }

    public function findById($id)
    {
        $data = parent::findById($id);
        return $data ? new Cita($data) : null;
    }

    public function create($data)
    {
        return parent::create($data);
    }

    public function update($id, $data)
    {
        return parent::update($id, $data);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }

    public function findByUsuarioId($usuario_id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE usuario_id = :usuario_id ORDER BY fecha DESC, hora DESC";
        $stmt = $this->db->query($sql, ['usuario_id' => $usuario_id]);
        $data = $stmt->fetchAll();
        
        $citas = [];
        foreach ($data as $row) {
            $citas[] = new Cita($row);
        }
        
        return $citas;
    }

    public function findByEstado($estado)
    {
        $sql = "SELECT * FROM {$this->table} WHERE estado = :estado ORDER BY fecha DESC, hora DESC";
        $stmt = $this->db->query($sql, ['estado' => $estado]);
        $data = $stmt->fetchAll();
        
        $citas = [];
        foreach ($data as $row) {
            $citas[] = new Cita($row);
        }
        
        return $citas;
    }

    public function findByFecha($fecha)
    {
        $sql = "SELECT * FROM {$this->table} WHERE fecha = :fecha ORDER BY hora ASC";
        $stmt = $this->db->query($sql, ['fecha' => $fecha]);
        $data = $stmt->fetchAll();
        
        $citas = [];
        foreach ($data as $row) {
            $citas[] = new Cita($row);
        }
        
        return $citas;
    }
}
