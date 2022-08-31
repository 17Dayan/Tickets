var tabla;

function init() {

}

$(document).ready(function() {

    $.post("../../controller/usuario.php?op=combo", function(data) {
        $('#usu_asig').html(data);
    });

    tabla = $('#ticket_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
            'excelHtml5',
        ],
        "ajax": {
            url: '../../controller/ticket.php?op=listar_x_usuario',
            type: "post",
            dataType: "json",
            dataSrc: 'data',
            error: function(e) {
                console.log(e.responseText);
            }
        },
        columns: [
            { data: 'id_ticket' },
            { data: 'asunto_ticket' },
            { data: 'descripcion_ticket' },
            { data: 'descripcion_estado' },
            { data: 'fecha_creacion' },
            { data: 'fecha_respuesta' }
        ],
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();

});

function ver(ticket_id) {
    console.log(ticket_id);
}
init();