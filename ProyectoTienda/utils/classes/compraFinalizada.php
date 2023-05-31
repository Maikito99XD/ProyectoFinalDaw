<?php
    session_start();

    function returnCartCount() {
        if(isset($_COOKIE["carrito"])){
            echo count(json_decode(stripslashes($_COOKIE["carrito"] ?? "[]"), true));
        }else{
            echo 0;
        }
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    if (isset($_COOKIE['carrito'])) {
        unset($_COOKIE['carrito']); 
    } 
    setcookie('carrito', null, time()-100000, "/"); 
    //setcookie("carrito", "[]", time() - 86400);

    include('../../views/compraFinalizada.view.php');
?>