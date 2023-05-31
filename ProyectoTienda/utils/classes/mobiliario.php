<?php
     require_once '../../database/Connection.php';

    function returnCartCount() {
        if(isset($_COOKIE["carrito"])){
            echo count(json_decode(stripslashes($_COOKIE["carrito"] ?? "[]"), true));
        }else{
            echo 0;
        }
    }
     try{
         session_start();
     
         $connection = Connection::make();

         $productosMobiliarios = [];
     
         if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['mayorMenor'])){
                $sql = "SELECT * from productos where lower(categoria) = 'mobiliario' ORDER BY precio DESC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productosMobiliarios = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['menorMayor'])){
                $sql = "SELECT * from productos where lower(categoria) = 'mobiliario' ORDER BY precio ASC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productosMobiliarios = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['mejorValorados'])){
                $sql = "SELECT * from productos where lower(categoria) = 'mobiliario' ORDER BY puntuacion DESC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productosMobiliarios = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['menorValorados'])){
                $sql = "SELECT * from productos where lower(categoria) = 'mobiliario' ORDER BY puntuacion ASC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productosMobiliarios = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }else{
            $sql = "SELECT * from productos where lower(categoria) = 'mobiliario' ";
            $pdoStatement = $connection->prepare($sql);
            
            if($pdoStatement->execute() == false){
                
                $mensaje = "No se ha podido acceder a la BBDD";
            }else{
                $productosMobiliarios = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
            }
        }
     
     }catch(FileException $fileException){
         $mensaje = $fileException->getMessage();
     }
     include("../../views/mobiliario.view.php");
?>