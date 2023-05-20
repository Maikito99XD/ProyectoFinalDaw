<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["actualizarProducto"])){
            $_SESSION['productoActualizar'] = $_POST["idProducto"];
            header('Location:actualizarProducto.php');
            exit;
        }else if(isset($_POST["deleteProducto"])){
            header("Location:deleteProducto.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Mike" />
    <title>TodoJavea</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/todoJaveaIcono.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
</head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">TodoJavea</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../../index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../../utils/classes/about.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../../utils/classes/todosLosProductos.php">Todos los productos</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="../../utils/classes/electronica.php">Electrónica</a></li>
                                <li><a class="dropdown-item" href="../../utils/classes/mobiliario.php">Mobiliario</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == "admin"): echo 'style= "visibility: visible"'; else : echo 'style= "visibility: hidden"'?><?php endif?> class="nav-link active" aria-current="page"href="../../utils/classes/subirProducto.php">Subir Producto</a></li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item">
                            
                            <?php if ($_SESSION['usuario'] == ""):?>
                                <?='<a class="nav-link active" aria-current="page" href="../../utils/classes/login.php">Login</a></li>'?>
                            <?php else :?>
                                <?='<a class="nav-link active" aria-current="page" href="../../utils/classes/logOut.php">Logout</a></li>'?>
                            <?php endif?>
                        <li class="nav-item">
                            <a <?php if ($_SESSION['usuario'] == ""): echo 'style= "visibility: hidden"'; else : echo 'style= "visibility: visible"'?><?php endif?> class="nav-link active" aria-current="page" href="#!"><?= $_SESSION['usuario']?></a></li>

                        </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <form id="formAdmin" action="../../utils/classes/panelAdministrador.php" method="post">
                        <table style="border: 1px solid">
                            <tr id="panelAdminTrBorder">
                                <td>ID</td>
                                <td>Imagen</td>
                                <td>Nombre</td>
                                <td>Precio</td>
                                <td>Puntuacion</td>
                                <td>Categoría</td>
                            </tr>
                            <?php 
                            foreach($productos as $producto) : ?>
                                <tr>
                                    <td><input type="text" id="idProducto" name="idProducto" value="<?=$producto['id']?>" class="center-input" readonly></td>
                                    <td><img style="width: 100% !important" src="data:image/jpg;base64,<?= base64_encode($producto['img']);?>" /></td> 
                                    <td><?=$producto['nombre']?></td>
                                    <td><?=$producto['puntuacion']?></td>
                                    <td><?=$producto['precio']?>€</td>
                                    <td><?=$producto['categoria']?></td>
                                    <td><input type="submit" id="actualizarProducto" name="actualizarProducto" value="Actualizar"/></td>
                                    <td><input type="submit" id="deleteProducto" name="deleteProducto" value="Eliminar"/></td>
                                </tr>
                            <?php endforeach; ?>
                            <!-- <script>
                                    function setFormAction(button){
                                        document.getElementById('formAdmin').action = button.formAction;
                                    }

                                    var buttons = document.querySelectorAll('input[type="image"]');
                                    for(var i = 0;i< buttons.lenght; i++){
                                        buttons[i].addEventListener('click', function(){
                                            setFormAction(this);
                                        })
                                    }
                                </script>  -->
                        </table>
                    </form>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Proyecto TodoJavea Mike Steel Marín 2022-2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        
    </body>
</html>