-- Base de datos del sitio Barismo & Café (Clase 7 - TP7)
-- Importar en phpMyAdmin o con: mysql -u root < sql/barismo.sql

CREATE DATABASE IF NOT EXISTS barismo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE barismo;

CREATE TABLE IF NOT EXISTS productos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  categoria ENUM('grano', 'insumo') NOT NULL DEFAULT 'grano',
  meta VARCHAR(120) NOT NULL DEFAULT '',
  notas VARCHAR(160) NOT NULL DEFAULT '',
  precio INT UNSIGNED NOT NULL DEFAULT 0,
  estrellas TINYINT UNSIGNED NOT NULL DEFAULT 5,
  imagen VARCHAR(100) NOT NULL DEFAULT '',
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO productos (nombre, categoria, meta, notas, precio, estrellas, imagen) VALUES
('Ethiopia Yirgacheffe', 'grano', 'África · Lavado · 250 g', 'Jazmín · Durazno · Limón', 4200, 5, 'grano-etiopia.jpg'),
('Colombia Huila', 'grano', 'América · Natural · 250 g', 'Caramelo · Uva · Chocolate', 3800, 5, 'grano-colombia.jpg'),
('Guatemala Antigua', 'grano', 'América · Honey · 250 g', 'Nuez · Canela · Miel', 3400, 4, 'grano-guatemala.jpg'),
('Brasil Cerrado', 'grano', 'América · Natural · 250 g', 'Chocolate · Avellana · Bajo', 2900, 4, 'grano-brasil.jpg'),
('Molino de Disco Cerámico', 'insumo', 'Molienda', '40 graduaciones, ideal para espresso y filtrado', 38000, 5, 'insumo-molino.jpg'),
('Kit Barista Inicial', 'insumo', 'Accesorios', 'Tamper, jarra y tabla de golpes', 12500, 4, 'insumo-kit.jpg'),
('Tamper 58 mm Acero', 'insumo', 'Espresso', 'Base plana y mango ergonómico', 8900, 5, 'insumo-portafiltro.jpg'),
('Box Mensual Barismo', 'insumo', 'Suscripción', 'Dos orígenes sorpresa por mes', 7500, 5, 'insumo-bolsa.jpg');
