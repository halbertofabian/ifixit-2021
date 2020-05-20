

//Calcular adeudo

$('.importe').on('keyup', function () {
	var importe = $('.importe').val();

	var anticipo = $('.anticipo').val();


	var total = importe - anticipo;

	$('.total').val(total);

})
$('.anticipo').on('keyup', function () {
	var importe = $('.importe').val();

	var anticipo = $('.anticipo').val();



	var total = importe - anticipo;

	$('.total').val(total);

})


/*function cambiarEstado(id) {
	var estado;
	var anticipo;

	$(".tablas").on("change", ".estado_equipo", function () {
		estado = this.value;
		anticipo = $(this).attr("anticipo");
		swal({
			title: "¿Estas seguro de módificar el estado de servicio?",
			text: "Con número de orden " + id,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, cambiar estado de servicio!'

		}).then(function (result) {

			if (result.value) {

				//window.location = "ajax/servicios.ajax.php";
				window.location = "ajax/servicios.ajax.php?orden=" + id + "&estado=" + estado + "&anticipo=" + anticipo;

			} else {
				window.location = "entregas";
			}

		});




	});
	console.log(estado);
	//

}*/

$(".tablas tbody").on("click", ".btnCambiarEstadoOrden", function () {


	var estadoServicio = $(this).attr('estadoEquipo')

	var estado = "";
	var idServicio = $(this).attr('idServicio')

	var anticipo = Number($(this).attr('anticipo'))
	var importe = Number($(this).attr('importe'))

	var nota = $(this).attr('nota');
	$("#text-orden").html(idServicio)



	$(".estado_equipo").val("");








	if (estadoServicio == "No quedo") {
		$(".notaOrdenEstado").removeClass("d-none");
		$("#notaServicioEstado").val(nota)

	} else {


		$(".notaOrdenEstado").addClass("d-none");

	}
	if (estadoServicio == "Entregado") {
		$(".pagoOrdenEstado").removeClass("d-none");


		//$("#notaServicioEstado").val(nota)
	} else {


		$(".pagoOrdenEstado").addClass("d-none");

	}

	$(".estado_equipo").change(function () {


		estadoServicio = $(this).val();

		if (estadoServicio == "No quedo") {
			$(".notaOrdenEstado").removeClass("d-none");
			//nota = $("#notaServicioEstado").val()
		} else {
			$(".notaOrdenEstado").addClass("d-none");

		}


		if ($(this).val() == "Entregado") {
			$(".pagoOrdenEstado").removeClass("d-none");

			$("#total").val(importe)
			$("#anticipo").val(anticipo)
			var adeuda = importe - anticipo;
			$("#adeuda").val(adeuda)


			// $("#pagaCon").val(adeuda)
			// $("#cambioDe").val(0)

			$("#pagaCon").on("keyup", function () {
				var paga = Number($(this).val())
				var cambio = paga - adeuda;
				$("#cambioDe").val(cambio)


			})







		} else {
			$(".pagoOrdenEstado").addClass("d-none");

		}
	})



	$(document).on('submit', '#formEstadoServicio', function (e) {
		e.preventDefault();
		nota = $("#notaServicioEstado").val()
		swal({
			title: "¿Estas seguro de módificar el estado de servicio?",
			text: "Con número de orden " + idServicio,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, cambiar estado de servicio!'

		}).then(function (result) {

			if (result.value) {

				//window.location = "ajax/servicios.ajax.php";
				window.location = "index.php?ruta=entregas&orden=" + idServicio + "&estado=" + estadoServicio + "&anticipo=" + anticipo + "&nota=" + nota;

			} else {
				window.location = "entregas";
			}

		});

	})



})
/* Ver detaller */

$(".tablas tbody").on("click", ".btnVerServicio", function () {
	var id = $(this).attr("idServicio");
	window.location = "ajax/servicios.ajax.php?servicio=" + id;
})
/* Imprimir tiket */
$(".tablas tbody").on("click", ".btnImprimirTiket", function () {
	var id = $(this).attr("idServicio");
	window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=" + id, "_blank");
})

/* Imprimir tiket */
$(".btnImprimirTiket-view").on("click", function () {
	var id = $(this).attr("idServicio");
	window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=" + id, "_blank");
})

// $(".tablas tbody").on("click", ".btnEliminarServicio2", function () {
// 	var id = $(this).attr("idServicio");



// 	swal({
// 		title: "¿Estas seguro de eliminar este servicio?",
// 		text: "Con número de orden " + id + " Al hacer esta operación no podras recuperar",
// 		type: "warning",
// 		showCancelButton: true,
// 		confirmButtonColor: '#3085d6',
// 		cancelButtonColor: '#d33',
// 		cancelButtonText: 'Cancelar',
// 		confirmButtonText: 'Si, borrar orden de servicio!'

// 	}).then(function (result) {

// 		if (result.value) {

// 			window.location = "index.php?ruta=entregas&idServicio=" + id + "&bl=true";

// 		} else {

// 		}

// 	});
// })

$(".tablas tbody").on("click", ".btnEliminarOrdenServicio", function () {
	var id = $(this).attr("idServicio");
	var anticipo = $(this).attr("anticipo");
	var msj = "Con número de orden " + id + ". Al hacer esta operación no podras recuperar";
	if (anticipo > 0) {
		msj = "Este servicio con número de orden "+id+" que intentas eliminar cuenta con un historial de ingresos, si deseas continuar estos mismos serán reportados a gastos como cancelación de servicio";
	}

	swal({
		title: "¿Estas seguro de eliminar este servicio?",
		text: msj,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar orden de servicio'

	}).then(function (result) {

		if (result.value) {


			var datos = new FormData();
			datos.append('orden', id)
			datos.append('btnEliminarServicio', true)
			$.ajax({

				url: "ajax/servicios.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				beforeSend: function () {
					$('.btnEliminarServicio').attr("disabled", true)
					$('.btnEliminarServicio').html("Eliminado...")

				},
				success: function (res) {
					$('.btnEliminarServicio').attr("disabled", false)
					$('.btnEliminarServicio').html(`<i class="fa fa-times"></i>`)

					console.log(res)

					if (res) {
						swal({
							title: "Muy bien",
							text: res.mensaje,
							type: "success",
							buttons: [false, 'Continuar'],
							dangerMode: true,
						})
							.then(function (result) {
								if (result.value) {

									window.location.href = "entregas"

								} else {
									window.location.href = "entregas"

								}
							});

					} else {
						swal({
							title: "Error",
							text: res.mensaje,
							type: "error",
							buttons: [false, 'Ok'],
							dangerMode: true,
						})
							.then(function (result) {
								if (result.value) {

								}
							});
					}

				}
			})

		}
	})

})


$(".tablas tbody").on("click", ".btnMsjWsp", function () {
	$("#textwp").val("Cargando...")
	var codigo = $(this).attr("codigoServicio");
	var numWp = $(this).attr("numWp");


	var datos = new FormData();
	datos.append("idServicio", codigo);

	// console.log(idServicio);
	$.ajax({
		url: "ajax/servicios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			var estado = respuesta.estado_equipo;
			$("#numeroWp").text(respuesta.nombre + " " + numWp)



			var datos = new FormData();
			datos.append("atributo", estado)
			datos.append("btnObtenerEstado", estado)

			$.ajax({
				url: "ajax/configuraciones.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (res) {


					$("#textwp").val(res.valor)
					$("#codigoWP").val(codigo)
					$("#textNumWp").val(numWp)
					$("#nombreWP").val(respuesta.nombre)
					$("#codeWP").val(respuesta.codigo_cliente)
					$("#notaWP").val(respuesta.nota)


				}
			})







		}
	})






})
$(".tablas tbody").on("click", ".btnMsjCorreo", function () {
	$("#textcorreo").val("Cargando...")
	var codigo = $(this).attr("codigoServicio");
	var correo = $(this).attr("correo");


	var datos = new FormData();
	datos.append("idServicio", codigo);

	// console.log(idServicio);
	$.ajax({
		url: "ajax/servicios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			var estado = respuesta.estado_equipo;
			$("#correoMsj").text(respuesta.nombre + " " + correo)



			var datos = new FormData();
			datos.append("atributo", estado)
			datos.append("btnObtenerEstado", estado)

			$.ajax({
				url: "ajax/configuraciones.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (res) {


					$("#textcorreo").val(res.valor)
					$("#codigoEM").val(codigo)
					$("#correo_des").val(correo)
					$("#nombreEM").val(respuesta.nombre)
					$("#codeEM").val(respuesta.codigo_cliente)
					$("#notaEM").val(respuesta.nota)


				}
			})







		}
	})






})

$(document).on("submit", "#formSendStatusEmail", function (e) {
	e.preventDefault();
	$(".btnMandarCorreo").html("Enviando correo...")
	$(".btnMandarCorreo").attr("disabled", true);

	if ($("#correo_des").val() == "") {
		toastr.warning('El campo correo debe ser valido', 'Advertencia')
		$(".btnMandarCorreo").html("Mandar correo")
		$(".btnMandarCorreo").attr("disabled", false);
	}

	var data = new FormData(this);
	data.append("btnMandarCorreo", true);

	$.ajax({
		url: "ajax/servicios.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			$(".btnMandarCorreo").html("Mandar correo")
			$(".btnMandarCorreo").attr("disabled", false);
			$('#mdlEmailStatus').modal('hide')


			if (respuesta) {
				toastr.success('Correo enviado', 'Muy bien')
			} else {
				toastr.error('No se pudo mandar el correo', 'Error')

			}
		}
	})




})



$(".tablas tbody").on("click", ".btnEditarServicio", function () {
	var idServicio = $(this).attr("idServicio");
	window.location = "index.php?ruta=servicios&editarServicio=" + idServicio;
	//console.log(idServicio);

})


function imprimirTiketPresupuesto(id) {


	var respuesta = confirm("¿Desea imprimir tiket?")

	// Caso de Aceptar
	if (respuesta) {
		window.location = "ajax/presupuestos.ajax.php?orden=" + id + "&tiket=true";
	}
	else
		window.history.go(-1);
	//window.location = "";
	//


	//

}

/*$(".tablas").on("change", ".estado_equipo", function(){
	
	 var estado = this.value;
	   
	 $(".formEstado").submit();
		  //window.location = "ajax/servicios.ajax.php";
  

	/*var idServicio = $(this).attr("idServicio");
	console.log(estado);
	
	var datos = new FormData();

	datos.append("idServicio", idServicio);
	datos.append("estado",estado);
	
	$.ajax({

	  url:"ajax/servicios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      		if(window.matchMedia("(max-width:767px)").matches){

	      		 swal({
			      title: "El usuario ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "Entrega";

			        }


				});

	      	}

      }

  	})*/

$(".tablaServicios tbody").on("click", "button.btnEditarNota", function () {

	var idServicio = $(this).attr("idServicio");

	var datos = new FormData();
	datos.append("idServicio", idServicio);

	// console.log(idServicio);
	$.ajax({
		url: "ajax/servicios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			$("#orden").val(respuesta["orden"]);
			$("#textNota").val(respuesta["nota"]);
		}
	})


})










$(buscar_datos(null));



function buscar_datos(consulta) {

	$.ajax({
		url: 'ajax/servicios.ajax.php',
		type: 'post',
		dataType: 'html',
		data: { consulta: consulta },

	})
		.done(function (respuesta) {
			console.log(respuesta);
			$("#datos").html(respuesta);
		})
		.fail(function () {
			console.log('error');
		})
}

$(document).on('keyup', '#box-search', function () {
	var valor = $(this).val();
	if (valor != "") {
		buscar_datos(valor)
	} else {
		buscar_datos(null);
	}

})

$(document).on('click', '#btnEliminarServPre', function () {

	var idServ = $(this).attr("idServ");

	swal({
		title: "¿Estas seguro de eliminar este servicio precargado?",
		text: "Al hacer esta operación no podras recuperar",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar  servicio!'

	}).then(function (result) {

		if (result.value) {

			$.ajax({
				url: 'ajax/servicios.ajax.php',
				type: 'post',
				dataType: 'json',
				data: { borrarServicio: idServ },

			})
				.done(function (respuesta) {
					console.log("respuesta", respuesta);

					if (respuesta) {
						buscar_datos(null);
					}
					//$("#datos").html(respuesta);  	
				})
				.fail(function () {
					console.log('error');
				})

		} else {

		}

	});


})


$(document).on('click', '#btnEditarServPre', function () {

	var idServ = $(this).attr("idServ");

	console.log(idServ)

	$.ajax({
		url: 'ajax/servicios.ajax.php',
		type: 'post',
		dataType: 'json',
		data: { idServicioPre: idServ },

	})
		.done(function (respuesta) {
			console.log("respuesta", respuesta);

			$("#nuevoNombre").val(respuesta["nombre"])
			$("#nuevoTipo_equipo").val(respuesta["tipo_equipo"])
			$("#nuevaMarca").val(respuesta["marca"])
			$("#nuevoModelo").val(respuesta["modelo"]);
			$("#nuevoPrecio").val(respuesta["precio"]);
			$("#id").val(respuesta["id"]);
			//$("#textNota").val(respuesta["nota"]);

			//$("#datos").html(respuesta);  	
		})
		.fail(function (repuesta) {
			console.log(repuesta);
		})




})

$("#mySelect2").change(function () {





	var idCliente = $(this).val();
	//alert(idCliente)
	var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({

		url: "ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			$("#nombre").val("");
			$("#email").val("");
			$("#contacto").val("");
			$("#codigo").val("");
			$("#wsp").val("");
			//$("#codigo option[value=""]").attr("selected",true);


			//$("#idCliente").val(respuesta["id"]);
			$("#nombre").val(respuesta["nombre"]);

			$("#email").val(respuesta["email"]);
			$("#contacto").val(respuesta["telefono"]);
			var wsp = respuesta["wsp"];
			if (wsp.length > 0) {

				//alert(wsp.substring(0, 2)+" "+wsp.substring(2, 12))
				//$("#codigo").val(wsp.substring(0, 2));
				$("#codigo option[value=" + wsp.substring(0, 2) + "]").attr("selected", true);
				$("#wsp").val(wsp.substring(2, 12));
			}


		}

	})

})


$(document).on('click', '#pasarWP', function () {

	var wp = $(".mandarWP").val();
	var wp = wp.replace("(", "");
	var wp = wp.replace(")", "");
	var wp = wp.replace(" ", "");
	var wp = wp.replace("-", "");

	$(".recibir-wp").val(wp);



})




$(document).on("click", ".btnAbonos", function () {

	var idServicio = $(this).attr("idServicio");

	$("#formBurcarServicio").val(idServicio);


})

if ($(".theDate")) {

	var date = new Date();

	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();

	if (month < 10) month = "0" + month;
	if (day < 10) day = "0" + day;

	var today = year + "-" + month + "-" + day;
	// Siempre será validado, incluso si #undiv no existe
	//document.getElementsByClassName('theDate').value = today;

	$(".theDate").val(today);
}

// Abonos 


var importe = 0;

$(document).on("submit", "#formBurcarServicio", function (e) {
	e.preventDefault();
	buscarAbono($("#abonoServicio").val())
})




$(document).on("submit", "#formAbono", function (e) {
	e.preventDefault();


	var abono = Number($("#abonoInput").val());



	var orden = $("#ordenServicio").val();

	var estado = "";

	if (abono <= 0) {
		toastr.error('El abono no puede ser menor igual a 0, intente con otra cantidad', 'Error')
		return;
	}
	if (abono > importe) {
		toastr.error('El abono supera la cantidad del adeudo, intente con otra cantidad', 'Error')
		return;
	}

	if (abono == importe) {

		swal({
			title: "Detectamos que este servicio está a punto de ser liquidado",
			text: "¿Quieres marcar el servicio con número de orden " + orden + " como entregado ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'No',
			confirmButtonText: 'Si, entregar servicio'

		}).then(function (result) {

			if (result.value) {
				estado = "Entregado"
				var datos = new FormData();
				datos.append('orden', orden)
				datos.append('estado_equipo', estado)
				datos.append('abono', abono)
				datos.append('btnAbonarServicio', true)

				$.ajax({

					url: "ajax/servicios.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					beforeSend: function () {
						$(".btnAbonarServicio").attr("disabled", true)
					},
					success: function (respuesta) {
						console.log(respuesta)
						$(".btnAbonarServicio").attr("disabled", false)

						if (respuesta.status) {
							toastr.success(respuesta.mensaje, 'Bien hecho')
							buscarAbono(orden)
							window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=" + orden, "_blank");

						} else {
							toastr.error(respuesta.mensaje, 'Error')
						}
					}
				})

				return;

			} else {
				var datos = new FormData();
				datos.append('orden', orden)
				datos.append('estado_equipo', estado)
				datos.append('abono', abono)
				datos.append('btnAbonarServicio', true)

				$.ajax({

					url: "ajax/servicios.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					beforeSend: function () {
						$(".btnAbonarServicio").attr("disabled", true)
					},
					success: function (respuesta) {
						console.log(respuesta)
						$(".btnAbonarServicio").attr("disabled", false)
						if (respuesta.status) {
							toastr.success(respuesta.mensaje, 'Bien hecho')
							buscarAbono(orden)
							window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=" + orden, "_blank");

						} else {
							toastr.error(respuesta.mensaje, 'Error')
						}
					}
				})
			}
		})


	} else {

		var datos = new FormData();
		datos.append('orden', orden)
		datos.append('estado_equipo', estado)
		datos.append('abono', abono)
		datos.append('btnAbonarServicio', true)

		$.ajax({

			url: "ajax/servicios.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			beforeSend: function () {
				$(".btnAbonarServicio").attr("disabled", true)
			},
			success: function (respuesta) {
				console.log(respuesta)
				$(".btnAbonarServicio").attr("disabled", false)
				if (respuesta.status) {
					toastr.success(respuesta.mensaje, 'Bien hecho')
					buscarAbono(orden)
					window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=" + orden, "_blank");

				} else {
					toastr.error(respuesta.mensaje, 'Error')
				}
			}
		})
	}

	/// 

})


$(".tablasAbono tbody").on("click", "button.btnEliminarAbono", function () {

})

function eliminarAbono(idServicio, idMovimiento, monto) {

	swal({
		title: "¡Advertencia!",
		text: "¿Estás seguro de eliminar el abono con número de movimiento " + idMovimiento + "?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, eliminar abono'

	}).then(function (result) {

		if (result.value) {

			var datos = new FormData();
			datos.append('orden', idServicio)
			datos.append('monto', monto)
			datos.append('id_movimiento', idMovimiento)
			datos.append('btnEliminarAbono', true)
			$.ajax({

				url: "ajax/servicios.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				beforeSend: function () {
					$(".btnEliminarAbono").attr("disabled", true)
				},
				success: function (respuesta) {
					$(".btnEliminarAbono").attr("disabled", false)

					if (respuesta.status) {
						toastr.success(respuesta.mensaje, 'Bien hecho')
						buscarAbono(idServicio)

					} else {
						toastr.error(respuesta.mensaje, 'Error')

					}



				}
			})


		}
	})

}


//
if ($("#theDate")) {

	var date = new Date();

	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();

	if (month < 10) month = "0" + month;
	if (day < 10) day = "0" + day;

	var today = year + "-" + month + "-" + day;
	// Siempre será validado, incluso si #undiv no existe
	document.getElementById('theDate').value = today;
}



function buscarAbono(ordenSearch) {
	var datos = new FormData();

	datos.append("btnBuscarServicio", true)


	datos.append("id_servicio", ordenSearch)
	$.ajax({

		url: "ajax/servicios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			console.log(respuesta)


			if (respuesta) {

				$adeudo = Number(respuesta.importe) - Number(respuesta.anticipo)
				//console.log($adeudo)
				$("#ordenServicio").val(respuesta.orden)
				$("#ordenNombre").val(respuesta.nombre)
				$("#ordenImporte").val(respuesta.importe)
				$("#ordenAnticipo").val(respuesta.anticipo)
				$("#ordenAdeuda").val($adeudo)

				importe = $adeudo;



				if (respuesta.estado_equipo == "Entregado" || respuesta.estado_equipo == "Entregado no quedo") {
					$(".contenedor-abono").addClass("d-none")
					$(".btnEliminarAbono").addClass("d-none")



					// 		$("#resAbono").html(`
					// 		<div class="alert alert-danger text-center" role="alert">
					// 	Este servicio ya fue entregado
					//   </div>
					// 		`);

					// 		return;

				} else {
					$(".contenedor-abono").removeClass("d-none")
				}


				var datos = new FormData();
				datos.append("btnBuscarAbono", true)
				datos.append("id_servicio", $("#abonoServicio").val())

				$.ajax({

					url: "ajax/servicios.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "html",
					success: function (res) {

						$("#resAbono").html(res)
					}
				})
			} else {
				$("#resAbono").html(`
				<div class="alert alert-danger text-center" role="alert">
			Servicio no encontrado
		  </div>
				`);
				$(".contenedor-abono").addClass("d-none")

			}



			//$("#resAbono").html(respuesta)
		}


	})
}






