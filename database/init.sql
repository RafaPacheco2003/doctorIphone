
CREATE DATABASE IF NOT EXISTS reparacion_celulares;
USE reparacion_celulares;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'cliente') DEFAULT 'cliente',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio_estimado DECIMAL(10,2) DEFAULT 0.00
);

INSERT INTO servicios (nombre, descripcion, precio_estimado)
SELECT * FROM (SELECT 'Cambio de pantalla' AS nombre, 'Reemplazo de pantalla rota o dañada.' AS descripcion, 800.00 AS precio_estimado) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM servicios WHERE nombre = 'Cambio de pantalla')
LIMIT 1;

INSERT INTO servicios (nombre, descripcion, precio_estimado)
SELECT * FROM (SELECT 'Cambio de batería', 'Instalación de una batería nueva.', 500.00) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM servicios WHERE nombre = 'Cambio de batería')
LIMIT 1;

INSERT INTO servicios (nombre, descripcion, precio_estimado)
SELECT * FROM (SELECT 'Problemas de carga', 'Reparación de puerto de carga o fallos eléctricos.', 350.00) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM servicios WHERE nombre = 'Problemas de carga')
LIMIT 1;

INSERT INTO servicios (nombre, descripcion, precio_estimado)
SELECT * FROM (SELECT 'Software y sistema', 'Reinstalación o actualización del sistema.', 200.00) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM servicios WHERE nombre = 'Software y sistema')
LIMIT 1;

INSERT INTO servicios (nombre, descripcion, precio_estimado)
SELECT * FROM (SELECT 'Diagnóstico general', 'Revisión completa del equipo.', 0.00) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM servicios WHERE nombre = 'Diagnóstico general')
LIMIT 1;

CREATE TABLE IF NOT EXISTS modelos_celulares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL
);
INSERT INTO modelos_celulares (marca, modelo)
SELECT * FROM (SELECT 'Apple' AS marca, 'iPhone 11' AS modelo) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM modelos_celulares WHERE marca = 'Apple' AND modelo = 'iPhone 11')
LIMIT 1;

INSERT INTO modelos_celulares (marca, modelo)
SELECT * FROM (SELECT 'Apple', 'iPhone X') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM modelos_celulares WHERE marca = 'Apple' AND modelo = 'iPhone X')
LIMIT 1;


CREATE TABLE IF NOT EXISTS citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    servicio_id INT NOT NULL,
    modelo_id INT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    descripcion TEXT,
    estado ENUM('pendiente','confirmada','cancelada') DEFAULT 'pendiente',
    fecha_creada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (servicio_id) REFERENCES servicios(id),
    FOREIGN KEY (modelo_id) REFERENCES modelos_celulares(id)
);

CREATE TABLE IF NOT EXISTS reparaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cita_id INT NOT NULL,
    estado ENUM('recibido','diagnostico','en_reparacion','listo','entregado') DEFAULT 'recibido',
    notas TEXT,
    costo_final DECIMAL(10,2) NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (cita_id) REFERENCES citas(id)
);
