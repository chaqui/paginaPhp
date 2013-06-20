<?php 
require_once "php/conexion.php";
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
	
    <link rel="stylesheet" href="css/estilo1.css">
	<script src="javascript/jquery.js"></script>
   

	 <script type="text/javascript">
      function inicializar() {  
  
    if (GBrowserIsCompatible()) {  
        var map = new GMap2(document.getElementById("map-canvas"));  
        map.setCenter(new GLatLng(37.4419, -122.1419), 15);  
    }  
}  
    </script>

</head>
<body>	
	<header>
		<h1><div class="laE">E</div><div class="oro">l Candelero de Oro</div></h1>
		<h5>Iglesia Centroamericana</h5>
		<nav>
		<table class="menu">
			<tr>
				<td><a href="index.php">Inicio</a></td>
				<td><a href="comentarios.php">Comentarios</a></td>
				<td><a href="historia.html">Historia</a></td>
				<td><a href="galeria.html">Galeria</a></td>
			</tr>
		</table>
	</nav>
	<div class="ingresar"><a href="usuario/">Ingresar</a></div>
	</header>
    
	<section>
		<article>Puedes Ingresar un comentario sobre la pagina: <br>
			<form action="comentarios.php" method="POST">
				Nombre:
				<br>
				<input type="text" name="nombre">
				<br>
				Comentario:
				<br>
				<textarea name="comentario"  cols="65" rows="5">
					
				</textarea>
				<br>
				<input type="submit" value="enviar">
			</form>
			<?php 
				if ($_POST!=null) {
					$conexion=conectar("localhost","root","root","igle");
					if ($conexion!=null) {
						$consulta="INSERT INTO comentarios (nombre, comentario) VALUES ('".$_POST["nombre"]."','".$_POST["comentario"]."');";
						$respuesta=mysql_query($consulta,$conexion);
						mysql_free_result($consulta);
						mysql_close($conexion);
						actualizar();					
					}
					else{
						echo"fallo el ingreso del comentario pruebe mas al rato";
						actualizar();
					}
				}
				else{
					actualizar();
				}	
			function actualizar()
			{
				echo "Comentarios:";
				$conexion=conectar("localhost","root","root","igle");
				if ($conexion!=null) {
					$consulta="SELECT * FROM comentarios";
					$respuesta=mysql_query($consulta,$conexion);
					if ($respuesta!=null) {
						echo "<br>";

						while ( $fila=mysql_fetch_array($respuesta)) {
							echo "<br>";
							echo "<b>".$fila["nombre"].":</b>";
							echo "<div id='comentario'>".$fila["comentario"]."</div>";
							echo "<br>";
							echo "<hr>";
					}
					mysql_free_result($consulta);
					mysql_close($conexion);
					}
					else{
						echo "<br>";
						echo "no hay comentarios se el primero";
					}
				}
			}
			 ?>
		</article>
	</section>
	<footer>A Dios sea la gloria 2013.</footer>
</body>
</html>