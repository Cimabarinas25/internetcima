-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS db_cima;
USE db_cima;

-- Crear tabla 'nuevo' para almacenar datos de los usuarios
CREATE TABLE IF NOT EXISTS nuevo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100),
    cedula VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    repeatPassword VARCHAR(255) NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla 'usuarios' para almacenar datos generales de los usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);
