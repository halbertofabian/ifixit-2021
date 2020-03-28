
//Imprimir tiket corte
$(".tablas tbody").on("click", ".btnImprimirTiketP", function () {
	var id = $(this).attr("idPedido");

	//window.location = "index.php?ruta=entregas&idServicio="+id+"&bl=true";
	window.open("extensiones/tcpdf/pdf/pedido-factura.php?codigo=" + id, "_blank");
})

//Eliminar servicio
$(".tablas tbody").on("click", ".btnBorrarP", function () {
	var id = $(this).attr("idPedido");

	swal({
		title: "¿Estas seguro de eliminar este pedido?",
		text: "Con número de pedido " + id + " Al hacer esta operación no podras recuperar",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar pedido!'

	}).then(function (result) {

		if (result.value) {

			window.location = "index.php?ruta=lista-pedidos&idPedido=" + id + "&bl=true";

		} else {

		}

	});
})

function cambiarEstadoPedido(pedido) {
	//cambiar estado
	var estado;

	$(".tablas").on("change", "#estadoSeleccionado", function () {
		estado = this.value;
		anticipo = $(this).attr("anticipo");
		swal({
			title: "¿Estas seguro de módificar el estado de pedido?",
			text: "Con número de pedido " + pedido,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, cambiar estado de pedido!'

		}).then(function (result) {

			if (result.value) {

				//window.location = "ajax/servicios.ajax.php";
				window.location = "index.php?ruta=lista-pedidos&idPedido=" + pedido + "&estado=" + estado+"&anticipo="+anticipo;

			} else {
				window.location = "lista-pedidos";
			}

		});




	});

	
}