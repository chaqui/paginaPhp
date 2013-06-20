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
		<!--              parte central                     -->
	<section>
	<article>
		<form action="consulta.php" method="POST">
			<textarea name="consulta" cols="125" rows="5">Ingresa la consulta para la BD aca. Recuerde que solo existen estas tablas llamadas hermano y comentario</textarea>
			<input type="submit" value="consultar.">
		</form>
		<?php 

		if ($_POST!=null) {

			if ($_POST["consulta"]!=null) {
				$textoConsulta=$_POST["consulta"];
				$arrayConsulta=explode(' ', $_POST["consulta"]);

				if ($arrayConsulta[0]=="SELECT" || $arrayConsulta[0]=="select") {

					if ($arrayConsulta[1]=="*") 
					{
						if ($arrayConsulta[3]=="hermano") {
							$respuesta=consultar($textoConsulta);
							if ($respuesta==null) {
								echo"error de escritura de la consulta <br>";
							}

							else{
								$arrayNombres = array('idhermano','Nombre','apellidos','sexo','telefono','celular','minEdad','maxedad','direccion','bautizado','membresia','fechadebautismo','fechadeconversion','edadconvertido','fecha');
								echo"<table class='tablaInfo'>";
								echo "<tr class='titulo'>";
								foreach ($arrayNombres as $nombre) {
									echo "<td>".$nombre."</td>";
								}
								echo "</tr>";
								while ( $fila=mysql_fetch_array($respuesta)) {
									echo "<tr>";
									$i=1;
									foreach ($arrayNombres as $nombre) {
										echo "<td>".$fila[$nombre]."</td>";
									}
									echo "</tr>";
								}
							
								echo"</table>";
							}
						}
						else{
							if ($arrayConsulta[3]=="comentarios")  {
								$respuesta=consultar($textoConsulta);
							if ($respuesta==null) {
								echo"error de escritura de la consulta <br>";
							}

							else{
								$arrayNombres = array('idcomentarios','nombre','comentario');
								echo"<table class='tablaInfo'>";
								echo "<tr class='titulo'>";
								foreach ($arrayNombres as $nombre) {
									echo "<td>".$nombre."</td>";
								}
								echo "</tr>";
								while ( $fila=mysql_fetch_array($respuesta)) {
									echo "<tr>";
									$i=1;
									foreach ($arrayNombres as $nombre) {
										echo "<td>".$fila[$nombre]."</td>";
									}
									echo "</tr>";
								}
							
								echo"</table>";
							}
							}
						}
						


					}

					else{
						$i=1;
						//quitando las comas 
						while ($arrayConsulta[$i]!="FROM" || $arrayConsulta[$i]!="from" ) {
							$arrayConsulta[$i]=str_replace(",","",$arrayConsulta[$i]);
							$i++;
						}
						//ejecutando la consulta
						$respuesta=consultar($textoConsulta);
						if ($respuesta==null) {
							echo"error de escritura de la consulta <br>";
						}

						else{
							echo"<table class='tablaInfo'>";
							echo "<tr class='titulo'>";
							$i=1;
							//imprimiendo titulo de la tabla
							while ($arrayConsulta[$i]!="FROM" || $arrayConsulta[$i]!="from") {
								echo "<td>".$arrayConsulta[$i]."</td>";
								$i++;
							}
							echo "</tr>";
							while ( $fila=mysql_fetch_array($respuesta)) {
								echo "<tr>";
								$i=1;
								while ($arrayConsulta[$i]!="FROM" ) {
									echo "<td>".$fila[$arrayConsulta[$i]]."</td>";
									$i++;
								}
								echo "</tr>";
							}
							echo"</table>";
						}
					}
				}

				else{

					if ($arrayConsulta[0]=="DELETE" || $arrayConsulta[0]=="INSERT" || $arrayConsulta[0]=="UPDATE" || $arrayConsulta[0]=="delete" || $arrayConsulta[0]=="insert" || $arrayConsulta[0]=="update" ) {
						$respuesta=consultar($textoConsulta);
						if ($respuesta==0) {
							echo"error de escritura de la consulta <br>";
						}
						else{
							echo"consulta exitosa <br>";	
						}
					}
					else{

					}
				}
			}
			else{
				$mensaje="<script>alert('no ingreso texto a la consulta'); </script>";
				echo $mensaje;
			}
		}
		function consultar($consulta)
		{
			$conexion=conectar("localhost","root","root","igle");
			if ($conexion!=null) {
				$respuesta=mysql_query($consulta,$conexion);
				return $respuesta;
			}
			else{
				return null;
			}
		}
		 ?>
	</article>
	</section>
	<!--Pie de la pagian -->
	<hr>
	<footer>
		A Dios sea la gloria 2013 (Seguidores de Cristo)
	</footer>
	<table><tr></tr></table>
</body>
</html>