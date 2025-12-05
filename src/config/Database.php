<?php

require_once __DIR__ . '/Config.php';

class Database
{
    private static $conexion = null;

    // Obtener la conexión
    public static function conectar()
    {
        if (self::$conexion === null) {
            try {
                $host = Config::$db_host;
                $dbname = Config::$db_name;
                $user = Config::$db_user;
                $password = Config::$db_password;

                self::$conexion = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user,
                    $password
                );
                
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        
        return self::$conexion;
    }
}
