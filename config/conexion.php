<?php

session_start();

class Conectar
{
    protected $dbh;

    public function Conexion()
    {
        $contraseña = "1412";
        $usuario = "postgres";
        $nombreBaseDeDatos = "sistema";
        # Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
        $rutaServidor = "localhost";
        $puerto = "5432";
        try {
            //Local
            $conectar = new PDO("pgsql:host=$rutaServidor;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
            // $conectar =  pg_connect("host=localhost dbname=sistema user=postgres password=POSTGRESQL port=5433");
            $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $conectar;
    }
    public function set_names()
    {
        return $this->Conexion()->query("SET NAMES 'utf8'");
    }
    public static function ruta()
    {
        //Local
        return "http://localhost:80/Tickets/";
    }
}
