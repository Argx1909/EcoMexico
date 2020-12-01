<?php
session_start();
header('Content-Type: text/html; charset=UTF-8'); 
require_once('../model/conexion.php');
$clave=$_GET['clave'];
if(isset($_GET['clave'])){
    $objeto=new Conexion();
    $conexion=$objeto->Abrir_conexion();
	$consulta="SELECT tblproductos.`intId_Producto`,tblproductos.`vchProducto`,tblinventario.`intCantAlmacen`,tblproductos.`flPrecioVenta`,tblproductos.`vchImagen`,tblproductos.`vchDescripcion` FROM tblproductos,tblinventario WHERE tblproductos.`intId_Producto`='$clave' AND tblinventario.`intCantAlmacen`>1 AND tblproductos.`intId_Producto`=tblinventario.`intId_Producto`;";
    $resultado=$conexion->prepare($consulta);
    $resultado->execute();
    if($resultado->rowCount()){
        $contenido=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($contenido as $dato){
            $clave=$dato['intId_Producto'];
            $producto=$dato['vchProducto'];
            $stock=$dato['intCantAlmacen'];
            $precio=$dato['flPrecioVenta'];
            $imagen=$dato['vchImagen'];
            $descripcion=$dato['vchDescripcion'];
        }
    }
}else{
    header("location:productos.php");
} 
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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-user"></span> &nbsp; <?php echo $_SESSION['Nombre']; ?><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <!--USUARIOS-->
                                    <?php if($_SESSION['Rool']=="Cliente"): ?>
                                    <li>
                                        <a href=""><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Mensajes</a>
                                    </li>
                                    <li>
                                        <a href="cliente.php"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                                    </li> 
                                    <?php endif; ?>
                                    <!--ADMINISTRADOR-->
                                    <?php if($_SESSION['Rool']=="Administrador"): ?>
                                    <li>
                                        <a href="notificaciones.php"><span class="fa fa-book"></span> &nbsp;Notificaciones de sistema</a>
                                    </li>
                                    <li>
                                        <a href="usuarios.php"><span class="fa fa-address-book"></span> &nbsp;Administrar clientes</a>
                                    </li>
                                    <li>
                                        <a href="administrador.php"><span class="fa fa-address-card"></span> &nbsp;Administrar administradores</a>
                                    </li>
                                    <?php endif; ?> 
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
            <!-- VISTA DE LOS PRODUCTOS -->
            <div class="container">
                <div class="abs-center">
                    <div class="content-wrapper">
                        <section class="content">
                            <div class="card card-solid">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="col-12">
                                                <img src="../src/img/productos/<?php echo $imagen;?>" class="product-image" height="300px" width="500px" alt="Product Image">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 product-summery">
                                        <div class="product-title">
                                            <h3><?php echo $producto;?><?php echo " ";?>$<?php echo $precio;?></h3>
                                            <hr>
                                        </div>
                                        <div class="product-category text-muted">
                                            <h4>Stock:<?php echo $stock;?></h4>
                                        </div>
                                        <div class="product-summery"><?php echo $descripcion;?>.</div>
                                        <hr>
                                        <div class="product-cart">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-3">
                                                    <a href="" class="btn btn-info">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Agregar...</a>
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <a href="pagos.php?clave=<?=$dato['intId_Producto']?>" class="btn btn-success">
                                                    <i class="fa fa-credit-card mr-6"></i>
                                                    Comprar...</a>
                                                </div>
                                                <!-- <div class="col-xs-12 col-sm-4">
                                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                                        <input type="hidden" name="cmd" value="_s-xclick">
                                                        <input type="hidden" name="hosted_button_id" value="8Q6VS74L758M6">
                                                        <input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                                                        <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                                                    </form>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <br>
            <!-- FIN DE LA VISTA DE LOS PRODUCTOS -->
            <!-- INICIO DEL FOOTER -->
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
