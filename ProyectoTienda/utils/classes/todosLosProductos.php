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
        $productos = [];
        $connection = Connection::make();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['mayorMenor'])){
                $sql = "SELECT * from productos ORDER BY precio DESC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productos = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['menorMayor'])){
                $sql = "SELECT * from productos ORDER BY precio ASC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productos = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['mejorValorados'])){
                $sql = "SELECT * from productos ORDER BY puntuacion DESC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productos = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }else if(isset($_POST['menorValorados'])){
                $sql = "SELECT * from productos ORDER BY puntuacion ASC";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productos = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }else{
            $sql = "SELECT * from productos";
            $pdoStatement = $connection->prepare($sql);
            
            if($pdoStatement->execute() == false){
                
                $mensaje = "No se ha podido acceder a la BBDD";
            }else{
                $productos = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    
    }catch(FileException $fileException){
        $mensaje = $fileException->getMessage();
    }
    include("../../views/todosLosProductos.view.php");
?>