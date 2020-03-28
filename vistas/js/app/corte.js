
//Imprimir tiket corte
$(".tablas tbody").on("click",".btnImprimirCorte",function(){
	var id = $(this).attr("idCorte");
	
	//window.location = "index.php?ruta=entregas&idServicio="+id+"&bl=true";
	 window.open("extensiones/tcpdf/pdf/corte.php?codigo="+id, "_blank");
})
//Borrar Corte
$(".tablas tbody").on("click",".btnBorrarCorte",function(){
	var id = $(this).attr("idCorte");
	
	swal({
	  title: "¿Estas seguro de eliminar este corte?",
	  text: "Con número de corte "+id+" Al hacer esta operación no podras recuperar",
	  type: "warning",
	 showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar corte!'
	
	 }).then(function(result){

	 	if(result.value){

	 	window.location = "index.php?ruta=corte&idCorte="+id;

	 	}

	 });
})
$(".tablas tbody").on("click",".btnBorrarGasto",function(){
	var id = $(this).attr("idGasto");
	
	swal({
	  title: "¿Estas seguro de eliminar este gasto?",
	  text: "Al hacer esta operación no podras recuperar",
	  type: "warning",
	 showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar gasto!'
	
	 }).then(function(result){

	 	if(result.value){

	 	window.location = "index.php?ruta=egresos&idGasto="+id;

	 	}

	 });
})
$(".tablas tbody").on("click",".btnBorrarIngreso",function(){
	var id = $(this).attr("idIngreso");
	
	swal({
	  title: "¿Estas seguro de eliminar este ingreso?",
	  text: "Al hacer esta operación no podras recuperar",
	  type: "warning",
	 showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar ingreso!'
	
	 }).then(function(result){

	 	if(result.value){

	 	window.location = "index.php?ruta=ingresos&idIngreso="+id;

	 	}

	 });
})