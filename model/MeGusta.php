<?php

require_once 'Conexion.php';

class MeGusta extends Conexion{
    public function contarLikes($id_pub){
        //SELECT Count(me_gusta.mensaje_id) AS `as cantLikes` FROM me_gusta WHERE me_gusta.mensaje_id = '1'
        $query = "SELECT Count(me_gusta.mensaje_id) AS 'cantLikes' FROM me_gusta WHERE me_gusta.mensaje_id = \"".$id_pub."\"";
        try{
            $res = $this->conection->query($query);
            if ($res->num_rows > 0){
                while($row = $res->fetch_assoc()) {
                    return $row["cantLikes"];
                }
            } else {
                return NULL;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function dioLike($usuario, $publicacion){
        //SELECT me_gusta.id FROM me_gusta WHERE me_gusta.usuarios_id = '1' AND me_gusta.mensaje_id = '1'
        $query = "SELECT me_gusta.id FROM me_gusta WHERE me_gusta.usuarios_id = \"".$usuario."\" AND me_gusta.mensaje_id = \"".$publicacion."\"";
        try{
            $res = $this->conection->query($query);
            if ($res->num_rows > 0){
                return True;
            } else {
                return False;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function darLike($usuario, $publicacion){
        //INSERT INTO me_gusta VALUES ('', '$usuario', '$publicaciones');
        $query = "INSERT INTO me_gusta VALUES ('', \"".$usuario."\", \"".$publicacion."\");";
        try{
            $res = $this->conection->query($query);
            if ($res){
                return True;
            } else {
                return False;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function quitarLike($usuario, $publicacion){
        //DELETE FROM `me_gusta` WHERE `me_gusta`.`mensaje_id` = "$publicacion" AND me_gusta.usuarios_id = "$usuarios";
        $query = "DELETE FROM me_gusta WHERE me_gusta.mensaje_id = \"".$publicacion."\" AND me_gusta.usuarios_id = \"".$usuario."\"";
        try{
            $res = $this->conection->query($query);
            if ($res){
                return True;
            } else {
                return False;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
}
?>