CREATE DATABASE PsicoLink;
USE PsicoLink;

CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    Fecha_nacimiento DATE,
    Genero VARCHAR(20),
    rol VARCHAR(20) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    Contraseña VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado_cuenta VARCHAR(20)
);

CREATE TABLE Especialidad (
    id_especialidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE Psicologo (
    id_psicologo INT AUTO_INCREMENT PRIMARY KEY,
    certificado_pdf VARCHAR(255),
    calificacion_promedio DECIMAL(3,2),
    descripcion VARCHAR(255),
    estado_aprobacion VARCHAR(20),
    id_especialidad INT NOT NULL,
    FOREIGN KEY (id_especialidad) REFERENCES Especialidad(id_especialidad)
);

CREATE TABLE Horario (
    id_horario INT AUTO_INCREMENT PRIMARY KEY,
    dia VARCHAR(20),
    hora_inicio TIME,
    hora_fin TIME,
    disponibilidad BOOLEAN,
    id_psicologo INT NOT NULL,
    FOREIGN KEY (id_psicologo) REFERENCES Psicologo(id_psicologo)
);

CREATE TABLE Cita (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    hora TIME,
    estado VARCHAR(20),
    motivo VARCHAR(255),
    enlace_virtual VARCHAR(255),
    id_usuario INT NOT NULL,
    id_psicologo INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_psicologo) REFERENCES Psicologo(id_psicologo)
);

CREATE TABLE Solicitud_Urgencia (
    id_urgencia INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255),
    estado VARCHAR(20),
    fecha_hora DATETIME,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Mensaje (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    Contenido VARCHAR(255),
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    leido BOOLEAN,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Calificacion (
    id_calificacion INT AUTO_INCREMENT PRIMARY KEY,
    Puntuacion INT,
    Comentario VARCHAR(255),
    fecha DATE,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);