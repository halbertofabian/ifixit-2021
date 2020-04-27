$('.toast').toast('show');
$(document).ready(function () {
    $(".text_msj").on("change", function () {


        var datos = new FormData();

        datos.append("texto", $(this).val());
        datos.append("id", $(this).attr("idText"));
        datos.append("changeTextMsj", true);

        $.ajax({
            url: "ajax/configuraciones.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {

                if (respuesta) {
                    toastr.success('Texto guardado', 'Muy bien')
                }
            }
        })
    })
})