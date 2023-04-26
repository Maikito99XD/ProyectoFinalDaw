<?php
    require_once '../../database/Connection.php';

    try{
        session_start();
    
        $connection = Connection::make();
    
        $sql = "SELECT * from productos";
        $pdoStatement = $connection->prepare($sql);
        
        if($pdoStatement->execute() == false){
            
            $mensaje = "No se ha podido acceder a la BBDD";
        }else{
            $productos = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
    
    }catch(FileException $fileException){
        $mensaje = $fileException->getMessage();
    }
    include("../../views/todosLosProductos.view.php");
?>