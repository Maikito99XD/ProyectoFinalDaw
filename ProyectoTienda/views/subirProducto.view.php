<html>
<head>
    <style>
        $primary: #2196F3;

body {
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  background: url("https://i.imgur.com/HgflTDf.jpg") 50% fixed;
  background-size: cover;
}

@keyframes spinner {
  0% { transform: rotateZ(0deg); }
  100% { transform: rotateZ(359deg); }
}

* {
  box-sizing: border-box;
}

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
  background: rgba(darken($primary,40%), 0.85);
}


.login {
  
  border-radius: 2px 2px 5px 5px;
  padding: 10px 20px 20px 20px;
  width: 90%;
  max-width: 320px;
  background: #ffffff;
  position: relative;
  padding-bottom: 80px;
  box-shadow: 0px 1px 5px rgba(0,0,0,0.3);
  
  &.loading {
    button {
      max-height: 100%;
      padding-top: 50px;
      .spinner {
        opacity: 1;
        top: 40%;
      }
    }  
  }
  
  &.ok {
    button {
      background-color: #8bc34a;
      .spinner{
        border-radius: 0;
        border-top-color: transparent;
        border-right-color: transparent;
        height: 20px;
        animation: none;
        transform: rotateZ(-45deg);
      }
    }
  }
  
  input {
    display: block;
    padding: 15px 10px;
    margin-bottom: 10px;
    width: 100%;
    border: 1px solid #ddd;
    transition: border-width 0.2s ease;
    border-radius: 2px;
    color: #ccc;
    
    &+ i.fa {
        color: #fff;
      font-size: 1em;
      position: absolute;
      margin-top: -47px;
      opacity: 0;
      left: 0;
      transition: all 0.1s ease-in;
    }
    
    &:focus {
      &+ i.fa {
        opacity: 1;
        left: 30px;
      transition: all 0.25s ease-out;
      }
      outline: none;
      color: #444;
      border-color: $primary;
      border-left-width: 35px;
    }
    
  }
  
  a {
   font-size: 0.8em;   
    color: $primary;
    text-decoration: none;
  }
  
  .title {
    color: #444;
    font-size: 1.2em;
    font-weight: bold;
    margin: 10px 0 30px 0;
    border-bottom: 1px solid #eee;
    padding-bottom: 20px;
  }
  
  button {
    width: 100%;
    height: 100%;
    padding: 10px 10px;
    background: $primary;
    color: #fff;
    display: block;
    border: none;
    margin-top: 20px;
    position: absolute;
    left: 0;
    bottom: 0;
    max-height: 60px;
    border: 0px solid rgba(0,0,0,0.1);
  border-radius: 0 0 2px 2px;
    transform: rotateZ(0deg);
    
    transition: all 0.1s ease-out;
      border-bottom-width: 7px;
    
    .spinner {
      display: block;
      width: 40px;
      height: 40px;
      position: absolute;
      border: 4px solid #ffffff;
      border-top-color: rgba(255,255,255,0.3);
      border-radius: 100%;
      left: 50%;
      top: 0;
      opacity: 0;
      margin-left: -20px;
      margin-top: -20px;
      animation: spinner 0.6s infinite linear;
      transition: top 0.3s 0.3s ease,
                opacity 0.3s 0.3s ease,
                border-radius 0.3s ease;
      box-shadow: 0px 1px 0px rgba(0,0,0,0.2);
    }
    
  }
  
    &:not(.loading) button:hover {
      box-shadow: 0px 1px 3px $primary;
    }
    &:not(.loading) button:focus {
      border-bottom-width: 4px;
    }
    
  
}

footer {
  display: block;
  padding-top: 50px;
  text-align: center;
  color: #ddd;
  font-weight: normal;
  text-shadow: 0px -1px 0px rgba(0,0,0,0.2);
  font-size: 0.8em;
  a, a:link {
    color: #fff;
    text-decoration: none;
  }
}
    </style>
</head>
<body>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Mike" />
    <title>La tienda de Paco</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">La tienda de paco</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../../index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../../utils/classes/about.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
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
<div class="wrapper">
  <form class="login" action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
    <p class="title">Subir un producto</p>
    <input type="text" name="nombreProducto" placeholder="Nombre" autofocus required/><br><br>
    <i class="fa fa-user"></i>
    <input type="number" step="0.01" name="precioProducto" placeholder="Precio" required /><br><br>
    <i class="fa fa-user"></i>
    <input type="number" name="puntuacionProducto" placeholder="Puntuación" required /><br><br>
    <i class="fa fa-user"></i>
    <input type="text"  name="categoriaProducto" placeholder="Categoría" required /><br><br>
    <i class="fa fa-user"></i>
    <input type="file" name="imagen"><br>
    <i class="fa fa-key"></i><br>
    <button name="subirProducto" type="submit" >
      <i class="spinner"></i>
      <span class="state">Subir producto</span>
    </button>
  </form>
  <footer><a href="../../index.php">La tienda de paco</a></footer>
  </p>
</div>
</body>
</html>