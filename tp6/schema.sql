-- =====================================================================
-- TP N° 6 · Esquema relacional de Barismo & Café (DDL)
-- Ejecutar en phpMyAdmin (pestaña SQL) o por consola:
--   mysql -u root < schema.sql
-- =====================================================================

CREATE DATABASE IF NOT EXISTS barismo_tp6
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE barismo_tp6;

-- Se borran en orden inverso a las dependencias para poder re-ejecutar el script.
DROP TABLE IF EXISTS inscripciones;
DROP TABLE IF EXISTS talleres;
DROP TABLE IF EXISTS niveles;
DROP TABLE IF EXISTS detalle_pedidos;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS estados_pedido;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;

-- ---------------------------------------------------------------------
-- Tablas maestras / secundarias
-- ---------------------------------------------------------------------

CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL UNIQUE,
  descripcion VARCHAR(120) NOT NULL DEFAULT ''
) ENGINE=InnoDB;

CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(60) NOT NULL UNIQUE,
  descripcion VARCHAR(160) NOT NULL DEFAULT ''
) ENGINE=InnoDB;

CREATE TABLE estados_pedido (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE niveles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Usuarios (autenticación, rol y datos personales)
-- ---------------------------------------------------------------------

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rol_id INT NOT NULL,
  nombre VARCHAR(60) NOT NULL,
  apellido VARCHAR(60) NOT NULL,
  email VARCHAR(120) NOT NULL,
  password VARCHAR(255) NOT NULL,
  telefono VARCHAR(30) NULL,
  activo TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT uq_usuarios_email UNIQUE (email),
  CONSTRAINT fk_usuarios_rol FOREIGN KEY (rol_id)
    REFERENCES roles (id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Tablas principales de negocio
-- ---------------------------------------------------------------------

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  categoria_id INT NOT NULL,
  nombre VARCHAR(120) NOT NULL,
  descripcion VARCHAR(160) NOT NULL DEFAULT '',
  precio DECIMAL(10, 2) NOT NULL,
  stock INT UNSIGNED NOT NULL DEFAULT 0,
  estrellas TINYINT UNSIGNED NOT NULL DEFAULT 5,
  imagen VARCHAR(100) NOT NULL DEFAULT '',
  activo TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT chk_productos_precio CHECK (precio > 0),
  CONSTRAINT chk_productos_estrellas CHECK (estrellas BETWEEN 1 AND 5),
  CONSTRAINT fk_productos_categoria FOREIGN KEY (categoria_id)
    REFERENCES categorias (id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  estado_id INT NOT NULL,
  direccion_envio VARCHAR(160) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_pedidos_usuario FOREIGN KEY (usuario_id)
    REFERENCES usuarios (id) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_pedidos_estado FOREIGN KEY (estado_id)
    REFERENCES estados_pedido (id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE talleres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nivel_id INT NOT NULL,
  nombre VARCHAR(120) NOT NULL,
  fecha DATE NOT NULL,
  cupo TINYINT UNSIGNED NOT NULL DEFAULT 10,
  precio DECIMAL(10, 2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_talleres_nivel FOREIGN KEY (nivel_id)
    REFERENCES niveles (id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Tablas de relación / detalle (N:M)
-- ---------------------------------------------------------------------

-- pedidos N:M productos
CREATE TABLE detalle_pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pedido_id INT NOT NULL,
  producto_id INT NOT NULL,
  cantidad SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  precio_unitario DECIMAL(10, 2) NOT NULL,
  CONSTRAINT uq_detalle_pedido_producto UNIQUE (pedido_id, producto_id),
  CONSTRAINT chk_detalle_cantidad CHECK (cantidad > 0),
  CONSTRAINT fk_detalle_pedido FOREIGN KEY (pedido_id)
    REFERENCES pedidos (id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_detalle_producto FOREIGN KEY (producto_id)
    REFERENCES productos (id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- usuarios N:M talleres
CREATE TABLE inscripciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  taller_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT uq_inscripcion UNIQUE (usuario_id, taller_id),
  CONSTRAINT fk_inscripciones_usuario FOREIGN KEY (usuario_id)
    REFERENCES usuarios (id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_inscripciones_taller FOREIGN KEY (taller_id)
    REFERENCES talleres (id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Índices de rendimiento
-- ---------------------------------------------------------------------

-- La tienda filtra siempre por categoría y solo muestra productos activos.
CREATE INDEX idx_productos_categoria_activo ON productos (categoria_id, activo);
-- Búsqueda de productos por nombre (buscador de la tienda).
CREATE INDEX idx_productos_nombre ON productos (nombre);
-- Listado de pedidos por estado (pendientes, enviados, etc.).
CREATE INDEX idx_pedidos_estado ON pedidos (estado_id, created_at);
-- Búsqueda de usuarios por apellido desde el panel de administración.
CREATE INDEX idx_usuarios_apellido ON usuarios (apellido);
