<?php
    session_start();
    $veces = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['logOut'])){
            echo '<script language="javascript">alert("Se ha cerrado la sesion");</script>';
            session_destroy();
            header("Location: ../../index.php");
        }else if(isset($_POST['NoLogOut'])){
            echo '<script language="javascript">alert("No se ha cerrado la sesion");</script>';
            header("Location: ../../index.php");
        }
    }

    include("../../views/logOut.view.php");
?>