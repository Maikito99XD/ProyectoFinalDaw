<?php
    $cantidadProductosRelacionados = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TodoJavea</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
                            <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../../utils/classes/todosLosProductos.php">Todos los productos</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="../../utils/classes/electronica.php">Electrónica</a></li>
                                <li><a class="dropdown-item" href="../../utils/classes/mobiliario.php">Mobiliario</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == "admin"): echo 'style= "visibility: visible"'; else : echo 'style= "visibility: hidden"'?><?php endif?> class="nav-link active" aria-current="page"href="../../utils/classes/panelAdministrador.php">Panel administrador</a></li>
                    </ul>
                    <form class="d-flex" action="/daw/ProyectoTienda/utils/classes/carritoCookie.php">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Carrito
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?= returnCartCount(); ?></span>
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
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <?php foreach($productoMostrar as $producto) : ?>
                        <div class="col-md-6"><!-- Product image-->
                            <img src="data:image/jpg;base64,<?= base64_encode($producto['img']);?>" width="500" height="500" /></div>
                        <div class="col-md-6">
                            <h1 class="display-5 fw-bolder"><?=$producto['nombre']?></h1>
                            <div class="fs-5 mb-5">
                                <span><?=$producto['precio']?>€</span>
                            </div>
                            <p class="lead"><?=$producto['descripcion']?></p>
                            <div class="d-flex">
                                <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                                <form action="/daw/ProyectoTienda/utils/classes/carritoCookie.php" method="post">
                                    <input type="hidden" name="idProducto" value="<?=$producto['id']?>">
                                    <input type="submit" name="anyadeProducto" class="btn btn-outline-dark mt-auto" value="Añadir al carro" />
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Productos relacionados</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php foreach($productosPorCategorias as $productoPorCategoria) : ?>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img src="data:image/jpg;base64,<?= base64_encode($productoPorCategoria['img']);?>" height="200"/>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?=$productoPorCategoria['nombre'];?></h5>
                                        <!-- Product price-->
                                        <?=$productoPorCategoria['precio'];?>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <form action="/daw/ProyectoTienda/utils/classes/carritoCookie.php" method="post">
                                            <input type="hidden" name="idProducto" value="<?=$productoPorCategoria['id']?>">
                                            <input type="submit" name="anyadeProducto" class="btn btn-outline-dark mt-auto" value="Añadir al carro" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>