<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>El Candelero de Oro</title>
	
	<link rel="stylesheet" href="css/slideshow.css">
    <link rel="stylesheet" href="css/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/estilo1.css">
     <link rel="stylesheet" href="css/estilo1.css">
	<script src="javascript/jquery.js"></script>
    <script type="text/javascript" src="javascript/jquery.nivo.slider.js"></script>
    <script src="javascript/script.js"></script>
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCATXHkVZo7Un3_RKyiKBZTtjj8gAq1OS0&sensor=true">
    </script>

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
				<td><a href="comentarios.php">comentarios</a></td>
				<td><a href="historia.html">Historia</a></td>
				<td><a href="galeria.html">Galeria</a></td>
			</tr>
		</table>
	</nav>
	<div class="ingresar"><a href="usuario/">Ingresar</a></div>
	</header>
    <div>
        <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            <img src="img/cabecera/1.jpg" data-thumb="images/cabecera/1.jpg" alt="" />
            <img src="img/cabecera/2.jpg" data-thumb="images/cabecera/2.jpg"/>
            <img src="img/cabecera/3.jpg" data-thumb="images/cabecera/3.jpg"/>
            <img src="img/cabecera/4.jpg" data-thumb="images/cabecera/4.jpg" />
        </div>
    </div>
    </div>
     
	<section>
		<article>Bienvenidos a la pagina oficial de la Iglesia Centroamericana "El Candelero de Oro" creada por 
 Josue Isaac Fuentes López 2690-11-2963
		<div id="map-canvas" style="width: 100%; height: 100%">
     <script type="text/javascript">inicializar();</script>  
     </div>
		</article>
		
		<aside>
			<h4>Actividades:</h4>
		</aside>
	</section>
	<footer>A Dios sea la gloria 2013.</footer>
</body>
</html>