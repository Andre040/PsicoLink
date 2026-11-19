<?php
if ($_SERVER['REQUEST_METOD'] !== 'POST'){
    header('Location: Iniciar_sesion.php');
    exit;
}
// El trim es pa borrar los espacios
$email = filter_var(trim($_POST['email']))
?>