<?php

require_once __DIR__ . '/../config/Database.php';

abstract class BaseRepository
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->db->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $data);
        
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $set = [];
        foreach (array_keys($data) as $key) {
            $set[] = "{$key} = :{$key}";
        }
        $set = implode(', ', $set);
        
        $sql = "UPDATE {$this->table} SET {$set} WHERE id = :id";
        $data['id'] = $id;
        
        return $this->db->execute($sql, $data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->db->execute($sql, ['id' => $id]);
    }

    public function count($where = '', $params = [])
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        if ($where) {
            $sql .= " WHERE {$where}";
        }
        $result = $this->db->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
