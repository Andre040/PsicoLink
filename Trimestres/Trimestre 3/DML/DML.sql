INSERT INTO Usuario (nombre, Fecha_nacimiento, Genero, rol, correo, Contraseña, telefono, fecha_registro, estado_cuenta) VALUES
('Maria Fernanda Lopez', '1995-03-12', 'Femenino', 'paciente', 'maria.lopez@correo.com', 'hashed_pass1', '3001234567', '2026-01-10 09:15:00', 'activo'),
('Juan Carlos Perez', '1988-07-25', 'Masculino', 'paciente', 'juan.perez@correo.com', 'hashed_pass2', '3009876543', '2026-01-15 14:30:00', 'activo'),
('Laura Sofia Gomez', '1992-11-02', 'Femenino', 'psicologo', 'laura.gomez@correo.com', 'hashed_pass3', '3012345678', '2025-12-01 08:00:00', 'activo'),
('Andres Felipe Torres', '1985-05-19', 'Masculino', 'psicologo', 'andres.torres@correo.com', 'hashed_pass4', '3023456789', '2025-12-05 10:20:00', 'activo'),
('Camila Andrea Ruiz', '1999-09-30', 'Femenino', 'paciente', 'camila.ruiz@correo.com', 'hashed_pass5', '3034567890', '2026-02-01 16:45:00', 'inactivo'),
('Diego Alejandro Mora', '1990-01-14', 'Masculino', 'admin', 'diego.mora@correo.com', 'hashed_pass6', '3045678901', '2025-11-20 11:00:00', 'activo');

INSERT INTO Especialidad (nombre, descripcion) VALUES
('Psicologia Clinica', 'Diagnostico y tratamiento de trastornos mentales'),
('Terapia de Pareja', 'Intervencion en conflictos y relaciones de pareja'),
('Psicologia Infantil', 'Atencion psicologica enfocada en ninos y adolescentes'),
('Terapia Cognitivo Conductual', 'Tratamiento basado en modificacion de pensamientos y conductas');

INSERT INTO Psicologo (certificado_pdf, calificacion_promedio, descripcion, estado_aprobacion, id_especialidad) VALUES
('certificado_laura.pdf', 4.75, 'Especialista en terapia clinica con 8 anos de experiencia', 'aprobado', 1),
('certificado_andres.pdf', 4.50, 'Enfoque en terapia de pareja y familia', 'aprobado', 2);

INSERT INTO Horario (dia, hora_inicio, hora_fin, disponibilidad, id_psicologo) VALUES
('Lunes', '08:00:00', '12:00:00', TRUE, 1),
('Miercoles', '14:00:00', '18:00:00', TRUE, 1),
('Martes', '09:00:00', '13:00:00', TRUE, 2),
('Jueves', '15:00:00', '19:00:00', FALSE, 2);

INSERT INTO Cita (fecha, hora, estado, motivo, enlace_virtual, id_usuario, id_psicologo) VALUES
('2026-07-22', '09:00:00', 'confirmada', 'Ansiedad y estres laboral', 'https://meet.psicolink.com/sala1', 1, 1),
('2026-07-23', '10:00:00', 'pendiente', 'Terapia de pareja', 'https://meet.psicolink.com/sala2', 2, 2),
('2026-07-25', '15:00:00', 'cancelada', 'Seguimiento emocional', 'https://meet.psicolink.com/sala3', 5, 1);

INSERT INTO Solicitud_Urgencia (descripcion, estado, fecha_hora, id_usuario) VALUES
('Crisis de ansiedad severa, necesita atencion inmediata', 'pendiente', '2026-07-19 22:10:00', 1),
('Episodio de panico durante la noche', 'atendida', '2026-07-18 03:45:00', 5);

INSERT INTO Mensaje (Contenido, fecha_envio, leido, id_usuario) VALUES
('Hola, quisiera reprogramar mi cita del jueves', '2026-07-19 10:00:00', FALSE, 1),
('Gracias por la sesion de hoy, me sirvio mucho', '2026-07-18 17:30:00', TRUE, 2),
('Necesito informacion sobre los horarios disponibles', '2026-07-17 09:20:00', TRUE, 5);

INSERT INTO Calificacion (Puntuacion, Comentario, fecha, id_usuario) VALUES
(5, 'Excelente atencion, muy profesional', '2026-07-15', 1),
(4, 'Buena sesion, aunque llego un poco tarde', '2026-07-16', 2),
(5, 'Me sentí muy comoda con el psicologo', '2026-07-17', 5);