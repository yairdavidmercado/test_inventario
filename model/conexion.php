<?php
class Conexion {
    private $host = "localhost";
    private $user = "admin";
    private $pass = "admin";
    private $db = "test_inventario";
    public $conect;

    public function conect(){
        $connectionString = "mysql:host=".$this->host.";dbname=".$this->db.";charset=UTF8";
        try {
            $this->conect = new PDO($connectionString, $this->user, $this->pass);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión exitosa";
        } catch (Exception $e) {
            $this->conect = "Error de conexión.";
            echo "Error ".$e->getMessage();
        }
    }
}

//$conect = new Conexion;