-- --------------------------------------------------------
-- SISTEMA FINANCIERO GRUPO 7 - INSTALACIÓN COMPLETA
-- Base de Datos: sistema_financiero
-- Autoinstalable: Sí (Crea la BD automáticamente)
-- Credenciales Admin: admin@sistema.com / Grupo7ingweb
-- --------------------------------------------------------

-- 1. CREACIÓN DEL ENTORNO (Solución al error #1046)
CREATE DATABASE IF NOT EXISTS `sistema_financiero` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema_financiero`;

-- 2. CONFIGURACIÓN INICIAL
SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- 3. LIMPIEZA DE TABLAS PREVIAS (Para evitar duplicados)
DROP TABLE IF EXISTS transacciones_pasarela;
DROP TABLE IF EXISTS diario_detalles;
DROP TABLE IF EXISTS diario_cabecera;
DROP TABLE IF EXISTS catalogo_cuentas;
DROP TABLE IF EXISTS usuarios;

-- --------------------------------------------------------
-- 4. ESTRUCTURA DE TABLAS
-- --------------------------------------------------------

-- TABLA: USUARIOS
CREATE TABLE `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `rol` ENUM('admin','contador','gerente') DEFAULT 'contador',
  `activo` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLA: CATÁLOGO
CREATE TABLE `catalogo_cuentas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `codigo` VARCHAR(20) UNIQUE NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `tipo` ENUM('Activo','Pasivo','Capital','Ingreso','Gasto','Costo') NOT NULL,
  `naturaleza` ENUM('Deudora','Acreedora') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLA: DIARIO CABECERA (Con Auditoría)
CREATE TABLE `diario_cabecera` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fecha` DATETIME NOT NULL COMMENT 'Fecha manual seleccionada por el usuario',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Auditoría: Fecha real del servidor',
  `usuario_id` INT NOT NULL,
  `descripcion` TEXT NOT NULL,
  `estado` ENUM('abierto','cerrado') DEFAULT 'abierto',
  `firma_digital` VARCHAR(255) DEFAULT NULL,
  KEY `fk_diario_usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLA: DIARIO DETALLES
CREATE TABLE `diario_detalles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `diario_id` INT NOT NULL,
  `cuenta_id` INT NOT NULL,
  `debe` DECIMAL(10,2) DEFAULT '0.00',
  `haber` DECIMAL(10,2) DEFAULT '0.00',
  KEY `fk_detalle_cabecera` (`diario_id`),
  KEY `fk_detalle_cuenta` (`cuenta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLA: PASARELA
CREATE TABLE `transacciones_pasarela` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `monto` DECIMAL(10,2) NOT NULL,
  `concepto` VARCHAR(255) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `asiento_id` INT NOT NULL,
  KEY `fk_pasarela_asiento` (`asiento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 5. RESTRICCIONES (FOREIGN KEYS)
-- --------------------------------------------------------

ALTER TABLE `diario_cabecera`
  ADD CONSTRAINT `fk_diario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `diario_detalles`
  ADD CONSTRAINT `fk_detalle_cabecera` FOREIGN KEY (`diario_id`) REFERENCES `diario_cabecera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_cuenta` FOREIGN KEY (`cuenta_id`) REFERENCES `catalogo_cuentas` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `transacciones_pasarela`
  ADD CONSTRAINT `fk_pasarela_asiento` FOREIGN KEY (`asiento_id`) REFERENCES `diario_cabecera` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- --------------------------------------------------------
-- 6. DATA SEEDING (Datos de Prueba Oficiales)
-- --------------------------------------------------------

-- USUARIOS (Clave: Grupo7ingweb)
INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `activo`) VALUES
(1, 'Administrador', 'admin@sistema.com', '$2y$12$SmEbZaVcLpGOFJkvltUkiuxbCsjtCqqAH2pEIR94FLuDFR2p/N.MG', 'admin', 1),
(2, 'Fernando - Contador', 'contador@sistema.com', '$2y$12$SmEbZaVcLpGOFJkvltUkiuxbCsjtCqqAH2pEIR94FLuDFR2p/N.MG', 'contador', 1),
(3, 'Diego - Gerente', 'gerente@sistema.com', '$2y$12$SmEbZaVcLpGOFJkvltUkiuxbCsjtCqqAH2pEIR94FLuDFR2p/N.MG', 'gerente', 1);

-- CATÁLOGO DE CUENTAS (PDF Examen)
INSERT INTO `catalogo_cuentas` (`id`, `codigo`, `nombre`, `tipo`, `naturaleza`) VALUES
(1, '100.1', 'Banco 1', 'Activo', 'Deudora'),
(2, '100.2', 'Caja General', 'Activo', 'Deudora'),
(3, '104.1', 'Cuentas por Cobrar Clientes', 'Activo', 'Deudora'),
(4, '105.1', 'Inventario Mercancia', 'Activo', 'Deudora'),
(5, '106.1', 'Equipo Rodante (Automóvil)', 'Activo', 'Deudora'),
(6, '106.2', 'Terreno', 'Activo', 'Deudora'),
(7, '106.9', 'Depreciación Acumulada', 'Activo', 'Acreedora'),
(8, '200.1', 'Cuentas por Pagar Proveedores', 'Pasivo', 'Acreedora'),
(9, '200.2', 'Retención Empleado 11%', 'Pasivo', 'Acreedora'),
(10, '200.4', 'ITBMS (Tesoro Nacional)', 'Pasivo', 'Acreedora'),
(11, '300.1', 'Capital Social', 'Capital', 'Acreedora'),
(12, '300.2', 'Utilidad Acumulada', 'Capital', 'Acreedora'),
(13, '400.1', 'Ventas Gravadas 7%', 'Ingreso', 'Acreedora'),
(14, '400.2', 'Ventas Exentas', 'Ingreso', 'Acreedora'),
(15, '402', 'Ingresos Financieros (Intereses)', 'Ingreso', 'Acreedora'),
(16, '500.1', 'Costo de Ventas', 'Costo', 'Deudora'),
(17, '600.1', 'Gasto de Salario', 'Gasto', 'Deudora'),
(18, '600.2', 'Gasto de Luz, Agua y Tel', 'Gasto', 'Deudora'),
(19, '600.5', 'Gasto Honorarios', 'Gasto', 'Deudora'),
(20, '600.6', 'Gasto Alquiler', 'Gasto', 'Deudora'),
(21, '600.7', 'Gasto Depreciación', 'Gasto', 'Deudora');

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;