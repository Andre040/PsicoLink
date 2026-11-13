<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>formularios tablas y más</title>
		<!-- Bootstrap CSS v5.2 local -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!--ccs personalizado-->
	<link rel="stylesheet" type="text/css" href="css/otro.css">

</head>
<?php 
  if (isset($_POST['boton'])) {
 $tabla = $_POST['boton'];
 }
  else{
  	$tabla = 1;
  }
?>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark"><!-- inicio menu de navegación -->
	  <div class="container-fluid">
	    <a class="navbar-brand" href="#">Navbar</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	      <div class="navbar-nav ms-auto">
	        <a class="nav-link" href="#">Home</a>
	        <a class="nav-link" href="#">Features</a>
	        <a class="nav-link" href="#">Pricing</a>
	      </div>
	    </div>
	  </div>
	</nav><!-- fin menu de navegación -->

	<div class="container my-4" >
		<div class="row" style="background-color: grey;">
			<!--<h1>fila</h1>-->
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" style="background-color: skyblue;">
				<!--<h1>form</h1>-->
				<form method="post" action="validar.php"><!-- inicio formulario con llamado a validar-->
					<div class="mb-3" >
					  <label for="nombre" class="form-label">nombre</label>
					  <input type="text" class="form-control" name="nombre" placeholder="Nombre" autofocus>
					</div>
					<div class="mb-3">
					  <label for="apellido" class="form-label">apellido</label>
					  <textarea class="form-control" name="apellido" id="apellido" placeholder="Apellidos" rows="3"></textarea>
					</div>
					<div class="mb-3">
					  <label for="programadores" class="form-label">Número de programadores</label>
					  <input type="number" class="form-control" id="programadores" rows="3"></textarea>
					</div>
					<div class="d-grid gap-2">
						<button class="btn btn-success" type="submit" name="Guardar">Guardar</button>
						<button class="btn btn-primary" type="submit" name="Limpiar">Limpiar</button>
					</div>
				</form><!--fin formulario-->
			</div>
			<!--<div class="container-fluid"> -->
				<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" style="background-color: paleturquoise;">
					<h1>tabla de aprendices</h1>
					<table class="table table-dark table-striped text-center">
						<thead>
							<tr >
								<th >#</th>
								<th >nombres</th>
								<th >apellidos</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$conexion=mysqli_connect("localhost","root","","senaphp") or die ("Problemas con la conexion a la BD");
							$registros= mysqli_query($conexion,"select * from aprendiz limit ".(($tabla-1)*10).",10" ) or die ("Problemas con el select". mysqli_error($conexion));
									while ($reg = mysqli_fetch_array($registros)) {
							?>		
								<tr>
									<td><?php echo $reg['id'] ?>  </td>
									<td><?php echo $reg['nombre'] ?></td>
									<td><?php echo $reg['apellido'] ?></td>
								</tr>
							<?php }
							 mysqli_close($conexion); ?>
						</tbody>
					</table>
					<!-- botonera paginacion -->
					<form method="post" action="formulariophp.php">
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
					  <div class="btn-group me-2" role="group" aria-label="First group">
					    <button  class="btn btn-primary" type="submit" name="boton" value="1">1</button>
					    <button  class="btn btn-primary" type="submit" name="boton" value="2">2</button>
					    <button  class="btn btn-primary" type="submit" name="boton" value="3">3</button>
					    <button  class="btn btn-primary" type="submit" name="boton" value="4">4</button>
					  </div>					  
					  <!-- botonera paginacion fin-->
					</div>
					</form>
				</div>			
		</div>	
	</div>
	<!--libreria de javascript para bootstrap-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>