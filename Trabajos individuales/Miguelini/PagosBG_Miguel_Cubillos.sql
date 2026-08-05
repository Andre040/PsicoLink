CREATE DATABASE PagosBG_Miguel_Cubillos;
USE PagosBG_Miguel_Cubillos;

CREATE TABLE clientes(
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  ciudad VARCHAR(40) DEFAULT 'Bogota',
  localidad VARCHAR(40),
  fecha_registro DATE NOT NULL,
  id_referido DATE NOT NULL
);

CREATE TABLE cuentas(
  id_cuenta INT AUTO_INCREMENT PRIMARY KEY,
  id_cliente INT NOT NULL,
  saldo DECIMAL(12,2) DEFAULT 0.00,
  tipo_cuenta VARCHAR(20) DEFAULT 'Ahorro digital',
  FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

CREATE TABLE comercios(
  id_comercios INT AUTO_INCREMENT PRIMARY KEY,
  nombre_comercio VARCHAR(60) NOT NULL,
  categoria VARCHAR(30),
  ciudad VARCHAR(40)
);

CREATE TABLE transacciones(
id_transacciones INT AUTO_INCREMENT PRIMARY KEY,
id_cuenta INT NOT NULL,
id_comercio INT,
valor DECIMAL(12,2) NOT NULL,
fecha_transaccion DATE NOT NULL,
tipo VARCHAR(20),
FOREIGN KEY (id_cuenta) REFERENCES cuentas(id_cuenta),
FOREIGN KEY (id_comercion) REFERENCES comercios(id_comercio)

);

INSERT INTO clientes (nombre, apellido, ciudad, localidad, fecha) VALUES
('Muricio', 'Torres', 'Bogota', 'Suba', '2026-01-29'),
('Camilo', 'Jimenez', 'Bogota', 'Kennedy', '2026-11-18'),
('Juliana', 'Martinez', 'Bogota', 'Usaquen', '2026-07-05'),
('Santiago', 'Gomez', 'Bogota', 'Engativa', '2026-04-12');

INSERT INTO comercios (nombre_comercio, categoria, ciudad) VALUES
('Rappi', 'Domicilios', 'Bogota'),
('Exito Chapinero', 'Supermercado', 'Bogota'),
('D1 Suba', 'Tienda de descuento', 'Bogota'),
('EDS Terpel Autopista', 'Combustible', 'Bogota');

SELECT id_transaccion, valor, fecha_transaccion FROM transacciones
WHERE valor > 30000 AND tipo = 'Pago';
DELETE FROM clientes WHERE id_clientes = 5;

INSERT INTO clientes (nombre, apellido, ciudad, localidad, fecha_registro)
VALUES ('Sergio', 'Castaneda', 'Bogota', 'Engativa', '2026-02-10');
SELECT id_cliente, saldo FROM cuentas
WHERE saldo>100000;
DELETE FROM comercios WHERE categoria = 'combustible'