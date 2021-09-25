<?php
include_once "../model/ProductosModel.php";
$productos = new Productos;
$accion = $_POST["accion"];
switch ($accion) {
    case 'listarProductos':
        $productos->list();
        break;
    case 'traerProductos':
            $productos->id = $_POST["id"];
            $productos->get();
        break;
    case 'guardarProductos':
        $productos->nombre = $_POST["nombre"];
        $productos->referencia = $_POST["referencia"];
        $productos->precio = $_POST["precio"];
        $productos->peso = $_POST["peso"];
        $productos->categoria = $_POST["categoria"];
        $productos->stock = $_POST["stock"];
        $productos->create();
        break;
    case 'editarProductos':
        $productos->id = $_POST["id"];
        $productos->nombre = $_POST["nombre"];
        $productos->referencia = $_POST["referencia"];
        $productos->precio = $_POST["precio"];
        $productos->peso = $_POST["peso"];
        $productos->categoria = $_POST["categoria"];
        $productos->stock = $_POST["stock"];
        $productos->update();
        break;
    case 'eliminarProductos':
            $productos->id = $_POST["id"];
            $productos->delete();
        break;
    case 'venderProductos':
            $productos->id = $_POST["id"];
            $productos->vender();
        break;
    
}
