<?php 
	 session_start(); require '../../php/verificar.php';
	require_once "../../php/conexion.php";
	require('../../php/fpdf17/fpdf.php');

	class PDF extends FPDF
	{
		// Cabecera de página
		function Header()
		{
			// Arial bold 15
			$this->SetFont('Arial','B',15);
			// Movernos linea abajo
			$this->Ln(20);
			$this->Cell(10);
			// Título
			$this->Cell(0,10,'Iglesia Centroamericana El Candelero de Oro',1,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Ln(10);
			$this->Cell(0,10,'Base de Datos',0,0,'C');
			// Salto de línea
			$this->Ln(20);

		}

		// Pie de página
		function Footer()
		{
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Número de página
			$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function TablaColores($header, $contenido)
		{
			//Colores, ancho de línea y fuente en negrita
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
			for($i=0;$i<count($header);$i++)
			{
				if ($i==0) {
					$ancho[]=20;
				}
				else{
					if ($i==1 || $i==2) {
						$ancho[]=40;
					}
					else{
						$ancho[]=30;
					}
				}
			}
			//Cabecera
			for($i=0;$i<count($header);$i++)
				$this->Cell($ancho[$i],7,$header[$i],1,0,'C',1);
				$this->Ln();
						//Restauración de colores y fuentes
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			if ($contenido==null) {
				$this->Cell(60,7,"No existen elementos",1,0,'C',1);
				$this->Ln();
			}
			else{

			for ($i=0;$i<count($contenido); $i++) { 
				for ($j=0; $j <count($contenido[$i]) ; $j++) { 
					$this->Cell($ancho[$j],7,$contenido[$i][$j],1,0,'C',1);

				}
				$this->Ln();
				}
			}
		}
	}
	$conexion=conectar("localhost","root","root","igle");
	if ($conexion==null) {

			//si no existe se envia un mensaje a la consola del navegador
			$mensaje .= '<script name="accion"> console.log("problemas en la conexion") </script>';
			echo $mensaje;
			
		}

		//si existe
		else{
			$header[] ="id";
			$header[] ="nombre";
			$header[] ="apellidos";
			$consulta = "SELECT idhermano, Nombre, apellidos";
			if ($_POST["telefonos"]!=null) {
				$header[]="telefono";
				$header[]="celular";
				$consulta = $consulta.", telefono, celular";
			}
			// averiguando si se debe de mostrar la direccion
			if ($_POST["direccion"]!=null) {
				$header[]="direccion";
				$consulta = $consulta.", direccion";
			}
			$consulta = $consulta." FROM hermano";
			$respuesta=mysql_query($consulta,$conexion);
			if ($respuesta==null) {
				$tabla=null;
			}
			else{
				$i=0;
				while ( $fila=mysql_fetch_array($respuesta)) {
					$j=0;
					$tabla[$i][$j]=$fila["idhermano"];
					$j++;
					$tabla[$i][$j]=$fila["Nombre"];
					$j++;
					$tabla[$i][$j]=$fila["apellidos"];
					$j++;
					if ($_POST["telefonos"]!=null) {
						$tabla[$i][$j]=$fila["telefono"];
						$j++;
						$tabla[$i][$j]=$fila["celular"];
						$j++;
					}
					if ($_POST["direccion"]!=null) {
						$tabla[$i][$j]=$fila["direccion"];
					}
					$i++;
	
				}
			
			}
			//PDF

			$pdf = new PDF('P', 'mm');  
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Times','',12);
			$pdf->TablaColores($header,$tabla);
			$pdf->Output();
		}
 ?>