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

INSERT INTO transacciones (id_cuenta, id_comercios, valor, fecha_transaccion, tipo) VALUES
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

SELECT SUM(valor) AS total_rappi FROM transacciones
WHERE id_comercios = 1;

SELECT COUNT(*) AS total_clientes
FROM clientes;

SELECT SUM(valor) AS total_valor
FROM transacciones;

SELECT AVG(saldo) AS saldo_promedio
FROM cuentas;

