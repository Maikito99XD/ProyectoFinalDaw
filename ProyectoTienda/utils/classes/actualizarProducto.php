<?php
    require_once '../../database/Connection.php';

    try{
        $connection = Connection::make();
        session_start();
        $idProducto = $_SESSION["productoActualizar"];
        echo "$idProducto";
        $sql2 = "SELECT * from productos where id = '$idProducto'";
        
        $pdoStatement = $connection->prepare($sql2);
    
        if($pdoStatement->execute() == false){ 
            $mensaje = "No se ha podido acceder a la BBDD";
        }else{
            $actualizarProducto = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['camposProducto'] = $actualizarProducto[0];
        }
    }catch(Exception $ex){
        print $ex->getMessage();
    }
    include("../../views/actualizarProducto.view.php");
?>