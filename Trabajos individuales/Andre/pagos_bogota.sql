create database pagos_bogota;
use pagos_bogota;
CREATE TABLE clientes (
id_cliente INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
apellido VARCHAR(50) NOT NULL,
ciudad VARCHAR(40) DEFAULT 'Bogota',
localidad VARCHAR(40),
fecha_registro DATE NOT NULL,
fecha date not null
);
CREATE TABLE cuentas (
id_cuenta INT AUTO_INCREMENT PRIMARY KEY,
id_cliente INT NOT NULL,
saldo DECIMAL(12,2) DEFAULT 0.00,
tipo_cuenta VARCHAR(20) DEFAULT 'Ahorro digital',
FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);
CREATE TABLE comercios (
id_comercio INT AUTO_INCREMENT PRIMARY KEY,
nombre_comercio VARCHAR(60) NOT NULL,
categoria VARCHAR(30),
ciudad VARCHAR(40)
);
CREATE TABLE transacciones (
id_transaccion INT AUTO_INCREMENT PRIMARY KEY,
id_cuenta INT NOT NULL,
id_comercio INT,
valor DECIMAL(12,2) NOT NULL,
fecha_transaccion DATE NOT NULL,
tipo VARCHAR(20),
FOREIGN KEY (id_cuenta) REFERENCES cuentas(id_cuenta),
FOREIGN KEY (id_comercio) REFERENCES comercios(id_comercio)
);
	INSERT INTO clientes (nombre, apellido, ciudad, localidad, fecha_registro) VALUES
	('Pedro', 'Rodriguez', 'Bogotá', 'Suba', '2026-01-16'),
	('Mafe', 'Rojas', 'Bogotá', 'Kennedy', '2026-01-18'),
	('Mafo', 'Pérez', 'Bogotá', 'Usaquén', '2026-01-20'),
	('Alejandro', 'Gamez', 'Bogotá', 'Engativá', '2026-01-22');

	INSERT INTO comercios (nombre_comercio, categoria, ciudad) VALUES
	('Rappi', 'Domicilios', 'Bogota'),
	('Éxito Chapinero', 'Supermercado', 'Bogota'),
	('D1 Suba', 'Tienda de descuento', 'Bogota'),
	('EDS Terpel Autopista', 'Combustible', 'Bogota');

	INSERT INTO cuentas (id_cliente, saldo, tipo_cuenta) VALUES
	(1, 150000.00, 'Ahorro digital'),
	(2, 45000.00, 'Ahorro digital'),
	(3, 320000.00, 'Ahorro digital');

	INSERT INTO transacciones (id_cuenta, id_comercio, valor, fecha_transaccion, tipo) VALUES
	(1, 1, 32000.00, '2026-02-01', 'Pago'),
	(1, 2, 68000.00, '2026-02-03', 'Pago'),
	(2, 3, 15000.00, '2026-02-04', 'Pago'),
	(3, 1, 41000.00, '2026-02-05', 'Pago');

SELECT id_transaccion, valor, fecha_transaccion FROM transacciones
WHERE valor > 30000 AND tipo = 'Pago';

INSERT INTO clientes (nombre, apellido, ciudad, localidad, fecha_registro)
VALUES ('Sergio', 'Castaneda', 'Bogota', 'Engativa', '2026-02-10' );

SELECT id_cliente, saldo FROM cuentas
WHERE saldo > 100000;

SELECT nombre, apellido, fecha_registro FROM clientes
ORDER BY fecha_registro DESC
LIMIT 3;
select sum(valor) as total_rappi from transacciones 
where id_comercio=1;
select count(*) as total_clientes
from clientes;
select sum(valor) as total_transacciones
from transacciones;
select avg(valor) as promedio_transacciones
from transacciones;
select avg(saldo) as saldo_promedio
from cuentas;
select max(saldo) as saldo_maximo
from cuentas;
select min(saldo) as saldo_minimo
from cuentas;