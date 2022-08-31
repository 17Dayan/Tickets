<?php
/*****
 * Codigo de retorno
 * 2 -> Campos vacios
 * 1 -> Credenciales incorrectas
 * 100 -> login exitoso
 */
class Usuario extends Conectar
{
    public function login($correo, $contrasena)
    {
        $conectar = parent::conexion();
        //  parent::set_names();
        $correo = $correo;
        $pass =$contrasena;
        if (empty($correo) || empty($pass)) {
            return 2;
        } else {
            $sql = "SELECT * FROM usuario WHERE correo=? and contrasena=?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $correo, PDO::PARAM_STR);
            $stmt->bindValue(2, $pass, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch();

            if (is_array($resultado) and count($resultado) > 0) {
                $_SESSION["id_usuario"] = $resultado["id_usuario"];
                return 100;
                
            } else {
                return 1;
            }
        }
    }
}
