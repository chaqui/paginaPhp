<?php 
//verificar si el usuario tiene iniciada la sesión
 session_start(); require '../../php/verificar.php';
 
 //llamar a archivo donde tengo la fucion para conectar
require_once "../../php/conexion.php";
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Base de Dato "EL CANDELERO DE ORO"</title>
	<link rel="stylesheet" href="../../css/principal1.css">
	<script src="../../javascript/jquery.js"></script>
	<script src="../../javascript/scripts.js"></script>
	
</head>
<body>
	<header>
	
	<h1><div class="laE">E</div><div class="oro">l Candelero de Oro</div></h1>
		<h5>Iglesia Centroamericana</h5>
		<nav>
			<table class="menu">
				<tr>
					<td class="menus"><a href="/" class="menus">Buscar</a></td>
					<td class="menus"><a href="ingreso.php" class="menus">ingresar</a></td>
					<td class="menus"><a href="modificar.php" class="menus">modificar</a></td>
					<td class="menus"><a href="crearpdf.php" class="menus">crear pdf</a></td>
					<td class="menus"><a href="consulta.php" class="menus">consulta</a></td>
				</tr>
			</table>
		</nav>
		<div class="ingresar"><a href="../../php/salir.php">Salir</a></div>
	</header>
	<section>
		<article>
			<form action="pdf.php" method="post">
			<fieldset><legend>Que desea que aparesca</legend>
			<input type="checkbox" name="telefonos">telefonos
			<input type="checkbox" name="direccion">direccion
			<input type="submit" value="crear">
			</fieldset>
			
		</form>
		</article>
	</section>
	<!--Pie de la pagian -->
	<hr>
	<footer>
		A Dios sea la gloria 2013 (Seguidores de Cristo)
	</footer>
</body>
</html>