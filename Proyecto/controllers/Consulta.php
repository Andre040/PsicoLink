<?php
$conexion = mysqli_connect("localhost", "root", "", "psicolink", 3306) or die("Problemas con la conexión a la BD");
$editando = false;
$id_cita_edit = "";
$horario_edit = "";
$motivo_edit = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['Guardar'])) {
        $fecha_hora_completa = $_POST['horario']; 
        $motivo = $_POST['cita'];                 
        
        $fecha = date('Y-m-d', strtotime($fecha_hora_completa));
        $hora = date('H:i:s', strtotime($fecha_hora_completa));
        
        $estado = "Pendiente";
        $enlace_virtual = NULL; 
        $id_usuario = 1;      
        $id_psicologo = 1;    

        $sql_insert = "INSERT INTO cita (fecha, hora, estado, motivo, enlace_virtual, id_usuario, id_psicologo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conexion, $sql_insert);
        
        if ($stmt_insert) {
            mysqli_stmt_bind_param($stmt_insert, "sssssii", $fecha, $hora, $estado, $motivo, $enlace_virtual, $id_usuario, $id_psicologo);
            mysqli_stmt_execute($stmt_insert);
            mysqli_stmt_close($stmt_insert);
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit();
        }
    }

    if (isset($_POST['Actualizar'])) {
        $id_cita = $_POST['id_cita'];
        $fecha_hora_completa = $_POST['horario'];
        $motivo = $_POST['cita'];

        $fecha = date('Y-m-d', strtotime($fecha_hora_completa));
        $hora = date('H:i:s', strtotime($fecha_hora_completa));

        $sql_update = "UPDATE cita SET fecha = ?, hora = ?, motivo = ? WHERE id_cita = ? AND estado = 'Pendiente'";
        $stmt_update = mysqli_prepare($conexion, $sql_update);

        if ($stmt_update) {
            mysqli_stmt_bind_param($stmt_update, "sssi", $fecha, $hora, $motivo, $id_cita);
            mysqli_stmt_execute($stmt_update);
            mysqli_stmt_close($stmt_update);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    if (isset($_POST['Eliminar'])) {
        $id_cita = $_POST['id_cita'];

        $sql_cancelar = "UPDATE cita SET estado = 'Cancelada' WHERE id_cita = ? AND estado IN ('Pendiente', 'Confirmada', 'Aceptada')";
        $stmt_cancelar = mysqli_prepare($conexion, $sql_cancelar);

        if ($stmt_cancelar) {
            mysqli_stmt_bind_param($stmt_cancelar, "i", $id_cita);
            mysqli_stmt_execute($stmt_cancelar);
            mysqli_stmt_close($stmt_cancelar);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    if (isset($_POST['Confirmar']) || isset($_POST['Cancelar'])) {
        $id_cita = (int) $_POST['id_cita'];
        $nuevo_estado = isset($_POST['Confirmar']) ? 'Confirmada' : 'Cancelada';

        $sql_estado = "UPDATE cita SET estado = ? WHERE id_cita = ? AND estado = 'Pendiente'";
        $stmt_estado = mysqli_prepare($conexion, $sql_estado);

        if ($stmt_estado) {
            mysqli_stmt_bind_param($stmt_estado, "si", $nuevo_estado, $id_cita);
            mysqli_stmt_execute($stmt_estado);
            mysqli_stmt_close($stmt_estado);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    if (isset($_POST['Reagendar'])) {
        $id_cita = (int) $_POST['id_cita'];
        $fecha_hora = $_POST['horario'];
        $motivo = trim($_POST['motivo']);

        $fecha = date('Y-m-d', strtotime($fecha_hora));
        $hora = date('H:i:s', strtotime($fecha_hora));

        $sql_reagendar = "UPDATE cita SET fecha = ?, hora = ?, motivo = ?, estado = 'Pendiente' WHERE id_cita = ?";
        $stmt_reagendar = mysqli_prepare($conexion, $sql_reagendar);

        if ($stmt_reagendar) {
            mysqli_stmt_bind_param($stmt_reagendar, "sssi", $fecha, $hora, $motivo, $id_cita);
            mysqli_stmt_execute($stmt_reagendar);
            mysqli_stmt_close($stmt_reagendar);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    if (isset($_POST['GuardarSeguimiento'])) {
        $id_usuario = (int) $_POST['id_usuario'];
        $fecha_hora = $_POST['horario_seguimiento'];
        $motivo = trim($_POST['motivo_seguimiento']);

        $fecha = date('Y-m-d', strtotime($fecha_hora));
        $hora = date('H:i:s', strtotime($fecha_hora));
        $estado = 'Confirmada';
        $enlace_virtual = NULL;
        $id_psicologo = 1;

        $sql_seguimiento = "INSERT INTO cita (fecha, hora, estado, motivo, enlace_virtual, id_usuario, id_psicologo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_seguimiento = mysqli_prepare($conexion, $sql_seguimiento);

        if ($stmt_seguimiento) {
            mysqli_stmt_bind_param($stmt_seguimiento, "sssssii", $fecha, $hora, $estado, $motivo, $enlace_virtual, $id_usuario, $id_psicologo);
            mysqli_stmt_execute($stmt_seguimiento);
            mysqli_stmt_close($stmt_seguimiento);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

if (isset($_GET['modificar'])) {
    $id_cita_edit = $_GET['modificar'];

    $sql_fetch = "SELECT fecha, hora, motivo, estado FROM cita WHERE id_cita = ?";
    $stmt_fetch = mysqli_prepare($conexion, $sql_fetch);
    mysqli_stmt_bind_param($stmt_fetch, "i", $id_cita_edit);
    mysqli_stmt_execute($stmt_fetch);
    $res_fetch = mysqli_stmt_get_result($stmt_fetch);
    
    if ($row_edit = mysqli_fetch_assoc($res_fetch)) {
        if ($row_edit['estado'] === 'Pendiente') {
            $editando = true;
            $horario_edit = $row_edit['fecha'] . 'T' . substr($row_edit['hora'], 0, 5);
            $motivo_edit = $row_edit['motivo'];
        }
    }
    mysqli_stmt_close($stmt_fetch);
}

$query = "SELECT c.id_cita, u.id_usuario, u.nombre, c.fecha, c.hora, c.motivo, c.estado 
          FROM cita c 
          INNER JOIN usuario u ON c.id_usuario = u.id_usuario 
          ORDER BY c.fecha DESC, c.hora DESC";

if (basename($_SERVER['PHP_SELF']) === 'ConfirmarCitas.php') {
    $pendientes_query = "SELECT c.id_cita, u.id_usuario, u.nombre, c.fecha, c.hora, c.motivo, c.estado
                         FROM cita c
                         INNER JOIN usuario u ON c.id_usuario = u.id_usuario
                         WHERE c.estado = 'Pendiente'
                         ORDER BY c.fecha ASC, c.hora ASC";
    $pendientes_resultado = mysqli_query($conexion, $pendientes_query);

    $historial_query = "SELECT c.id_cita, u.id_usuario, u.nombre, c.fecha, c.hora, c.motivo, c.estado
                        FROM cita c
                        INNER JOIN usuario u ON c.id_usuario = u.id_usuario
                        WHERE c.estado IN ('Confirmada', 'Cancelada')
                        ORDER BY c.fecha DESC, c.hora DESC";
    $historial_resultado = mysqli_query($conexion, $historial_query);

    $usuarios_resultado = mysqli_query($conexion, "SELECT id_usuario, nombre FROM usuario WHERE rol = 'paciente' ORDER BY nombre ASC");
} else {
    $resultado = mysqli_query($conexion, $query);
}
?>