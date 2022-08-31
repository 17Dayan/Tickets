function init() {}

$(document).ready(function() {

});

$(document).on("click", "#btnsoporte", function() {
    if ($('#id_usuario_rol').val() == 1) {
        $('#asunto_ticket').html("Acceso Soporte");
        $('#btnsoporte').html("Acceso Usuario");
        $('#id_usuario_rol').val(2);
        $("#imgtipo").attr("src", "public/2.jpg");
    } else {
        $('#asunto_ticket').html("Acceso Usuario");
        $('#btnsoporte').html("Acceso Soporte");
        $('#id_usuario_rol').val(1);
        $("#imgtipo").attr("src", "public/1.jpg");
    }
});


$(document).on("submit", "#login_form", function(e) {
    e.preventDefault();

    var formData = new FormData($("#login_form")[0]);
    $.ajax({
        url: "./controller/usuario.php?op=access",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {

            switch (data) {
                case "1":
                    alert("Credenciales Incorrectas");
                    break;

                case "2":
                    alert("Campos vacios");
                    break;

                case "100":
                    url = "./view/Home/";
                    $(location).attr('href', url);
                    break;
                default:
                    alert("Ocurrio un error en el servidor.[1]");
                    console.log(data);
            }


        },
        error: function() {
            alert("Ocurrio un error en el servidor.")
        }

    });

});



init();