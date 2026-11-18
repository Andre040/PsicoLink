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
            header("Location: " . $_SERVER['PHP_SELF']); // Recargar para limpiar POST
            exit();
        }
    }

    if (isset($_POST['Actualizar'])) {
        $id_cita = $_POST['id_cita'];
        $fecha_hora_completa = $_POST['horario'];
        $motivo = $_POST['cita'];

        $fecha = date('Y-m-d', strtotime($fecha_hora_completa));
        $hora = date('H:i:s', strtotime($fecha_hora_completa));

        $sql_update = "UPDATE cita SET fecha = ?, hora = ?, motivo = ? WHERE id_cita = ?";
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

        $sql_delete = "DELETE FROM cita WHERE id_cita = ?";
        $stmt_delete = mysqli_prepare($conexion, $sql_delete);

        if ($stmt_delete) {
            mysqli_stmt_bind_param($stmt_delete, "i", $id_cita);
            mysqli_stmt_execute($stmt_delete);
            mysqli_stmt_close($stmt_delete);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

if (isset($_GET['modificar'])) {
    $editando = true;
    $id_cita_edit = $_GET['modificar'];

    $sql_fetch = "SELECT fecha, hora, motivo FROM cita WHERE id_cita = ?";
    $stmt_fetch = mysqli_prepare($conexion, $sql_fetch);
    mysqli_stmt_bind_param($stmt_fetch, "i", $id_cita_edit);
    mysqli_stmt_execute($stmt_fetch);
    $res_fetch = mysqli_stmt_get_result($stmt_fetch);
    
    if ($row_edit = mysqli_fetch_assoc($res_fetch)) {
        $horario_edit = $row_edit['fecha'] . 'T' . substr($row_edit['hora'], 0, 5);
        $motivo_edit = $row_edit['motivo'];
    }
    mysqli_stmt_close($stmt_fetch);
}

$query = "SELECT c.id_cita, u.nombre, c.fecha, c.hora, c.motivo, c.estado 
          FROM cita c 
          INNER JOIN usuario u ON c.id_usuario = u.id_usuario 
          ORDER BY c.fecha DESC, c.hora DESC";
$resultado = mysqli_query($conexion, $query);
?>