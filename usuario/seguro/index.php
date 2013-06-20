<?php 
//verificar si el usuario tiene iniciada la sesión
 session_start(); require '../../php/verificar.php';
 
 //llamar a archivo donde tengo la fucion para conectar
require_once "../../php/conexion.php";
?>
<!--iniciando codigo de html creado con html 5-->
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
		<!--              parte central                     -->
	<section>
	<article>

		Bienvenidos a esta aplicación la cual esta desarrollada para contener toda la informacion de los hermanos de la Iglesia Centroamericana "El Candelero de Oro".
		<br>
		Desea buscar a un hermano. <br>
		<hr>
		<!--                 formulario de busqueda                  -->
		<form action="index.php" method="post">
			Nombre del hermano:
			<input type="text" name="nombre"> 
			<fieldset><legend>Que desea que aparesca</legend>
			<input type="checkbox" name="telefonos">telefonos
			<input type="checkbox" name="direccion">direccion
			<input type="submit" value="buscar">
			</fieldset>
			
		</form>


		<?php
		//----------------------------CODIGO DE PHP---------------------------------------
		//conectando a bd  por medio de la funcion conectar creada en el archivo conexion
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

			//averiguando por medio de que metodo se recibio los datos
			//-----------------------------POST------------------
			if ($_POST!=null) {

				//averiguamos si se ingreso algun nombre

				//SI TIENE NOMBRE
				if ($_POST["nombre"]!=null) {
					//creando la variable consulta donde se guardara el query de MySql
					$consulta= "SELECT idhermano, Nombre, apellidos";

					// averiguando si se debe de mostrar el numero de telefono
					if ($_POST["telefonos"]!=null) {
					$consulta=$consulta.", celular, telefono";
					}
					// averiguando si se debe de mostrar la direccion
					if ($_POST["direccion"]!=null) {
						$consulta=$consulta.", direccion";
					}
					$consulta=$consulta." FROM hermano where Nombre like '%".$_POST["nombre"]."%'";
					//ejecutamos la consulta
					$respuesta=mysql_query($consulta,$conexion);

					//averiguamos si respuesta tiene algun valor

					//----si es cierto-----
					if ($respuesta!=null) {
						echo"<table>";
						echo "<tr><td>id</td><td>nombre</td><td>apellidos</td>";
						if ($_POST["telefonos"]!=null) {
							echo "<td>celular</td><td>telefono</td>";
						}
						if ($_POST["direccion"]!=null) {
							echo "<td>direccion</td>";
						}
							echo "</tr>";
						while ( $fila=mysql_fetch_array($respuesta)) {
							echo "<tr><td>";
							echo $fila["idhermano"]."</td>";
							echo "<td>";
							echo $fila["Nombre"]."</td>";
							echo "<td>";
							echo $fila["apellidos"]."</td>";
							if ($fila["celular"]!=null) {
								echo "<td>";
								echo $fila["celular"]."</td>";
								echo "<td>";
								echo $fila["telefono"]."</td>";
							}
							if ($fila["direccion"]!=null) {
								echo "<td>";
								echo $fila["direccion"]."</td>";
							}
						}
						echo"</table>";
						/*aca creamos un nuevo formulario en donde se solicita algun id para eliminar*/
						echo "<form action='index.php' method='get'>
							id para eliminar:
							<input type='text'name='id'>
							<input type='submit' value='eliminar'>
							</form>";
					}
					
					//si no es cierto
					else{
						echo "<h3>no existen hermanos con ese nombre</h3>";
					}

					
					}

				//SI NO TIENE NOMBRE
					else{
							$mensaje .= '<script name="accion"> alert("porfavor ingresar nombre del hermano") </script>';
							echo $mensaje;
					}
				//terminado el metodo POST
				}
				

			//-------------------------GET------------------------
			elseif ($_GET!=null) {

				//si tiene datos el id 
				if ($_GET["id"]!=null) {
					$consulta="DELETE FROM hermano WHERE idhermano = ".$_GET["id"];
				}
				//si no tiene datos el id
				else{
					$mensaje .= '<script name="accion"> alert("porfavor ingresar id del hermano") </script>';
				}
				
			}
			//liberando memoria 
			mysql_free_result($respuesta);	
			//cerrando la conexion
			mysql_close($conexion);
		}

		//final de PHP
		?>
	</article>
	</section>
	<!--Pie de la pagian -->
	<hr>
	<footer>
		A Dios sea la gloria 2013 (Seguidores de Cristo)
	</footer>
</body>
</html>