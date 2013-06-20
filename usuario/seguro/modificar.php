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
					<td class="menus"><a href="/" >Buscar</a></td>
					<td class="menus"><a href="ingreso.php" >ingresar</a></td>
					<td class="menus"><a href="modificar.php" >modificar</a></td>
					<td class="menus"><a href="crearpdf.php" >crear pdf</a></td>
					<td class="menus"><a href="consulta.php" >consulta</a></td>
				</tr>
			</table>
		</nav>
		<div class="ingresar"><a href="../../php/salir.php">Salir</a></div>
	</header>
	<section>
		<article>

		Bienvenidos a esta aplicación la cual esta desarrollada para contener toda la informacion de los hermanos de la Iglesia Centroamericana "El Candelero de Oro".
		<br>
		Desea buscar a un hermano. <br>
		<hr>
		<!--                 formulario de busqueda                  -->
		<form action="modificar.php" method="post">
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
						echo"<br>";
						/*aca creamos un nuevo formulario en donde se solicita algun id para eliminar*/
						echo '<form action="modificar.php" method="get">
							<fieldset><legend>FORMULARIO PARA MODIFICAR</legend>
							clave de hermano a modificar:<input type="text" name="id"> 			
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
						<td><input type="text" name="fechaconversion"></td>
					</tr>
				</table>
			Cuantos años de haberse convertido <input type="text" name="edadcristiana">
		</fieldset>
		<input type="submit" value="ingresar datos">
			</fieldset>	
		</form>';
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
				echo "holamundo";
				$bandera=0;
				$consulta="";
				$finaldeconsulta="";
				//si tiene datos el id 
				if ($_GET["id"]!=null) {
					//creando el UPDATE
					$consulta="UPDATE hermano SET ";
					$finaldeconsulta=" WHERE idhermano = ".$_GET["id"];
					if ($_GET["nombre"]!=null) {
						$consulta= $consulta."Nombre = '".$_GET["nombre"]."'";
						$bandera=1;
					}
					if ($_GET["apellidos"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."apellidos = '".$_GET["apellidos"]."'";
						$bandera=1;
					}
					if ($_GET["sexo"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."sexo = '".$_GET["sexo"]."'";
						$bandera=1;
					}

					if ($_GET["fecha"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."fechanacimiento = '".$_GET["fecha"]."'";
						$bandera=1;
					}

					if ($_GET["telefono"]!=null) {
						echo "telefono";
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."telefono = ".$_GET["telefono"];
						$bandera=1;
					}
					if ($_GET["celular"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."celular = ".$_GET["celular"];
						$bandera=1;
					}
					if ($_GET["maxedad"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."maxedad = '".$_GET["maxedad"]."'";
						$bandera=1;

					}
					else{
						if ($_GET["minedad"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."maxedad = '".$_GET["minedad"]."'";
						$bandera=1;
						
					}
					}
					if ($_GET["minedad"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."minEdad = '".$_GET["minedad"]."'";
						$bandera=1;
						
					}
					else{
						if ($_GET["maxedad"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."minEdad = '".$_GET["maxedad"]."'";
						$bandera=1;

					}
					}
					if ($_GET["direccion"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."direccion = '".$_GET["direccion"]."'";
						$bandera=1;
					}
					if ($_GET["bautizo"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."bautizado = '".$_GET["bautizo"]."'";
						$bandera=1;
					}
					if ($_GET["membresia"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."membresia = '".$_GET["membresia"]."'";
						$bandera=1;
					}
					if ($_GET["fechabautismo"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."fechadebautismo = '".$_GET["fechabautismo"]."'";
						$bandera=1;
					}
					if ($_GET["fechaconversion"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."fechadeconversion = '".$_GET["fechaconversion"]."'";
						$bandera=1;
					}
					if ($_GET["edadcristiana"]!=null) {
						if ($bandera==1) {
							$consulta= $consulta.", ";
							$bandera=0;
						}
						$consulta= $consulta."edadconvertido = '".$_GET["edadcristiana"]."'";
						$bandera=1;
					}
					if ($bandera==1) {
						$consulta=$consulta.$finaldeconsulta;
						echo $consulta;
						$respuesta=mysql_query($consulta,$conexion);
					}
					else{
						$mensaje .= '<script name="accion"> alert("no hay ningun dato a modificar") </script>';
						echo $mensaje;
					}
				}
				//si no tiene datos el id
				else{
					$mensaje .= '<script name="accion"> alert("porfavor ingresar id del hermano") </script>';
					echo $mensaje;
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