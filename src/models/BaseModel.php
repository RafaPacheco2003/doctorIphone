<?php

// Clase base para todos los modelos
class BaseModel
{
    // Constructor genérico que acepta un array de datos
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->cargarDatos($data);
        }
    }

    // Cargar datos desde un array
    protected function cargarDatos($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    // Método mágico para getters
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        
        return null;
    }

    // Método mágico para setters
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
            $this->$method($value);
        } elseif (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    // Convertir el modelo a array
    public function toArray()
    {
        $data = [];
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }

    // Convertir a JSON
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
