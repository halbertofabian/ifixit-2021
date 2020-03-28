

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


function cambiarEstado(id) {
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

}
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

$(".tablas tbody").on("click", ".btnEliminarServicio", function () {
	var id = $(this).attr("idServicio");

	swal({
		title: "¿Estas seguro de eliminar este servicio?",
		text: "Con número de orden " + id + " Al hacer esta operación no podras recuperar",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar orden de servicio!'

	}).then(function (result) {

		if (result.value) {

			window.location = "index.php?ruta=entregas&idServicio=" + id + "&bl=true";

		} else {

		}

	});
})
$(".tablas tbody").on("click", ".btnMsjWsp", function () {
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
			$("#numeroWp").text(respuesta.nombre+" "+numWp)

			var mensaje = "";

			if(estado=='Reparacion'){
				mensaje = "Hola querido(a) *[NOMBRE]*, gracias por tu preferencia 😊. Te mantendremos informado sobre la situación actual de tu servicio con número de orden *[ORDEN]*. No olvides visitar nuestras redes sociales: *[FACEBOOK]* *[INSTAGRAM]* *[TWITTER]* *[YOUTUBE]* También puedes consultar el estado actual de tu servicio en este enlace: *https://softmormx.com/consulta/* con la siguiente información, Sucursal: *[SUCURSAL]* Código: *[CODIGO]*. Nuestro sitio web es *[SITO-WB]*. Cualquier duda o aclaración no dudes en llamarnos *[TEL]*. Gracias nuevamente y saludos."
			}else if(estado == 'Reparado'){
				mensaje = "Hola querido(a) *[NOMBRE]*, por medio de este mensaje te notificamos que tu servicio con número de orden *[ORDEN]* ha sido ✅ *REPARADO* con *éxito* 🤩, se te hace la invitación a que pases por tu equipo, no olvides tu comprobante  🧾 . No olvides visitar nuestras redes sociales: *[FACEBOOK]* *[INSTAGRAM]* *[TWITTER]* *[YOUTUBE]* nuestro sitio web es *[SITO-WB]*. Cualquier duda o aclaración no dudes en llamarnos *[TEL]*. Gracias  saludos."
			}else if(estado == 'Entregado'){
				mensaje = "Hola querido(a) *[NOMBRE]*, tu servicio con número de orden *[ORDEN]* ha sido *ENTREGADO* con *éxito*, *GRACIAS POR CONFIAR EN NOSOTROS*, estamos seguros de que te ofrecimos un servicio de calidad, no olvides recomendarnos y compartir  nuestras redes sociales: *[FACEBOOK]* *[INSTAGRAM]* *[TWITTER]* *[YOUTUBE]* nuestro sitio web es *[SITO-WB]*. Cualquier duda o aclaración no dudes en llamarnos *[TEL]*. Gracias nuevamente  saludos."
			}else if(estado == 'No quedo'){
				mensaje = "Hola querido(a) *[NOMBRE]*, mala noticia  😞 por medio de este mensaje te notificamos que tu servicio con número de orden *[ORDEN]* no ha sido REPARADO con éxito debido ha: [NOTA], se te hace la invitación a que pases por tu equipo, no olvides tu comprobante  🧾 . Puedes visitar nuestras redes sociales: *[FACEBOOK]* *[INSTAGRAM]* *[TWITTER]* *[YOUTUBE]*. También puedes consultar el estado actual de tu servicio en este enlace: *https://softmormx.com/consulta/* con la siguiente información, Sucursal: *[SUCURSAL]* Código: *[CODIGO]*. Nuestro sitio web es *[SITO-WB]*. Cualquier duda o aclaración no dudes en llamarnos *[TEL]*. Gracias saludos.";
			}else if(estado == 'Entregado no quedo'){
				mensaje = "Hola querido(a) *[NOMBRE]*, tu servicio con número de orden *[ORDEN]* ha sido *ENTREGADO* con *éxito*, lamentamos que tu equipo no haya tenido solución 😞  *GRACIAS POR CONFIAR EN NOSOTROS*, estamos seguros de que te ofrecimos un servicio de calidad, no olvides visitar nuestras redes sociales: *[FACEBOOK]* *[INSTAGRAM]* *[TWITTER]* *[YOUTUBE]* nuestro sitio web es *[SITO-WB]*. Cualquier duda o aclaración no dudes en llamarnos *[TEL]*. Gracias nuevamente, saludos.";
			}else if(estado == 'Laboratorio'){
				mensaje = "Hola querido(a) *[NOMBRE]*, por medio de este mensaje te notificamos que tu servicio con número de orden *[ORDEN]* está en el laboratorio 🔬, nuestros técnicos expertos 👩🏻‍🔧👨🏻‍🔧 están trabajando en tu equipo, te mantendremos informado sobre la situación actual. No olvides visitar nuestras redes sociales: *[FACEBOOK]* *[INSTAGRAM]* *[TWITTER]* *[YOUTUBE]* También puedes consultar el estado actual de tu servicio en este enlace: *https://softmormx.com/consulta/* con la siguiente información, Sucursal: *[SUCURSAL]* Código: *[CODIGO]*. Nuestro sitio web es *[SITO-WB]*. Cualquier duda o aclaración no dudes en llamarnos *[TEL]*. Gracias nuevamente y saludos."
			}

			$("#textwp").val(mensaje)
			$("#codigoWP").val(codigo)
			$("#textNumWp").val(numWp)
			$("#nombreWP").val(respuesta.nombre)
			$("#codeWP").val(respuesta.codigo_cliente)
			$("#notaWP").val(respuesta.nota)





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
				$("#codigo option[value="+ wsp.substring(0, 2) +"]").attr("selected",true);
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

	$("#ordenAbono").val(idServicio);


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




// Abonos 






