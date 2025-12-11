<?php

require_once __DIR__ . '/BaseRepository.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioRepository extends BaseRepository
{
    protected $table = 'usuarios';

    // Buscar usuario por email
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $stmt = $this->db->query($sql, ['email' => $email]);
        $data = $stmt->fetch();
        
        return $data ? new Usuario($data) : null;
    }

    // Buscar usuario por teléfono
    public function findByTelefono($telefono)
    {
        $sql = "SELECT * FROM {$this->table} WHERE telefono = :telefono";
        $stmt = $this->db->query($sql, ['telefono' => $telefono]);
        $data = $stmt->fetch();
        
        return $data ? new Usuario($data) : null;
    }

    // Obtener usuario por ID (sobrescribir para retornar objeto Usuario)
    public function findById($id)
    {
        $data = parent::findById($id);
        return $data ? new Usuario($data) : null;
    }

    // Obtener todos los usuarios (retornar array de objetos Usuario)
    public function findAll()
    {
        $data = parent::findAll();
        $usuarios = [];
        
        foreach ($data as $row) {
            $usuarios[] = new Usuario($row);
        }
        
        return $usuarios;
    }

    // Crear un nuevo usuario
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

    public function findByRol($rol)
    {
        $sql = "SELECT * FROM {$this->table} WHERE rol = :rol";
        $stmt = $this->db->query($sql, ['rol' => $rol]);
        $data = $stmt->fetchAll();
        
        $usuarios = [];
        foreach ($data as $row) {
            $usuarios[] = new Usuario($row);
        }
        
        return $usuarios;
    }


}
?>