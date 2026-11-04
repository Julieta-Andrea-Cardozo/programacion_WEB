-- Tabla de usuarios para el login (TP8).
-- Si ya importaste barismo.sql de la Clase 7, ejecutá solo este archivo:
--   mysql -u root < sql/usuarios.sql

USE barismo;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(60) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  rol VARCHAR(20) NOT NULL DEFAULT 'usuario',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT chk_usuarios_rol CHECK (rol IN ('admin', 'usuario'))
) ENGINE=InnoDB;

-- Administrador inicial · email: admin@barismo.com.ar · contraseña: Barismo2026
-- (la contraseña se guarda hasheada con password_hash / bcrypt)
INSERT IGNORE INTO usuarios (nombre, email, password, rol) VALUES
('Julieta', 'admin@barismo.com.ar', '$2y$10$hiMgmBd.DwxCy.aVBa3ZQuqjsomi2TR5p3KGSsG7rtzuYTK83x9ki', 'admin');
