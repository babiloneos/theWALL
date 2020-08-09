<?php

require_once 'Conexion.php';

class Siguiendo extends Conexion{
        public function seguirA($usuario,$seguido){
         $query = "INSERT INTO siguiendo VALUES ('', \"".$usuario."\", \"".$seguido."\");";
         try{
             $res = $this->conection->query($query);
             if ($res){
                 return True;
             } else {
                 return NULL;
             }
         }catch (Exception $e){
             echo 'Excepción capturada: ',  $e->getMessage(), "\n";
         }
     }
     public function dejarDeSeguir($usuario, $seguido){
        //DELETE FROM `me_gusta` WHERE `me_gusta`.`mensaje_id` = "$publicacion" AND me_gusta.usuarios_id = "$usuarios";
        $query = "DELETE FROM siguiendo WHERE siguiendo.usuarios_id = \"".$usuario."\" AND siguiendo.usuarioseguido_id = \"".$seguido."\"";
        try{
            $res = $this->conection->query($query);
            if ($res){
                return True;
            } else {
                return NULL;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function SeguidosPor($usuario){
        //Devuelve un array con las personas a las que sigue el $usuario
        try{
            $query = "SELECT siguiendo.usuarioseguido_id AS id FROM siguiendo WHERE siguiendo.usuarios_id = '".$usuario."' ";
            $res = $this->conection->query($query);
            $listSeguidos = array();
            if ($res->num_rows > 0){
                while($temp = $res->fetch_assoc()){
                    $listSeguidos[] = $temp['id'];
                }
                return $listSeguidos;
            } else {
                return [''];
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function getDatosSeguidos($seguidos){
        if(!empty($seguidos)){
        $query = "SELECT * FROM usuarios WHERE ";
        foreach($seguidos as $seguido){
            $query = $query."id = '".$seguido."' OR ";
        }
        $query = substr($query, 0, -3);
        $query = $query."ORDER BY usuarios.id DESC LIMIT 50";
        try{
            $res = $this->conection->query($query);
            if(!empty($res)){
            if ($res->num_rows > 0){
                    return $res;
            } else {
                return NULL;
            }  }  
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    }
}

?>