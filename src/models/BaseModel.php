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
            // Ignorar índices numéricos (solo procesar claves asociativas)
            if (is_numeric($key)) {
                continue;
            }
            
            // Usar el setter si existe, si no, asignar directamente la propiedad
            $this->fillAttribute($key, $value);
        }
    }

    // Método mágico para getters
    public function __get($name)
    {
        $camel = str_replace('_', '', ucwords($name, '_'));
        $method = 'get' . $camel;
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
        // Delegate to helper that prefers setters then direct assignment
        $this->fillAttribute($name, $value);
    }

    // Helper: try setter then direct property assignment
    protected function fillAttribute(string $name, $value): void
    {
        // Build possible setter names (snake_case and camelCase)
        $camel = str_replace('_', '', ucwords($name, '_'));
        $setterVariants = [
            'set' . $camel,
            'set' . ucfirst($name),
        ];

        foreach ($setterVariants as $setter) {
            if (method_exists($this, $setter)) {
                $this->$setter($value);
                return;
            }
        }

        // If property exists on the object, assign directly (works if protected/public)
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return;
        }

        // Fallback: try setting camelCase property (some models may use camelCase)
        $camelProp = lcfirst($camel);
        if (property_exists($this, $camelProp)) {
            $this->$camelProp = $value;
            return;
        }

        // Last resort: create a dynamic public property
        $this->$name = $value;
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
