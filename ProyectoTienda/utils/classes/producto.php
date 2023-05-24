<?php
    require_once '../../database/Connection.php';

    try{
        session_start();

        $connection = Connection::make();
        $id_producto = $_GET["id"];
        $aux = [];

        $sql = "SELECT * from productos where id = $id_producto";
        $pdoStatement = $connection->prepare($sql);
        
        if($pdoStatement->execute() == false){
            $mensaje = "No se ha podido acceder a la BBDD";
        }else{
            $productoMostrar = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
            $aux = $productoMostrar;
        }
        $produc = $productoMostrar[0];
        $categoriaProducto = $produc['categoria'];
        $sql2 = "SELECT * from productos where 'id' != $id_producto and 'categoria' = $categoriaProducto";
        $pdoStatement2 = $connection->prepare($sql);

        if($pdoStatement2->execute() == false){
            $mensaje = "No se ha podido acceder a la BBDD";
        }else{
            $productosPorCategorias = $pdoStatement2->fetchAll(PDO::FETCH_ASSOC);
        }

    }catch(FileException $fileException){
        $mensaje = $fileException->getMessage();
    }
    
    include("../../views/producto.view.php");
?>