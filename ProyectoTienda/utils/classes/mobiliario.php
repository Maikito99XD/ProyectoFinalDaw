<?php
     require_once '../../database/Connection.php';

     try{
         session_start();
     
         $connection = Connection::make();
     
         $sql = "SELECT * from productos where lower(categoria) = 'mobiliario' ";
         $pdoStatement = $connection->prepare($sql);
         
         if($pdoStatement->execute() == false){
             
             $mensaje = "No se ha podido acceder a la BBDD";
         }else{
             $productosMobiliarios = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
         }
     
     }catch(FileException $fileException){
         $mensaje = $fileException->getMessage();
     }
     include("../../views/mobiliario.view.php");
?>