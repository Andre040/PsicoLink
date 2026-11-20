<?php
session_start();

if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'psicologo') {
    header('Location: Citas.php');
    exit;
}

include '../controllers/Consulta.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar citas - PsicoLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/styles.css">
</head>

<body style="background: linear-gradient(135deg, #18a596, #0d74b8); min-height: 100vh;">

<header class="public-header">
    <a href="index.php" class="brand" aria-label="Ir al inicio">
        <img src="../img/logo.png" alt="PsicoLink">
    </a>
    <nav class="public-nav" aria-label="Navegacion principal">
        <a class="btn btn-primary" href="index.php" style="color: white;">Regresar</a>
    </nav>
</header>

<div class="container py-5" style="min-height: 100vh;">
    <div class="card shadow-lg border-0 rounded-4 bg-light p-4">
        <div class="card-body">
            <div class="text-center mb-4">
                <h6 class="text-muted">Panel del psicólogo</h6>
                <h2 class="fw-bold text-dark">Citas pendientes</h2>
                <p class="text-muted">Confirma, cancela o reagenda las solicitudes de los pacientes</p>
            </div>

            <div class="p-3 bg-white rounded-3 shadow-sm mb-4">
                <h5 class="text-primary mb-3">+ Registrar cita presencial</h5>
                <form method="post" class="row g-3">
                    <div class="col-md-4">
                        <label for="id_usuario" class="form-label fw-semibold">Paciente</label>
                        <select name="id_usuario" id="id_usuario" class="form-select" required>
                            <option value="">Selecciona un usuario</option>
                            <?php if (isset($usuarios_resultado)): ?>
                                <?php while ($usuario = mysqli_fetch_assoc($usuarios_resultado)): ?>
                                    <option value="<?php echo (int) $usuario['id_usuario']; ?>">
                                        ID <?php echo (int) $usuario['id_usuario']; ?> - <?php echo htmlspecialchars($usuario['nombre']); ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="horario_seguimiento" class="form-label fw-semibold">Fecha y hora</label>
                        <input type="datetime-local" name="horario_seguimiento" id="horario_seguimiento" class="form-control" required>
                    </div>
                    <div class="col-md-5">
                        <label for="motivo_seguimiento" class="form-label fw-semibold">Motivo</label>
                        <input type="text" name="motivo_seguimiento" id="motivo_seguimiento" class="form-control" placeholder="Motivo del seguimiento" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="GuardarSeguimiento" class="btn btn-primary">+ Registrar cita presencial</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-info">
                        <tr>
                            <th>ID usuario</th>
                            <th>Paciente</th>
                            <th>Fecha y hora</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (mysqli_num_rows($pendientes_resultado) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($pendientes_resultado)): ?>
                            <?php $fecha_hora = $row['fecha'] . ' ' . substr($row['hora'], 0, 5); ?>
                            <tr>
                                <td><?php echo (int) $row['id_usuario']; ?></td>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($fecha_hora); ?></td>
                                <td><?php echo htmlspecialchars($row['motivo']); ?></td>
                                <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                                <td>
                                    <form method="post" class="d-inline" onsubmit="return confirm('¿Confirmar esta cita?');">
                                        <input type="hidden" name="id_cita" value="<?php echo (int) $row['id_cita']; ?>">
                                        <button type="submit" name="Confirmar" class="btn btn-success btn-sm mb-1">Confirmar</button>
                                    </form>
                                    <form method="post" class="d-inline" onsubmit="return confirm('¿Cancelar esta cita?');">
                                        <input type="hidden" name="id_cita" value="<?php echo (int) $row['id_cita']; ?>">
                                        <button type="submit" name="Cancelar" class="btn btn-danger btn-sm mb-1">Cancelar</button>
                                    </form>
                                    <details class="d-inline-block text-start">
                                        <summary class="btn btn-warning btn-sm mb-1">Reagendar</summary>
                                        <form method="post" class="border rounded p-2 mt-1 bg-white" style="min-width:260px">
                                            <input type="hidden" name="id_cita" value="<?php echo (int) $row['id_cita']; ?>">
                                            <label class="form-label mb-1">Nueva fecha y hora</label>
                                            <input type="datetime-local" name="horario" value="<?php echo $row['fecha'] . 'T' . substr($row['hora'], 0, 5); ?>" class="form-control form-control-sm mb-2" required>
                                            <label class="form-label mb-1">Motivo</label>
                                            <input type="text" name="motivo" value="<?php echo htmlspecialchars($row['motivo']); ?>" class="form-control form-control-sm mb-2" required>
                                            <button type="submit" name="Reagendar" class="btn btn-warning btn-sm">Guardar cambio</button>
                                        </form>
                                    </details>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-muted py-4">No hay citas pendientes.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
