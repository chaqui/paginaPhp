<?php 
	/*
	creando la funcion conectar la cual recibe los datos del nombre del servidor, el usuario, la contraseña y el nombre de la base de datos 
	*/
	 function conectar($servidor="localhost",$usuario="root", $contraseña="root",$bd="")
	{

		//se conecta al proveedor de base de datos en este caso mysql
		$conexion=mysql_connect($servidor,$usuario,$contraseña);
		if (!conexion) {
			return null;
		}

		//se conecta a la base de datos 
		if (!mysql_select_db($bd,$conexion)) {
			return null;
		}
		
		//se retorna la conexion
		return $conexion;
	}
 ?>