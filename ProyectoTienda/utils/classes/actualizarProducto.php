<?php
    require_once '../../database/Connection.php';

    $nombre = "";
    $precio = "";
    $categoria = "";
    $imagen = "";
    $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $vecesReproducirMensaje = 0;
    
    try{
        $connection = Connection::make();
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['updateProducto'])){
                $tmpFile = $_FILES['imagen'];
                if (!isset($tmpFile) || ($tmpFile['name'] == ""))
                {
                    $idProductoActualizar = $_POST['idProductoUpdate'];
                    $nombre = $_POST['nombreProducto'];
                    $precio = $_POST['precioProducto'];
                    $descripcion = $_POST['descripcionProducto'];
                    $categoria = $_POST['categoriaProducto'];

                    $update = $connection->query("UPDATE productos SET nombre = '$nombre', 
                        precio = '$precio', categoria = '$categoria',descripcion = '$descripcion' 
                        WHERE id = '$idProductoActualizar'");

                    if($update){
                        $mensaje = "No se ha podido acceder a la BBDD";
                    }else{
                        echo '<script language="javascript">alert("Se ha actualizado el producto!");</script>';
                    }
                }
                elseif(!isset($_POST['descripcionProducto']) || ($_POST['descripcionProducto'] == ""))
                {
                    $idProductoActualizar = $_POST['idProductoUpdate'];
                    $nombre = $_POST['nombreProducto'];
                    $precio = $_POST['precioProducto'];
                    $categoria = $_POST['categoriaProducto'];
                    $image = $_FILES['imagen']['tmp_name'];
                    $imagen = addslashes(file_get_contents($image));

                    $update = $connection->query("UPDATE productos SET nombre = '$nombre', 
                        precio = '$precio', categoria = '$categoria', img = '$imagen'
                        WHERE id = '$idProductoActualizar'");

                    if($update){
                        $mensaje = "No se ha podido acceder a la BBDD";
                    }else{
                        echo '<script language="javascript">alert("Se ha actualizado el producto!");</script>';
                    }
                }
                elseif(!isset($tmpFile) || ($tmpFile['name'] == "") || !isset($_POST['descripcionProducto']) || ($_POST['descripcionProducto'] == ""))
                {
                    $idProductoActualizar = $_POST['idProductoUpdate'];
                    $nombre = $_POST['nombreProducto'];
                    $precio = $_POST['precioProducto'];
                    $categoria = $_POST['categoriaProducto'];

                    $update = $connection->query("UPDATE productos SET nombre = '$nombre', 
                        precio = '$precio', categoria = '$categoria' 
                        WHERE id = '$idProductoActualizar'");

                    if($update){
                        $mensaje = "No se ha podido acceder a la BBDD";
                    }else{
                        echo '<script language="javascript">alert("Se ha actualizado el producto!");</script>';
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
                    $idProductoActualizar = $_POST['idProductoUpdate'];
                    $nombre = $_POST['nombreProducto'];
                    $precio = $_POST['precioProducto'];
                    $descripcion = $_POST['descripcionProducto'];
                    $categoria = $_POST['categoriaProducto'];
                    $image = $_FILES['imagen']['tmp_name'];
                    $imagen = addslashes(file_get_contents($image));

                    $update = $connection->query("UPDATE productos SET nombre = '$nombre', 
                        precio = '$precio', categoria = '$categoria', img = '$imagen', 
                        descripcion = '$descripcion' WHERE id = '$idProductoActualizar'");

                    if($update){
                        $mensaje = "No se ha podido acceder a la BBDD";
                    }else{
                        echo '<script language="javascript">alert("Se ha actualizado el producto!");</script>';
                    }
                }
                header("Location: ../../utils/classes/panelAdministrador.php");
            }else if(isset($_POST['actualizarProducto'])){
                $idProducto = $_POST["idProducto"];
                $sql2 = "SELECT * from productos where id = '$idProducto'";
                
                $pdoStatement = $connection->prepare($sql2);
            
                if($pdoStatement->execute() == false){ 
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $aux = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                    $actualizarProducto = $aux[0];
                }
            }
        }
    }catch(Exception $ex){
        print $ex->getMessage();
    }
    include("../../views/actualizarProducto.view.php");
?>