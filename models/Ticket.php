<?php
   class Ticket extends Conectar{


        public function insert_ticket($id_usuario,$id_categoria,$asunto_ticket,$descripcion_ticket,$id_estado_ticket = 1){

            $conectar= parent::conexion();
            // parent::set_names();            
            $sql= "INSERT INTO ticket (id_usuario,id_categoria,asunto_ticket,descripcion_ticket,id_estado_ticket, fecha_creacion) VALUES (?,?,?,?,?,(select now()));";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->bindValue(2, $id_categoria);
            $sql->bindValue(3, $asunto_ticket);
            $sql->bindValue(4, $descripcion_ticket);
            $sql->bindValue(5, $id_estado_ticket);
            $sql->execute();
            //return $sql->fetchAll();
           return $conectar->lastInsertId();
        }

        public function listar_ticket_x_usuario($id_usuario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql= "SELECT   ticket.id_ticket, 
                            ticket.id_usuario, 
                            ticket.id_categoria, 
                            ticket.asunto_ticket, 
                            ticket.descripcion_ticket, 
                            ticket.id_estado_ticket, 
                            ticket.fecha_creacion, 
                            ticket.fecha_respuesta, 
                            usuario.nick, 
                            categoria.nombre_categoria ,
                            estado_ticket.descripcion as descripcion_estado
                    FROM ticket 
                    INNER join categoria on ticket.id_categoria = categoria.id_categoria
                    INNER join usuario on ticket.id_usuario = usuario.id_usuario 
                    INNER join estado_ticket on ticket.id_estado_ticket = estado_ticket.id_estado_ticket 
                    AND usuario.id_usuario = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $sql->fetchAll();
           
        }
   }




?>