<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PsicoLink | Iniciar sesión</title>
  <link href="../style/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header class="public-header">
    <a href="index.php" class="brand" aria-label="PsicoLink">
      <img src="../img/logo.png" alt="PsicoLink">
    </a>
  </header>
<!-- Incluir
    fecha de nacimiento 
    genero
    telefono 
-->
  <main class="auth-shell">
    <section class="auth-card" aria-label="Crear cuenta">
      <img src="../img/logo2.png" alt="PsicoLink" class="auth-logo">
      <h1>Crea tu cuenta</h1>
      <p class="auth-subtitle">Completa el formulario para registrarte.</p>

      <form action="iniciar_sesion.php" method="post">
        <div class="form-group">
          <label for="name">Nombre completo</label>
          <input class="form-control" id="name" name="name" type="text" placeholder="Tu nombre y apellido" minlength="3"
            required>
        </div>

        <div class="form-group">
          <label for="email">Correo eléctronico</label>
          <input class="form-control" id="email" name="email" type="email" placeholder="nombre@correo.com" required>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input class="form-control" id="password" name="password" type="password" placeholder="Minimo 6 caracteres"
            minlength="6" required>
        </div>


        <div class="form-group">
          <label for="fecha_nacimiento">Fecha de nacimiento</label>
          <input class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" type="date" max="<?php echo date('Y-m-d'); ?>" required>
         </div>

        <div class="form-group">
          <label for="genero">Genero</label>
          <select class="form-control" id="genero" name="genero" required>
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
            <option value="no_especifica">Prefiero no decirlo</option>
          </select>
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input class="form-control" id="telefono" name="telefono" type="tel" placeholder="3001234567" pattern="[0-9]{7,15}" title="Ingresa solo números (entre 7 y 15 dígitos)" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Crear cuenta</button>
      </form>

      <p class="auth-bottom">
        ¿Ya tienes cuenta? <a class="link-btn" href="Iniciar_sesion.php">Inicia sesion</a><br>
        <a class="link-btn" href="index.php">Volver al inicio</a>
      </p>
    </section>
  </main>
</body>

</html>