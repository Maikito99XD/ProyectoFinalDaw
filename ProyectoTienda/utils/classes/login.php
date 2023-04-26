<?php
session_start();
require_once("../../database/Connection.php");
$usuarios = [];

$veces = 0;

try{
    $connection = Connection::make();
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if(isset($_POST['login'])){
                $sql = "SELECT * from usuarios";
                $pdoStatement = $connection->prepare($sql);
                
                if($pdoStatement->execute() == false){
                    
                    $mensaje = "No se ha podido acceder a la BBDD";
                }else{
                    $usuarios = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }

                foreach($usuarios as $usuario){
                    if(strcmp($usuario['usuario'], $_POST['username']) == 0){
                        $veces = 0;
                        if(strcmp($usuario['contrasenya'], $_POST['password']) == 0){
                            $_SESSION['usuario'] = $_POST['username'];
                            header("Location:../../index.php");
                        }else{
                            if($veces == 0){
                                echo '<script language="javascript">alert("La contraseña no es valida");</script>';
                                $veces++;
                            }
                        }
                    }else{
                        if($veces == 0){
                            echo '<script language="javascript">alert("El usuario no es correcto");</script>';
                            $veces++;
                        }
                    }
                }
                
            }
            /*
            $nombre = $_POST['FirstName'];
            $apellidos = $_POST['LastName'];
            $email = $_POST['email'];
            $asunto = $_POST['subject'];
            $texto = trim(htmlspecialchars($_POST['mensaje']));
            $fecha = date('Y').date('m').date('d').date('H').date('i').date('s');

            $sql = "INSERT INTO mensajes(nombre,apellidos,email,asunto,texto,fecha) 
                VALUES (:nombreMensaje, :apellidosMensaje, :emailMensaje, :asuntoMensaje, 
                    :textoMensaje, :fechaMensaje)";
            $pdoStatement = $connection->prepare($sql);
            $parameters = [':nombreMensaje' => $nombre,
                            ':apellidosMensaje' => $apellidos,
                            ':emailMensaje' => $email,
                            ':asuntoMensaje' => $asunto,
                            ':textoMensaje' =>$texto,
                            ':fechaMensaje' => $fecha];
            if($pdoStatement->execute($parameters) == false){
                $mensaje = "No se ha podido acceder a la BBDD";
            }else{
                $mensaje = 'Datos enviados';
            }
            */
        }
}catch(FileException $fileException){
    $mensaje = $fileException->getMessage();
}
include("../../views/login.view.php");
?>