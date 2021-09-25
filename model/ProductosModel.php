<?php
include_once "conexion.php";
class Productos extends Conexion
{
    public $id;
    public $nombre;
    public $referencia;
    public $precio;
    public $peso;
    public $categoria;
    public $stock;

    public function create(){
        $this->conect();
        $pre = $this->conect->prepare("INSERT INTO productos (nombre, referencia, precio, peso, categoria, stock) VALUES (:nombre, :referencia, :precio, :peso, :categoria, :stock) ;");
        $pre->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $pre->bindParam(":referencia", $this->referencia, PDO::PARAM_STR);
        $pre->bindParam(":precio", $this->precio, PDO::PARAM_INT);
        $pre->bindParam(":peso", $this->peso, PDO::PARAM_INT);
        $pre->bindParam(":categoria", $this->categoria, PDO::PARAM_STR);
        $pre->bindParam(":stock", $this->stock, PDO::PARAM_INT);
        try {
            $this->conect->beginTransaction();
            $pre->execute();
            $this->conect->commit();
            echo 1;
        } catch(PDOExecption $e) {
            $this->conect->rollback();
            echo 0;
        }
    }

    public function list(){
        $this->conect();
        $pre = $this->conect->prepare("SELECT * FROM productos order by id DESC;");
        $pre->execute();
        $rows = $pre->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    }

    public function get(){
        $this->conect();
        $pre = $this->conect->prepare("SELECT * FROM productos WHERE id = :id");
        $pre->bindParam(":id", $this->id, PDO::PARAM_INT);
        $pre->execute();
        $rows = $pre->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    }

    public function update(){
        $this->conect();
        $pre = $this->conect->prepare("UPDATE productos SET nombre = :nombre, referencia = :referencia, precio = :precio, peso = :peso, categoria = :categoria, stock = :stock WHERE id = :id ;");
        $pre->bindParam(":id", $this->id, PDO::PARAM_INT);
        $pre->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $pre->bindParam(":referencia", $this->referencia, PDO::PARAM_STR);
        $pre->bindParam(":precio", $this->precio, PDO::PARAM_INT);
        $pre->bindParam(":peso", $this->peso, PDO::PARAM_INT);
        $pre->bindParam(":categoria", $this->categoria, PDO::PARAM_STR);
        $pre->bindParam(":stock", $this->stock, PDO::PARAM_INT);
        try {
            $this->conect->beginTransaction();
            $pre->execute();
            $this->conect->commit();
            echo 1;
        } catch(PDOExecption $e) {
            $this->conect->rollback();
            echo 0;
        }
    }

    public function delete(){
        $this->conect();
        $pre = $this->conect->prepare("DELETE FROM productos WHERE id = :id");
        $pre->bindParam(":id", $this->id, PDO::PARAM_INT);
        try {
            $this->conect->beginTransaction();
            $pre->execute();
            $this->conect->commit();
            echo 1;
        } catch(PDOExecption $e) {
            $this->conect->rollback();
            echo 0;
        }
    }

    public function vender(){
        $this->conect();
        $pre = $this->conect->prepare("SELECT stock FROM productos WHERE id = :id AND stock > 0");
        $pre->bindParam(":id", $this->id, PDO::PARAM_INT);
        $pre->execute();
        $rows = $pre->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            $stockActual = $rows[0]["stock"]-1;
            $date = new DateTime('NOW');
            $date = $date->format('Y-m-d H:i:s');
            $pre = $this->conect->prepare("UPDATE productos SET stock = :stock, fecha_venta = :fecha_venta WHERE id = :id ;");
            $pre->bindParam(":id", $this->id, PDO::PARAM_INT);
            $pre->bindParam(":stock", $stockActual, PDO::PARAM_INT);
            $pre->bindParam(":fecha_venta", $date, PDO::PARAM_STR);
            try {
                $this->conect->beginTransaction();
                $pre->execute();
                $this->conect->commit();
                echo 1;
            } catch(PDOExecption $e) {
                $this->conect->rollback();
                echo 0;
            }
        }else{
            echo 2;
        }
        

    }
}
