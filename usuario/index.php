<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Base de Dato "EL CANDELERO DE ORO"</title>
	<link rel="stylesheet" href="../css/principal1.css">
	<script src="../javascript/jquery.js"></script>
	<script src="../javascript/scripts.js"></script>

</head>
<body>
	<header>
		<h1><div class="laE">E</div><div class="oro">l Candelero de Oro</div></h1>
		<h5>Iglesia Centroamericana</h5>
		<nav>
			<table class="menu">
				<tr>
					<td class="menus"><a href="../index.php" >Inicio</a></td>
					<td class="menus"><a href="../comentarios.php" >Comentarios</a></td>
					<td class	="menus"><a href="../historia.html" >Historia</a></td>
					<td class="menus"><a href="../galeria.html" >Galeria</a></td>
				</tr>
			</table>
		</nav>
	</header>
	<section>
		<article>
			Bienvenidos a esta aplicación la cual esta desarrollada para contener toda la informacion de los hermanos de la Iglesia Centroamericana "El Candelero de Oro". 
			<!-- Php -->
			<?php  session_start(); 
				if(isset($_POST['login'])) 
				{
					$pass = $_POST['pass']; 
					$comparar = md5 ($pass); 
					$clave = '1d1crvtg'; 
					$final = md5 ( $clave ); 
				if ( $comparar == $final ) { 
	    			$_SESSION['listo'] = true; 
	    			header('Location: seguro/'); 
	    			exit;
					} 
					else 
						{
			?>
			<!-- JavaScript -->
					<script type="text/javascript">
					<!--
						alert('La contraseña no es correcta')
					//-->
					</script>
			<!-- Php -->
			<?php
					}
				}
			?> 
			<br>
			<!-- Formulario de Ingreso-->
			<form method="post" action="index.php" class="formulario">
				Porfavor introduzca la clave para ingresar al sistema:
				<input type="password" name="pass">
				<input type="submit" name="login" value="Login" />
			</form>
		</article>
	</section>
	<footer>
		A Dios sea la gloria 2013 (Seguidores de Cristo)
	</footer>

</body>
</html>