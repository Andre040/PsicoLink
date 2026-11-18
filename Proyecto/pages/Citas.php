<?php
include '../controllers/Consulta.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamiento de citas - PsicoLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/styles.css">

</head>

<body style="background: linear-gradient(135deg, #18a596, #0d74b8); min-height: 100vh;">

  <header class="public-header">
    <a href="index.html" class="brand" aria-label="Ir al inicio">
      <img src="../img/logo.png" alt="PsicoLink">
    </a>
    <nav class="public-nav" aria-label="Navegacion principal">
      <a class="btn btn-primary" href="index.html" style="color: white;">Regresar</a>
    </nav>
  </header>
    <div class="container py-5" style="min-height: 100vh;">
        <div class="card shadow-lg border-0 rounded-4 bg-light p-4">
            <div class="card-body">

                <div class="text-center mb-4">
                    <h6 class="text-muted">PsicoLink</h6>
                    <h2 class="fw-bold text-dark">Agenda tu cita</h2>
                    <p class="text-muted">Completa los datos para programar, modificar o revisar tu cita</p>
                </div>

                <div class="row g-4 mt-2">

                    <div class="col-sm-12 col-md-4">
                        <div class="p-3 bg-white rounded-3 shadow-sm">
                            <h5 class="mb-3 text-primary">
                                <?php echo $editando ? "Modificar Cita" : "Nueva Cita"; ?>
                            </h5>

                            <form method="post">
                                <?php if ($editando): ?>
                                    <input type="hidden" name="id_cita" value="<?php echo $id_cita_edit; ?>">
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="horario" class="form-label fw-semibold">Horario</label>
                                    <input type="datetime-local" class="form-control" id="horario" name="horario" 
                                           value="<?php echo $horario_edit; ?>" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="cita" class="form-label fw-semibold">Indícanos la razón de tu cita</label>
                                    <textarea class="form-control" name="cita" id="cita" placeholder="Escribe el motivo..." rows="3" required><?php echo htmlspecialchars($motivo_edit); ?></textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <?php if ($editando): ?>
                                        <button class="btn btn-warning fw-semibold" type="submit" name="Actualizar">Actualizar Cita</button>
                                        <a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>" class="btn btn-secondary btn-sm">Cancelar Edición</a>
                                    <?php else: ?>
                                        <button class="btn btn-primary" type="submit" name="Guardar" value="Guardar">Guardar Cita</button>
                                    <?php endif; ?>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="col-sm-12 col-md-8">
                        <div class="p-3 bg-white rounded-3 shadow-sm">
                            <h5 class="mb-3 text-primary">Mis Citas Agendadas</h5>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered text-center align-middle">
                                    <thead class="table-info">
                                        <tr>
                                            <th>Nombres</th>
                                            <th>Fecha y Hora</th>
                                            <th>Motivo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if (mysqli_num_rows($resultado) > 0) {
                                            while ($row = mysqli_fetch_assoc($resultado)) {
                                                $fecha_hora = $row['fecha'] . " " . substr($row['hora'], 0, 5);
                                                $id_formateado = str_pad($row['id_cita'], 3, "0", STR_PAD_LEFT);
                                                
                                                echo "<tr>
                                                        <td>" . htmlspecialchars($row['nombre']) . "</td>
                                                        <td>{$fecha_hora}</td>
                                                        <td>" . htmlspecialchars($row['motivo']) . "</td>
                                                        <td><span class='badge bg-warning text-dark'>{$row['estado']}</span></td>
                                                        <td>
                                                            <a href='?modificar={$row['id_cita']}' class='btn btn-warning btn-sm mb-1'>Modificar</a>
                                                            
                                                            <form method='post' style='display:inline-block;' onsubmit='return confirm(\"¿Estás seguro de cancelar/eliminar esta cita?\");'>
                                                                <input type='hidden' name='id_cita' value='{$row['id_cita']}'>
                                                                <button type='submit' name='Eliminar' class='btn btn-danger btn-sm mb-1'>Cancelar</button>
                                                            </form>
                                                        </td>
                                                    </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6' class='text-muted'>No hay citas registradas todavía.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>
