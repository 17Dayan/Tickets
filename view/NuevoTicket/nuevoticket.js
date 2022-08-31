$(document).on("submit", "form#ticket_form", function(event) {
    event.preventDefault();
    guardaryeditar();
});



function init() {

}

$(document).ready(function() {
    $('descripcion_ticket').summernote({
        height: 150
    });

    $.post("../../controller/categoria.php?op=combo", function(data, status) {
        $('#id_categoria').html(data);
    });
});


function guardaryeditar() {
    var formData = new FormData($("#ticket_form")[0]);
    $.ajax({
        url: "../../controller/ticket.php?op=insert",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            data = JSON.parse(data);
            console.log(data.id_ticket);

            $.post("../../controller/correo.php?op=ticket_abierto", { id_ticket: data.id_ticket },
                function(data) {

                });

            $('#asunto_ticket').val('');
            $('#descripcion_ticket').summernote('reset');
            swal("Correcto!", "Registrado Correctamente", "success");
        },
        error: function() {
            swal("Incorrecto!", "No se pudo reistrar correctamente.", "success");
        }

    });
}

init();