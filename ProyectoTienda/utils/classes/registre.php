<?php
    session_start();
    require_once("../../database/Connection.php");
    $usuario = "";
    $password = "";
    $permisos = "usuario";
    
try{
    $connection = Connection::make();
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['register'])){
            if(strlen($_POST['usuario']) > 2){
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];
                $sql = "INSERT INTO usuarios(usuario,contrasenya,permisos) VALUES(:usuario,:contrasenya,:permiso)";
                $pdoStatement = $connection->prepare($sql);
                $parameters = [':usuario' => $usuario,
                    ':contrasenya' => $password,
                    ':permiso' => $permisos];
                if($pdoStatement->execute($parameters) == false){
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $productos = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                    header("Location:../../utils/classes/login.php");
                }
            }else{
               echo '<script language="javascript">alert("Debes introducir un nombre de usuario con al menos 3 carácteres!");</script>';
            }
        }
    }
}catch(FileException $fileException){
    $mensaje = $fileException->getMessage();
}
    include("../../views/registre.view.php");
?>