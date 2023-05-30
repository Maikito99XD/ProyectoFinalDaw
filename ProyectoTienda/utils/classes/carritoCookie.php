<?php
require_once '../../database/Connection.php';

try{
    $connection = Connection::make();
    session_start();
    if(!isset($_COOKIE["carrito"]) || empty($_COOKIE["carrito"])){
        $productosCarrito = [];
        setcookie("carrito", json_encode($productosCarrito), time()+86400, "/");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['deleteProducto'])){
            $carrito = json_decode(stripslashes($_COOKIE["carrito"] ?? "[]"), true);
            
            if (is_array($carrito) && !empty($carrito)) {
                $idProducto = $_POST['idProducto']; // ID del producto a eliminar
                $indice = -1; // Índice del producto en el array
                
                // Buscar el índice del producto en el array
                foreach ($carrito as $index => $producto) {
                    if ($producto['id'] === $idProducto) {
                        $indice = $index;
                        break;
                    }
                }
                
                if ($indice !== -1) {
                    unset($carrito[$indice]);
                    $carritoValues = array_values($carrito); // Reindexar el array después de eliminar el producto
                    setcookie("carrito", json_encode($carritoValues), time() + 86400, "/");
                }
            }
        }else if(isset($_POST['anyadeProducto'])){
            $aux = $_POST['idProducto'];
            $sql = "SELECT nombre, precio, categoria, descripcion, id, puntuacion from productos where id = '$aux' LIMIT 1";
            $pdoStatement = $connection->prepare($sql);
            
            if($pdoStatement->execute() == false){
                
                $mensaje = "No se ha podido acceder a la BBDD";
            }else{
                $producto = $pdoStatement->fetch(PDO::FETCH_ASSOC);
                $data = json_decode(stripslashes($_COOKIE["carrito"] ?? "[]"), true);
                if(is_null($data)){
                    $data = [];
                }
                
                array_push($data, $producto);
                setcookie("carrito", json_encode($data), time()+86400, "/");
            }
        }
    }

}catch(FileException $fileException){
    $mensaje = $fileException->getMessage();
}

header("Location: carrito.php");
?>