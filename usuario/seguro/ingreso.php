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
					<td class="menus"><a href="/">Buscar</a></td>
					<td class="menus"><a href="ingreso.php">ingresar</a></td>
					<td class="menus"><a href="modificar.php">modificar</a></td>
					<td class="menus"><a href="crearpdf.php">crear pdf</a></td>
					<td class="menus"><a href="consulta.php">consulta</a></td>
				</tr>
			</table>
		</nav>
		<div class="ingresar"><a href="../../php/salir.php">Salir</a></div>
	</header>
	<section>
	<article>
		Bienvenidos a esta aplicación la cual esta desarrollada para contener toda la informacion de los hermanos de la Iglesia Centroamericana "El Candelero de Oro".
		<br>
		Ingreso de nuevo hermano de la iglesia <br>
		<hr>
		<form action="ingreso.php" method="post">

			<fieldset><legend>FORMULARIO DE INGRESO</legend>
			<fieldset><legend>Datos Generales</legend>
			<table>
				<tr>
					<td>Nombre:</td>
					<td><input type="text" name="nombre"></td>
					<td>Apellidos:</td>
					<td> <input type="text" name="apellidos"></td>
				</tr>
				<tr>
					<td>Sexo:</td>
					<td><input type="text" name="sexo"></td>
					<td>Fecha de Nacimiento:</td>
					<td><input type="date" name="fecha"> </td>
				</tr>
				<tr>
					<td>Telefono: </td>
					<td><input type="tel" name="telefono"></td>
					<td>Celular:</td>
					<td><input type="tel" name="celular"></td>
				</tr>
				<tr>
					<td>edad minima:</td>
					<td> <input type="text" name="minedad"></td>
					<td>edad maxima:</td>
					<td><input type="text" name="maxedad"></td>
				</tr>
				<tr>
					<td>direccion:</td>
					<td><input type="text" name="direccion"></td>
				</tr>
			</table>
			</fieldset>
			<fieldset><legend>Datos especificos</legend>
				<table>
					<tr>
						<td>bautizado:</td>
						<td><input type="text" name="bautizo"></td>
						<td>membresia</td>
						<td><input type="text" name="membresia"></td>
					</tr>
					<tr>
						<td>Fecha de Bautismo: </td>
						<td><input type="date" name="fechabautismo"> </td>
						<td>Fecha de conversion:</td>
						<td><input type="date" name="fechaconversion"></td>
					</tr>
				</table>
			Cuantos años de haberse convertido <input type="number" name="edadcristiana">
		</fieldset>
		<input type="submit" value="ingresar datos">
			</fieldset>	
		</form>
		<?php 
			$conexion=conectar("localhost","root","root","igle");

		// averiguando si existe una conexion
		//no existe
		if ($conexion==null) {

			//si no existe se envia un mensaje a la consola del navegador
			$mensaje .= '<script name="accion"> console.log("problemas en la conexion") </script>';
			echo $mensaje;

		}

		//si existe
		else{

			//si existe se envia un mensaje a la consola del navegador
			$mensaje .= '<script name="accion"> console.log("conexion estable") </script>';
			echo $mensaje;
			if ($_POST!=null) {
			//EMPEZAMOS CON LA INSERCION DE UNA FILA EN LA BASE DE DATOS
			//averiguamos si nombre tiene datos
			if ($_POST["nombre"]==null || $_POST["apellidos"]==null || $_POST["sexo"]==null || $_POST["fecha"]==null || $_POST["telefono"]==null || $_POST["celular"]==null || $_POST["direccion"]==null || $_POST["bautizo"]==null || $_POST["edad"]==null || $_POST["membresia"]==null || $_POST["fechabautismo"]==null || $_POST["fechaconversion"]==null || $_POST["edadcristiana"]==null ) {

				$mensaje .= '<script name="accion"> alert("falta un dato") </script>';
				echo $mensaje;
			}
			else{
				$consulta="INSERT INTO hermano (Nombre, apellidos,sexo,fecha,telefono,celular,minEdad,maxedad,direccion,bautizado,membresia,fechadebautismo,fechadeconversion,edadconvertido) VALUES ( ";
				$consulta=$consulta."'".$_POST["nombre"]."', ";
				$consulta=$consulta."'".$_POST["apellidos"]."', ";
				$consulta=$consulta."'".$_POST["sexo"]."', ";
				$consulta=$consulta.$_POST["fecha"].", ";
				$consulta=$consulta.$_POST["telefono"].", ";
				$consulta=$consulta.$_POST["celular"].", ";
				$consulta=$consulta.$_POST["minedad"].", ";
				$consulta=$consulta.$_POST["maxedad"].", ";
				$consulta=$consulta."'".$_POST["direccion"]."', ";
				$consulta=$consulta."'".$_POST["membresia"]."', ";
				$consulta=$consulta."'".$_POST["bautizo"]."', ";
				$consulta=$consulta."'".$_POST["fechabautismo"]."', ";
				$consulta=$consulta."'".$_POST["fechaconversion"]."', ";
				$consulta=$consulta."'".$_POST["edadcristiana"]."')";
				echo $consulta;
				$respuesta=mysql_query($consulta,$conexion);
				if ($respuesta!=0) {
					$mensaje .= '<script name="accion"> alert("insercion correcta") </script>';
				echo $mensaje;
				}
				else{
					$mensaje .= '<script name="accion"> alert("insercion incorrecta") </script>';
				echo $mensaje;
				}

			}
			}
			
		}
		 ?>
	</article>
	</section>
	<hr>
	<footer>
		A Dios sea la gloria 2013 (Seguidores de Cristo)
	</footer>
</body>
</html>