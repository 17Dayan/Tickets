$(document).ready(function() {
    consultarTickets();
});


function consultarTickets() {
    $.ajax({
        url: "../../controller/ticket.php?op=listar_x_usuario",
        type: "POST",
        success: function(data) {
            cargarDataTickets(data);
        },
    });
}

function cargarDataTickets(data) {
    let totalTickets = 0;
    let totalTicketsAbiertos = 0;
    let totalTicketsCerrados = 0;


    data = JSON.parse(data);
    //Obtenemos el total de tickets
    totalTickets = data.iTotalRecords;

    //Recorremos los tickets
    data.aaData.forEach(ticket => {

        //Pregunto si su estado es igual a "Abierto".
        if (ticket.descripcion_estado == "Abierto")
            totalTicketsAbiertos++;
        //Pregunto si su estado es igual a "Cerrado".
        if (ticket.descripcion_estado == "Cerrado")
            totalTicketsCerrados++;
    });

    //Visualizo resultados en el HTML
    $("div#lbltotal").text(totalTickets);
    $("div#lbltotalabierto").text(totalTicketsAbiertos);
    $("div#lbltotalcerrado").text(totalTicketsCerrados);

};