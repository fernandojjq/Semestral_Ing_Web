-- Base de datos: sistema_financiero
CREATE DATABASE IF NOT EXISTS sistema_financiero;
USE sistema_financiero;

-- 1. Tabla usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'contador', 'gerente') NOT NULL,
    activo TINYINT(1) DEFAULT 1
);

-- 2. Tabla catalogo_cuentas
CREATE TABLE IF NOT EXISTS catalogo_cuentas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    tipo ENUM('Activo', 'Pasivo', 'Capital', 'Ingreso', 'Gasto', 'Costo') NOT NULL,
    naturaleza ENUM('Deudora', 'Acreedora') NOT NULL
);

-- 3. Tabla diario_cabecera
CREATE TABLE IF NOT EXISTS diario_cabecera (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    usuario_id INT NOT NULL,
    descripcion TEXT,
    estado ENUM('abierto', 'cerrado') DEFAULT 'abierto',
    firma_digital VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- 4. Tabla diario_detalles
CREATE TABLE IF NOT EXISTS diario_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    diario_id INT NOT NULL,
    cuenta_id INT NOT NULL,
    debe DECIMAL(10, 2) DEFAULT 0.00,
    haber DECIMAL(10, 2) DEFAULT 0.00,
    FOREIGN KEY (diario_id) REFERENCES diario_cabecera(id),
    FOREIGN KEY (cuenta_id) REFERENCES catalogo_cuentas(id)
);

-- 5. Tabla transacciones_pasarela
CREATE TABLE IF NOT EXISTS transacciones_pasarela (
    id INT AUTO_INCREMENT PRIMARY KEY,
    monto DECIMAL(10, 2) NOT NULL,
    concepto VARCHAR(255) NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    asiento_id INT,
    FOREIGN KEY (asiento_id) REFERENCES diario_cabecera(id)
);

-- DATA SEEDING

-- Usuarios
-- Admin: admin / Grupo7ingweb
INSERT INTO usuarios (nombre, email, password, rol, activo) VALUES 
('Administrador', 'admin@sistema.com', '$2y$12$uC412faEnjebqd/zQ6Q2WO12vlm4f9UQ/D9ce4A.O3T37CD49d5r2', 'admin', 1);

-- Gerente: gerente / root2514
INSERT INTO usuarios (nombre, email, password, rol, activo) VALUES 
('Gerente General', 'gerente@sistema.com', '$2y$12$uC412faEnjebqd/zQ6Q2WO12vlm4f9UQ/D9ce4A.O3T37CD49d5r2', 'gerente', 1);

-- Catálogo Base
INSERT INTO catalogo_cuentas (codigo, nombre, tipo, naturaleza) VALUES
('100', 'Activos', 'Activo', 'Deudora'),
('101', 'Caja', 'Activo', 'Deudora'),
('102', 'Banco', 'Activo', 'Deudora'),
('103', 'Cuentas por Cobrar', 'Activo', 'Deudora'),
('200', 'Pasivos', 'Pasivo', 'Acreedora'),
('201', 'Cuentas por Pagar', 'Pasivo', 'Acreedora'),
('300', 'Capital', 'Capital', 'Acreedora'),
('400', 'Ingresos', 'Ingreso', 'Acreedora'),
('401', 'Ventas', 'Ingreso', 'Acreedora'),
('500', 'Costos', 'Costo', 'Deudora'),
('600', 'Gastos', 'Gasto', 'Deudora'),
('601', 'Luz', 'Gasto', 'Deudora'),
('602', 'Agua', 'Gasto', 'Deudora'),
('603', 'Salarios', 'Gasto', 'Deudora');
