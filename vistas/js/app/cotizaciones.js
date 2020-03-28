
$(".tablas tbody").on("click",".btnImprimirTiketC",function(){
	var id = $(this).attr("idCotizacion");
	 window.open("extensiones/tcpdf/pdf/presupuesto-factura.php?codigo="+id, "_blank");
})
$(".btnBorrarCotizacion").on("click",function(){
	var id = $(this).attr("idCotizacion");
	
	swal({
	  title: "¿Estas seguro de eliminar esta cotizacion?",
	  text: "Con número de presupuesto "+id+" Al hacer esta operación no podras recuperar",
	  type: "warning",
	 showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar cotizacion!'
	
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=lista-cotizaciones&idCotizacion="+id;

	 	}else{

	 	}

	 });
})