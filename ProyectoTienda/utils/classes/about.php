<?php
    session_start();

    function returnCartCount() {
        if(isset($_COOKIE["carrito"])){
            echo count(json_decode(stripslashes($_COOKIE["carrito"] ?? "[]"), true));
        }else{
            echo 0;
        }
    }

    include("../../views/about.view.php");
?>