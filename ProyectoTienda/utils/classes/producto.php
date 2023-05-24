<?php
    session_start();
    $id_producto = $_GET["id"];
    //$id_producto = parse_url($url, "id");
    echo($id_producto);
    include("../../views/producto.view.php");
?>