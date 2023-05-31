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

include('../../views/panelAdministrador.view.php')
?>