<?php
    require_once '../../database/Connection.php';

    try{
        $connection = Connection::make();
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $idProducto = $_POST['idProducto'];
            if(isset($_POST['eliminarProducto'])){
                $idProductoAEliminar = $_POST['idProductoDelete'];
                $sql = "DELETE from productos where id = '$idProductoAEliminar'";
            
                $pdoStatement = $connection->prepare($sql);
            
                if($pdoStatement->execute() == false){ 
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $eliminarProducto = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                    header('Location: ../../utils/classes/panelAdministrador.php');
                }
            }else if(isset($_POST['deleteProducto'])){
                $sql2 = "SELECT * from productos where id = '$idProducto'";
                $aux = [];
            
                $pdoStatement = $connection->prepare($sql2);
            
                if($pdoStatement->execute() == false){ 
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productoQueSeEliminara = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                    $aux = $productoQueSeEliminara[0];
                }
            }else{
                echo "Ha ocurrido un problema con la bbdd, no se ha podido eliminar el producto";
            }
        }else{
            echo "Ha ocurrido un problema con la bbdd, no se ha podido cargar el producto";
        }
    }catch(Exception $ex){
        print $ex->getMessage();
    }
    include("../../views/deleteProducto.view.php");
?>