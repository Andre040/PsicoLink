<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamiento de citas - PsicoLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(135deg, #18a596, #0d74b8); min-height: 100vh;">

    <div class="container py-5">
        
        <div class="card shadow-lg border-0 rounded-4 bg-light p-4">
            <div class="card-body">

                <div class="text-center mb-4">
                    <h6 class="text-muted">PsicoLink</h6>
                    <h2 class="fw-bold text-dark">Agenda tu cita</h2>
                    <p class="text-muted">Completa los datos para programar, modificar o revisar tu cita</p>
                </div>

                <div class="alert alert-info text-center" role="alert">
                    Los detalles de tu cita han sido enviados a tu correo electrónico.
                </div>

                <div class="row g-4 mt-2">
                    
                    <div class="col-sm-12 col-md-4">
                        <div class="p-3 bg-white rounded-3 shadow-sm">
                            <h5 class="mb-3 text-primary">Nueva Cita</h5>
                            
                            <form method="post" action="validar.php">
                            

                                <div class="mb-3">
                                    <label for="horario" class="form-label fw-semibold">Horario</label>
                                    <input type="datetime-local" class="form-control" id="horario" name="horario" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label for="cita" class="form-label fw-semibold">Indícanos la razón de tu cita</label>
                                    <textarea class="form-control" name="cita" id="cita" placeholder="Escribe el motivo..." rows="3" required></textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit" name="Guardar">Guardar Cita</button>
                                    <button class="btn btn-outline-secondary" type="reset" name="Limpiar">Limpiar</button>
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
                                            <th>ID</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Fecha y Hora</th>
                                            <th>Motivo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>001</td>
                                            <td>Juan</td>
                                            <td>Pérez</td>
                                            <td>2026-11-15 10:00</td>
                                            <td>Orientación</td>
                                            <td><span class="badge bg-warning">Pendiente</span></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm">Modificar</button>
                                                <button class="btn btn-danger btn-sm">Cancelar</button>
                                            </td>
                                        </tr>
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