# PsicoLink — Frontend funcional

## Cómo ejecutarlo
1. Descomprime la carpeta.
2. Abre `index.html` en un navegador, o abre la carpeta en Visual Studio Code y usa Live Server.
3. No necesita instalación ni compilación.

## Cuentas de demostración
- Psicólogo: `psicologo@psicolink.com`
- Paciente: `paciente@psicolink.com`
- Contraseña para ambas: `Psico123!`

También puedes crear cuentas desde **Crear cuenta** y elegir si eres paciente o psicólogo.

## Funciones incluidas
- Página pública de bienvenida, responsive, con directorio público de psicólogos.
- Registro e inicio de sesión de demostración.
- Panel diferente para psicólogo y paciente.
- Perfil editable, cambio de contraseña desde configuración y recuperación/actualización de contraseña desde la pantalla de acceso (demostración local).
- El psicólogo puede ver y cambiar el estado de citas y aceptar/rechazar solicitudes.
- El paciente puede buscar perfiles de psicólogos y enviar solicitudes de cita.
- Búsqueda de pacientes/citas y navegación adaptable a móvil.
- Datos guardados en `localStorage` del navegador.

## Importante
Esta es una demostración de frontend. La autenticación y las contraseñas se almacenan localmente y NO son seguras para producción. La recuperación de contraseña no envía correo ni verifica identidad; solo demuestra el flujo local. No uses contraseñas reales. Para publicar PsicoLink con usuarios reales, necesitamos conectar un backend y una base de datos, implementar autenticación segura, autorización por roles y protección de datos personales.
