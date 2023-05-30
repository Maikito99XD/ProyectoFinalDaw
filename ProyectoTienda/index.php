<?php
require_once 'database/Connection.php';

$user = '';
$password = '';
$usuarioEncontrado = 0;
$mensaje = '';
$arrayMensaje = [];
$productos = [];


function returnCartCount() {
    echo count(json_decode(stripslashes($_COOKIE["carrito"] ?? "[]"), true));
}

try{
    session_start();

    if(!isset($_SESSION['usuario'])){
        $_SESSION['usuario'] = "";
    }

    if(!isset($_COOKIE['carrito'])){
        setcookie("carrito", "[]", time()+86400, "/");
    }

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
include("views/tienda.view.php");
?>