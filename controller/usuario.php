<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $usuario = new Usuario();

    switch($_GET["op"]){
        case "guardaryeditar":
            if(empty($_POST["id_usuario"])){       
                $usuario->insert_usuario($_POST["nick"],$_POST["correo"],$_POST["contraseña"]);     
            }
            else {
                $usuario->update_usuario($_POST["id_usuario"],$_POST["nick"],$_POST["correo"],$_POST["contraseña"]);
            }
            break;

        case "listar":
            $datos=$usuario->get_usuario();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["nick"];
                $sub_array[] = $row["correo"];
                $sub_array[] = $row["contraseña"];

                $sub_array[] = '<button type="button" onClick="editar('.$row["id_usuario"].');"  id="'.$row["id_usuario"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_usuario"].');"  id="'.$row["id_usuario"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "eliminar":
            $usuario->delete_usuario($_POST["id_usuario"]);
            break;

        case "mostrar";
            $datos=$usuario->get_usuario_x_id($_POST["id_usuario"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["id_usuario"] = $row["id_usuario"];
                    $output["nick"] = $row["nick"];
                    $output["correo"] = $row["correo"];
                    $output["contraseña"] = $row["contraseña"];
                
                }
                echo json_encode($output);
            }   
            break;

        case "total";
            $datos=$usuario->get_usuario_total_x_id($_POST["id_usuario"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;

        case "totalabierto";
            $datos=$usuario->get_usuario_totalabierto_x_id($_POST["id_usuario"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;

        case "totalcerrado";
            $datos=$usuario->get_usuario_totalcerrado_x_id($_POST["id_usuario"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;

        case "grafico";
            $datos=$usuario->get_usuario_grafico($_POST["id_usuario"]);  
            echo json_encode($datos);
            break;

        case "combo";
            $datos = $usuario->get_usuario_x_rol();
            if(is_array($datos)==true and count($datos)>0){
                $html.= "<option label='Seleccionar'></option>";
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['id_usuario']."'>".$row['nick']."</option>";
                }
                echo $html;
            }
            break;
        /* Controller para actualizar contraseña */
        case "contraseña":
            $usuario->update_usuario_pass($_POST["id_usuario"],$_POST["contraseña"]);
            break;
        case "access":
            $respuesta = $usuario->login( $_POST["correo"], $_POST["contrasena"]);
            echo $respuesta;
            break;
    }
?>