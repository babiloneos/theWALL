<?php

require_once 'Conexion.php';

class Mensaje extends Conexion{
    public function eliminarPubli($id){
        $query= "DELETE FROM mensaje WHERE id = '".$id."';";
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
    public function getPubSeguidos($seguidos){
        if(!empty($seguidos)){
        //SELECT mensaje.id, mensaje.texto, mensaje.imagen_contenido, mensaje.imagen_tipo, mensaje.fechayhora, usuarios.apellido, usuarios.nombre, usuarios.nombreusuario, usuarios.foto_contenido FROM mensaje INNER JOIN usuarios ON mensaje.usuarios_id = usuarios.id WHERE mensaje.usuarios_id = '1' OR mensaje.usuarios_id = '3' ORDER BY mensaje.fechayhora DESC LIMIT 50
        $query = "SELECT mensaje.id, mensaje.texto, mensaje.imagen_contenido, mensaje.imagen_tipo, mensaje.fechayhora, usuarios.id as userid, usuarios.apellido, usuarios.nombre, usuarios.nombreusuario, usuarios.foto_contenido, usuarios.foto_tipo FROM mensaje INNER JOIN usuarios ON mensaje.usuarios_id = usuarios.id WHERE ";
        foreach($seguidos as $seguido){
            $query = $query."mensaje.usuarios_id = '".$seguido."' OR ";
        }
        $query = substr($query, 0, -3);
        $query = $query."ORDER BY mensaje.fechayhora DESC LIMIT 50";
        try{
            $res = $this->conection->query($query);
            
            if ($res->num_rows > 0){
                    return $res;
            } else {
                return NULL;
            }
        
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        } else {
            return NULL;
        }
    }

    public function publicar($usuario, $mensaje, $imagen=NULL, $tipo_imagen=NULL){
        //INSERT INTO mensaje VALUES('', $mensaje, $imagen, NULL, '3', now())
        if($imagen != NULL){
            $query = 'INSERT INTO mensaje VALUES("", "'.$mensaje.'", "'.addslashes(file_get_contents($imagen)).'", "'.$tipo_imagen.'", "'.$usuario.'", now())';
        } else {
            $query = 'INSERT INTO mensaje VALUES("", "'.$mensaje.'", "" , "" , "'.$usuario.'", now())';
        }
        
        try{
            $res = $this->conection->query($query);
            if ($res){
                    return $res;
            } else {
                return NULL;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function getMisPubli($usuario){
    
        $query = "SELECT * FROM mensaje WHERE usuarios_id = $usuario ORDER BY id DESC;";
    
        $res =  $this->conection->query($query);
        try{
            $res = $this->conection->query($query);
            if ($res){
                return $res;
            } else {
                return NULL;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }
        }
}
?>