<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de aprendiz | SENA</title>
    <link rel="stylesheet" href="../estilos.css">
</head>

<body>
    <main class="page-shell">
        <section class="panel">
            <header class="panel-header">
                <h1>Registro de aprendiz</h1>
                <p class="intro">Ingresa los datos personales para crear un nuevo registro.</p>
            </header>

            <div style="height: 25px;"></div>

            <form action="" method="POST">
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <div style="margin-bottom: 10px; width: 60%;">
                        <label for="nombre" style="display: block; margin-bottom: 5px;">Nombre:</label>
                        <input style="height: 40px; width: 100%;" type="text" name="nombre" id="nombre"
                            placeholder="Nombre del aprendiz" required>
                    </div>

                    <div style="margin-bottom: 15px; width: 60%;">
                        <label for="apellido" style="display: block; margin-bottom: 5px;">Apellido:</label>
                        <input style="height: 40px; width: 100%;" type="text" name="apellido" id="apellido"
                            placeholder="Apellido del aprendiz" required>
                    </div>
                    <div style="margin-bottom: 15px; width: 60%;">
                        <label for="ficha">Ingrese el código de la ficha:</label>
                        <input style="width: 100%; height: 40px;" type="text" name="ficha" id="ficha"
                            list="lista-fichas" placeholder="Escribe o selecciona...">
                        <datalist id="lista-fichas">
                            <option value="3313638">
                            <option value="3312567">
                            <option value="3312570">
                            <option value="3313640">
                            <option value="3319657">
                            <option value="3319659">
                        </datalist>
                    </div>
                </div>

                <div style="display: flex; justify-content: center;">
                    <input style="background-color: azure; width: 25%; height: 40px; cursor: pointer;" type="submit"
                        name="registrar" value="Registrar">
                </div>
            </form>

            <?php
            $conexion = mysqli_connect("localhost", "root", "", "sena", 3308) or die("Problemas con la conexión a la BD");
            if (isset($_POST['registrar'])) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $ficha = $_POST['ficha'];

                $resultado = mysqli_query($conexion, "INSERT INTO aprendiz (nombre, apellido,idficha) VALUES ('$nombre', '$apellido','$ficha')") or die("Problemas en el registro: " . mysqli_error($conexion));
            }
            ?>
            <div style="margin-top: 40px; width: 80%; margin-left: auto; margin-right: auto;">
                <h3 style="margin-bottom: 15px; text-align: center;">Lista de Aprendices Registrados</h3>
                <table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="padding: 10px;">Nombre</th>
                            <th style="padding: 10px;">Apellido</th>
                            <th style="padding: 10px;">Ficha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = mysqli_query($conexion, "SELECT nombre, apellido, idficha FROM aprendiz");
                        while ($row = mysqli_fetch_assoc($consulta)) {
                            echo "<tr>";
                            echo "<td style='padding: 10px;'>" . ($row['nombre']) . "</td>";
                            echo "<td style='padding: 10px;'>" . ($row['apellido']) . "</td>";
                            echo "<td style='padding: 10px;'>" . ($row['idficha']) . "</td>";
                            echo "</tr>";
                        }
                        mysqli_close($conexion);
                        ?>
                    </tbody>
        </section>
    </main>
</body>

</html>