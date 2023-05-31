<?php
    session_start();
    require_once("../../database/Connection.php");
    $nombre = "";
    $precio = "";
    $puntuacion = "";
    $categoria = "";
    $imagen = "";
    $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $vecesReproducirMensaje = 0;

    function returnCartCount() {
        if(isset($_COOKIE["carrito"])){
            echo count(json_decode(stripslashes($_COOKIE["carrito"] ?? "[]"), true));
        }else{
            echo 0;
        }
    }
    try{
        $connection = Connection::make();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['subirProducto'])){
                $tmpFile = $_FILES['imagen'];
                if (!isset($tmpFile) || ($tmpFile['name'] == ""))
                {
                    if($vecesReproducirMensaje == 0){
                        echo '<script language="javascript">alert("Debes seleccionar un fichero");</script>';
                        $vecesReproducirMensaje++;
                    }
                }
                elseif ($tmpFile['error'] !== UPLOAD_ERR_OK)
                {
                    switch ($tmpFile['error']){
                        case UPLOAD_ERR_INI_SIZE:
                        case UPLOAD_ERR_FORM_SIZE:
                            throw new FileException('El fichero es demasiado grande');
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            throw new FileException('No se ha podido subir el fichero completo');
                            break;
                        default:
                            throw new FileException('No se ha podido subir el fichero');
        
                    }
                }
                elseif (in_array($tmpFile['type'], $tiposAceptados) === false)
                {
                    
                    if($vecesReproducirMensaje == 0){
                        echo '<script language="javascript">alert("Debes seleccionar un fichero");</script>';
                        $vecesReproducirMensaje++;
                    }
                }
                else
                {
                    $nombre = $_POST['nombreProducto'];
                    $precio = $_POST['precioProducto'];
                    $puntuacion = 5;
                    $descripcion = $_POST['descripcionProducto'];
                    $categoria = $_POST['categoriaProducto'];
                    $image = $_FILES['imagen']['tmp_name'];
                    $imagen = addslashes(file_get_contents($image));

                    $insert = $connection->query("iNSERT INTO productos(nombre,precio,puntuacion,categoria,img,descripcion) VALUES('$nombre','$precio','$puntuacion','$categoria','$imagen','$descripcion')");

                    if($insert){
                        $mensaje = "No se ha podido acceder a la BBDD";
                    }else{
                        echo '<script language="javascript">alert("Se ha subido el producto!");</script>';
                    }
                }
            }
        }
        
    }catch(FileException $fileException){
        $mensaje = $fileException->getMessage();
    }

    include("../../views/subirProducto.view.php");
?>