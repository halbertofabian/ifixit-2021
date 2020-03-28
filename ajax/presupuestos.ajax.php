<?php

session_start();

require_once "../controladores/presupuestos.controlador.php";
require_once "../modelos/presupuestos.modelo.php";


	if (isset($_GET['tiket']) && isset($_GET['orden'])) {
			//header("location:../extensiones/tcpdf/pdf/presupuesto-factura.php?codigo=".$_GET['orden']);
		echo '<script>window.open("../extensiones/tcpdf/pdf/presupuesto-factura.php?codigo='.$_GET['orden'].'", "_blank");</script>';
		}

	    

	
	if(isset($_GET['serach'])){
		$_SESSION['presupuesto'] = $_GET['serach'];
		var_dump($_GET['serach']);
		header("location:../servicios");

	}




