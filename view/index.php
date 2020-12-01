<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EcoMexico</title>
        <link rel="shortcut icon" type="image/x-icon" href="../src/img/multimedia/logo.png">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../src/css/bootstrap.css"> 
        <link rel="stylesheet" href="../src/css/style.css">  
        <link rel="stylesheet" href="../src/css/animate.css">
        <link rel="stylesheet" href="../src/css/MediaQueries.css">
        <link rel="stylesheet" href="../src/css/font-awesome.min.css">
        <link rel="stylesheet" rel="stylesheet" href="../src/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">      
        <script src="../src/js/jquery-2.1.0.min.js"></script>
        <script src="../src/js/bootstrap.js"></script>
        <script src="../src/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="../src/js/validaciones.js"></script>
        <link rel="stylesheet" href="../src/css/sweetalert2.min.css">     
    </head>
    <body>  
        <div id="index"> 
            <!-- MENU WEB  -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="../src/img/multimedia/logo.png" width="20px" height="20px"></i>&nbsp;&nbsp;EcoMexico</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php if(isset($_SESSION['Rool']) && isset($_SESSION['Nombre'])): ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <?php if($_SESSION['Rool']=="Cliente"): ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-user"></span> &nbsp; <?php echo $_SESSION['Nombre']; ?><b class="caret"></b>
                                </a>
                                <?php endif; ?>
                                <ul class="dropdown-menu">                                    
                                    <li>
                                        <a href=""><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Mensajes</a>
                                    </li>
                                    <li>
                                        <a href="cliente.php"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                                    </li> 
                                    <li class="divider"></li>
                                    <li ><a href="cerrarsesion.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php endif; ?>
                        <ul class=" nav navbar-nav navbar-right">
                            <li>
                                <a href="index.php"><span class="glyphicon glyphicon-home"></span> &nbsp; Inicio</a>
                            </li>
                            <li>
                                <a href="productos.php"><span class="glyphicon glyphicon-shopping-cart"></span> &nbsp; Productos</a>
                            </li>
                            <li>
                                <a href="atencionacliente.php"><span class="fa fa-commenting"></span>&nbsp;&nbsp;Atencion a cliente</a>
                            </li>
                            <li>
                                <a href="conocenos.php"><span class="fa fa-hand-paper-o"></span>&nbsp;&nbsp;Conocenos</a>
                            </li>
                            <?php if(!isset($_SESSION['Rool']) && !isset($_SESSION['Nombre'])): ?>
                            <li>
                                <a href="registrar.php"><i class="fa fa-users"></i>&nbsp;&nbsp;Registro</a>
                            </li>
                            <li>
                                <a href="#!" data-toggle="modal" data-target="#modalLog"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Login</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <form class="navbar-form navbar-right hidden-xs" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Buscar">
                            </div>
                            <button type="button" class="btn btn-success">Buscar</button>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- MODAL DE LOGIN -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalLog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title text-center text-primary" id="myModalLabel">Acceso restringido</h4>
                        </div>
                        <form style="margin: 20px;">
                            <div class="text-center">
                                <a href="#">
                                    <img src="../src/img/multimedia/login.png" width="100px" height="100px" alt="CoolAdmin">
                                </a>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-users"></span>
                                    </div>
                                    <select id="cmbRool" class="form-control">
                                        <option v-bind:value="0">Tipo de usuario</option>
                                        <option v-for="(TPUsuario,indice) of ctTPUsuario" v-bind:value="TPUsuario.vchRool">
                                            {{TPUsuario.vchRool}}
                                        </option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-envelope"></span>
                                    </div>
                                    <input id="txtEmail" type="text" class="form-control" name="nombre_login" placeholder="Ejemplo@hotmail.com" required="" maxlength="50" onpaste="return false"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-lock"></span>
                                    </div>
                                    <input id="txtPassword" type="password" class="form-control" name="contrasena_login" placeholder="Escribe tu contraseña" required="" maxlength="12" onkeypress="return CEspeciales(event)" onpaste="return false"/>
                                </div>                                
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" @click="iniciarsesion">Iniciar sesión</button>
                                </diV>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- FIN DEL MENU WEB -->
            <!-- DATO FECHA EN TIEMPO REAL -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header">
                            <h1 class="animated lightSpeedIn">EcoMexico <small>por un planeta ecologico</small></h1>
                            <span class="label label-danger">EcoMexico S.A de C.V</span>
                            <p class="pull-right text-primary">
                                <strong>
                                    <?php include "timezone.php"; ?>
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DEL DATO FECHA -->
            <div id="img-linux-tux" class="container hidden-lg hidden-md hidden-sm">
                <center><img src="../src/img/multimedia/slide-header.png" class="img-responsive img-rounded" alt="Image"></center>
            </div>
            <div class="container hidden-xs">
                <div class="col-xs-12">
                    <div id="carousel-example-generic" class="carousel slide">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="5"></li>
                        </ol>
                        <div class="carousel-inner">
                        <div class="item active">
                            <img src="../src/img/multimedia/slider1.jpg" alt="">
                            <div class="carousel-caption">
                                Productos de bordado
                            </div>
                        </div>
                        <div class="item">
                            <img src="../src/img/multimedia/slider2.jpg" alt="">
                            <div class="carousel-caption">
                                Productos de diseño tradicional
                            </div>
                        </div>
                        <div class="item ">
                            <img src="../src/img/multimedia/slider3.jpg" alt="">
                            <div class="carousel-caption">
                                Productos derivados del barro
                            </div>
                        </div>
                        <div class="item ">
                            <img src="../src/img/multimedia/slider4.jpg" alt="">
                            <div class="carousel-caption">
                                Productos de elaboracion tradcional
                            </div>
                        </div>
                        <div class="item ">
                            <img src="../src/img/multimedia/slider5.jpg" alt="">
                            <div class="carousel-caption">
                                Productos de diseño y bordado
                            </div>
                        </div>
                        <div class="item ">
                            <img src="../src/img/multimedia/slider6.jpg" alt="">
                            <div class="carousel-caption">
                                Productos de prendas tracionales
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="icon-next"></span>
                    </a>
                </div>
            </div>
                <div class="col-sm-2">&nbsp;</div>
            </div>
            <hr class="hidden-xs">
            <br>
            <footer>
                <div class="container">
                    <div class="row">
                    <div class="col-sm-4">
                        <h4 class="text-info">Siguenos</h4>
                        <a href="#" class="text-warning"><i class="fa fa-facebook" aria-hidden="true"></i> &nbsp; Facebook</a><br>
                        <a href="#" class="text-warning"><i class="fa fa-twitter" aria-hidden="true"></i> &nbsp; Twitter</a><br>
                        <a href="#" class="text-warning"><i class="fa fa-youtube-play" aria-hidden="true"></i> &nbsp; YouTube</a><br>
                        <a href="#" class="text-warning"><i class="fa fa-instagram" aria-hidden="true"></i> &nbsp; Instagram</a>
                    </div>
                    <div class="col-sm-4">
                        <h4 class="text-info">Dirección</h4>
                        <p class="text-warning"> 
                        Pais:Mexico<br>
                        Ciudad: Huejutla de Reyes Hidalgo<br>
                        Telefono: 771-329-8113<br>
                        E-mail: <a href="#">EcoMexico@gmail.com</a>
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <h4 class="text-info">Suscribete</h4>
                        <p class="text-warning">Suscribete para recibir ofertas y noticias de nuestros productos</p>
                        <form action="" method="POST">
                            <div class="input-group">
                                <input type="email" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit">Suscribir</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    </div>
                    <h4 class="text-center" style="color: #FFF;">EcoMexico CopyRight © 2020</h4>
                </div>
            </footer>
        </div>
        <!--VUE-->
        <script src="../src/js/vue.js"></script>
        <!--AXIOS-->
        <script src="../src/js/axios.js"></script>
        <!--SWEETALER2-->
        <script src="../src/js/sweetalert2.all.min.js"></script>
        <!-- CONTOLADOR DE INDEX -->
        <script src="../controller/conindex.js"></script>
    </body>
</html>
