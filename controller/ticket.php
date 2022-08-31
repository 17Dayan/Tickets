<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();

    switch($_GET["op"]){
        case "insert":
           $id_ticket = $ticket->insert_ticket($_SESSION["id_usuario"],$_POST["id_categoria"],$_POST["asunto_ticket"],$_POST["descripcion_ticket"]);
        
           $results = array( "id_ticket" =>$id_ticket);

            echo json_encode($results);

       break; 

       case "listar_x_usuario":
        date_default_timezone_set("America/Bogota");
         $datos=$ticket->listar_ticket_x_usuario($_SESSION["id_usuario"]);
         $data= Array();
         foreach($datos as $row){
            $d=strtotime($row["fecha_creacion"]);

             $sub_array = array(
                "id_ticket" => $row["id_ticket"],
                "id_usuario" =>  $row["id_usuario"],
                "id_categoria" => $row["id_categoria"],
                "asunto_ticket" => $row["asunto_ticket"],
                "descripcion_ticket" => $row["descripcion_ticket"],
                "descripcion_estado" => $row["descripcion_estado"],
                "fecha_creacion" =>date("Y-m-d h:i:sa",$d ) ,
                "fecha_respuesta" => $row["fecha_respuesta"],
                "btn" =>  '<button type="button" onClick="ver('.$row["id_ticket"].');"  id="'.$row["id_ticket"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>',
             );
             array_push( $data,$sub_array);
         }

         
         $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);

        echo json_encode($results);

       break;
    }


?>