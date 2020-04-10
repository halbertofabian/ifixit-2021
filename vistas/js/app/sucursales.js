$(document).ready(function () {

   



    $(".btnEliminarLogoSuc").on("click", function () {
        var nom_suc = $(this).attr("nomSuc")

        var datos = new FormData();
        datos.append('nom_suc', nom_suc)
        datos.append('isDeleteLogo', true);

        $.ajax({

            url: "ajax/sucursales.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta) {

                    var rutaImagen = 'vistas/img/productos/default/anonymous.png';

                    $(".previsualizar").attr("src", rutaImagen);

                    $(".btnEliminarLogoSuc").addClass("d-none")


                }
            }
        })
    })
})

function updateTable() {
    $('#modalUpdateSuc').modal('show')




    //$('#modalUpdateSuc').modal('dispose')

}