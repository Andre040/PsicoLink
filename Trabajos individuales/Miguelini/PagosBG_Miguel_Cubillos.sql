create database PagosBG_Miguel_Cubillos;
use PagosBG_Miguel_Cubillos;
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


