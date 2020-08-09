<?php

class Conexion{
    public $conection;

    public function __construct(){
        $this->conection = new mysqli('localhost', 'root', '', 'db');

        // Check connection
        if ($this->conection -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }
    }

    public function __destruct (){
        $this->conection -> close();
    }
}

?>