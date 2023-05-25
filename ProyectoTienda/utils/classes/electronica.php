<?php
     require_once '../../database/Connection.php';

     try{
         session_start();
     
         $connection = Connection::make();

         $productosElectronica = [];

         if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['mayorMenor'])){
                $sql = "SELECT * from productos where lower(categoria) = 'electrónica' ORDER BY precio DESC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productosElectronica = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['menorMayor'])){
                $sql = "SELECT * from productos where lower(categoria) = 'electrónica' ORDER BY precio ASC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productosElectronica = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['mejorValorados'])){
                $sql = "SELECT * from productos where lower(categoria) = 'electrónica' ORDER BY puntuacion DESC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productosElectronica = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['menorValorados'])){
                $sql = "SELECT * from productos where lower(categoria) = 'electrónica' ORDER BY puntuacion ASC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productosElectronica = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }else{
            $sql = "SELECT * from productos where lower(categoria) = 'electrónica' ";
            $pdoStatement = $connection->prepare($sql);
            
            if($pdoStatement->execute() == false){
                
                $mensaje = "No se ha podido acceder a la BBDD";
            }else{
                $productosElectronica = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
            }
        }
     
     }catch(FileException $fileException){
         $mensaje = $fileException->getMessage();
     }
     include("../../views/electronica.view.php");
?>