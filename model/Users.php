<?php

require_once 'Conexion.php';

class Users extends Conexion{
    
    public function registUser($usr, $name, $lastname, $mail, $pass, $pic, $picFormat){
        // INSERT INTO usuarios VALUES ($lastname, $name, $mail, $usr, $pass, $pic, $picFormat)
        try{
            $res = NULL;
            $query = "INSERT INTO usuarios VALUES ('', '$lastname', '$name', '$mail', '$usr', '$pass', \"".addslashes(file_get_contents($pic))."\", \"".$picFormat."\")";
            $res = $this->conection->query($query);
        }catch (Exception $e){
            echo '<script>console.log("'.$e->getMessage().'");</script>';
        }finally{
            return $res;
        }
    }

    public function loginUser($usr, $pass){
        echo "<script>console.log('=======".$usr."=======".$pass."')</script>";
        try{
            $query = "SELECT id from usuarios WHERE nombreusuario='$usr' AND contrasenia='$pass'";
            $res = $this->conection->query($query);
            if ($res->num_rows > 0){
                while($row = $res->fetch_assoc()) {
                    return $row["id"];
                }
            } else {
                return NULL;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function updateSome($id, $campo, $actualizacion){
        try{
            $res = NULL;
            $query = "UPDATE usuarios SET $campo=$actualizacion where id=$id";
            $res = $this->conection->query($query);
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }finally{
            return $res;
        }
    }

    public function idByCamp($campo, $elemento){
        try{
            $query = "SELECT id from usuarios WHERE ".$campo."='".$elemento."'";
            $res = $this->conection->query($query);
            if ($res->num_rows > 0){
                $temp = array();
                while($row = $res->fetch_assoc()) {
                    $temp[] = $row["id"];
                }
                return $temp;
            } else {
                return NULL;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    public function contenidoById ($id){
        try{
            $query = "SELECT * from usuarios WHERE id ='".$id."'";
            // echo '<script>console.log("``````'.$query.'");</script>';
            $res = $this->conection->query($query);
            if ($res->num_rows > 0){
                while($row = $res->fetch_assoc()) {
                    return $row;
                }
            } else {
                return NULL;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    public function cuentaById($id){
        try{
            $query = "SELECT email, contrasenia from usuarios WHERE id ='".$id."'";
            // echo '<script>console.log("``````'.$query.'");</script>';
            $res = $this->conection->query($query);
            if ($res->num_rows > 0){
                while($row = $res->fetch_assoc()) {
                    return $row;
                }
            } else {
                return NULL;
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    public function updatePerfil($user, $nombre, $apellido, $profPic, $profPicType, $id){
                                //$user, $nombre, $apellido, $imagen['tmp_name'], $imageType
        try{
            //UPDATE usuarios SET apellido='$apellido', nombre='$nombre', nombreusuario='$user', foto_contenido='addslashes(file_get_contents($pic))', foto_tipo='$profPicType' WHERE id='$id
            if($profPic){
                $query = "UPDATE usuarios SET apellido='$apellido', nombre='$nombre', nombreusuario='$user', foto_contenido=\"".addslashes(file_get_contents($profPic))."\", foto_tipo='$profPicType' WHERE id='$id'";
            } else {
                $query = "UPDATE usuarios SET apellido='$apellido', nombre='$nombre', nombreusuario='$user' WHERE id='$id'";
            }
            $res = NULL;
            $res = $this->conection->query($query);
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        } finally {
            return $res;
        }
    }
    public function updateCuenta($email, $pass, $id){
        try{
            //UPDATE usuarios SET email='$email', contrasenia='$pass' WHERE id='$id'
            $query = "UPDATE usuarios SET email='$email', contrasenia='$pass' WHERE id='$id'";
            $res = NULL;
            $res = $this->conection->query($query);
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        } finally {
            return $res;
        }
    }

    public function usersBySearch($bus){
        try{
            $res = NULL;
            if($bus){
                $query = "SELECT * FROM usuarios WHERE concat_ws(nombre, apellido, nombreusuario) LIKE '%$bus%' ";
                $res = $this->conection->query($query);
            }
        }catch (Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        } finally {
            return $res;
        }
    }

}