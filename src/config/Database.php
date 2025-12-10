<?php

require_once __DIR__ . '/Config.php';

class Database
{
    private static $instance = null;
    private $conexion;

    private function __construct()
    {
        try {
            $host = Config::$db_host;
            $dbname = Config::$db_name;
            $user = Config::$db_user;
            $password = Config::$db_password;

            $this->conexion = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $user,
                $password
            );
            
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Singleton pattern
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    // Obtener la conexión PDO
    public static function conectar()
    {
        return self::getInstance()->getConnection();
    }

    // Método para obtener la conexión
    public function getConnection()
    {
        return $this->conexion;
    }

    // Ejecutar consultas
    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    // Ejecutar consultas sin retorno (INSERT, UPDATE, DELETE)
    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->conexion->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            throw new Exception("Error al ejecutar: " . $e->getMessage());
        }
    }

    // Obtener el último ID insertado
    public function lastInsertId()
    {
        return $this->conexion->lastInsertId();
    }

    // Prevenir clonación
    private function __clone() {}

    // Prevenir deserialización
    public function __wakeup()
    {
        throw new Exception("No se puede deserializar un singleton");
    }
}

