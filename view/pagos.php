<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
require_once('../model/conexion.php');
$clave=$_GET['clave'];
if(isset($_GET['clave'])){
    $objeto=new Conexion();
    $conexion=$objeto->Abrir_conexion();
	$consulta="SELECT tblproductos.`intId_Producto`,tblproductos.`vchProducto`,tblinventario.`intCantAlmacen`,tblproductos.`flPrecioVenta`,tblproductos.`vchImagen` FROM tblproductos,tblinventario WHERE tblproductos.`intId_Producto`='$clave' AND tblinventario.`intCantAlmacen`>1 AND tblproductos.`intId_Producto`=tblinventario.`intId_Producto`;";
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
        <script src="../src/js/validaciones.js"></script>
        <link rel="stylesheet" href="../src/css/sweetalert2.min.css">   
       
        <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
        <!-- <link rel="stylesheet" href="../css/style.css"> -->
        <!-- <link rel="stylesheet" href="../css/responsive.css">   -->
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
            <!-- <div class="container-fluid">
                <div class="row">
                    <div class="product-tab-list tab-pane fade active in" id="description"> 
                        <div class="row">
                            <div class="col-lg-3"></div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="demo-container">
                                            <div class="card-wrapper"></div>
                                            <br>
                                            <form class="payment-form mg-tb-15">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </div>
                                                        <input name="number" id="txttargeta" type="tel" class="form-control" placeholder="NUMERO DE TARGETA" required="" maxlength="20" onkeypress="return soloNumeros(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </div>
                                                        <input name="name" id="txtpersona" type="text" class="form-control" placeholder="NOMBRE COMPLETO" required="" maxlength="60" onkeypress="return soloLetras(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar-check-o"></i>
                                                        </div>
                                                        <input name="expiry" id="txtexpiracion" type="tel" class="form-control" placeholder="MM/YY" required="" maxlength="16" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-cc"></i>
                                                        </div>
                                                        <input name="cvc" id="txtclave" type="number" class="form-control" placeholder="CVC" required="" maxlength="3" onpaste="return false">
                                                    </div>
                                                </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>
                                                        <input id="txtCEmail" type="email" class="form-control" placeholder="Email" required="" maxlength="100" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="glyphicon glyphicon-lock"></i>
                                                        </div>
                                                        <input id="txtpassword" type="password" class="form-control" placeholder="Password" required="" maxlength="12" onkeypress="return CEspeciales(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                        <i class="fa fa-taxi"></i>
                                                    </div>
                                                    <input id="txtdireccion" type="text" class="form-control" placeholder="Direccion de envio" required="" maxlength="12" onkeypress="return CEspeciales(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                        <i class="fa fa-shopping-basket"></i>
                                                    </div>
                                                    <input id="txtproducto" type="text" class="form-control" placeholder="Producto" required="" maxlength="12" readonly="true" onkeypress="return CEspeciales(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                    <input id="txtcantidad" type="text" class="form-control" placeholder="Cantidad" required="" maxlength="12" value="1" onkeypress="return CEspeciales(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="text-center credit-card-custom">
                                                    <a href="#!" class="btn btn-success waves-effect waves-light">Aceptar</a>
                                                </div>        
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-lg-3"></div> 
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="../src/img/multimedia/administrador.png" alt="Image" class="img-responsive" width="100px" height="100px">
                    </div>
                    <div class="col-sm-9">
                        <p class="lead text-info">Bienvenido para finalizar su compra ingrese los datos requeridos en caso de no pertenecer a nuestra comunidad lo invitamos a registrarse en nuestra plataforma.</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="tab-content">
                        <br>
                        <div class="tab-pane active">
                            <div class="col-sm-6">
                                <div class="panel panel-info">
                                <div class="panel-heading text-center">&nbsp;<strong>Llenar todos los datos requeridos</strong></div>
                                    <div class="panel-body">
                                        <form class="payment-form mg-tb-15">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-credit-card"></i>
                                                    </div>
                                                    <input name="number" id="txttargeta" type="tel" class="form-control" placeholder="Numero de targeta" required="" maxlength="20" onkeypress="return soloNumeros(event)" onpaste="return false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-address-card"></i>
                                                    </div>
                                                    <input name="name" id="txtpersona" type="text" class="form-control" placeholder="Nombre completo" required="" maxlength="60" onkeypress="return soloLetras(event)" onpaste="return false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar-check-o"></i>
                                                    </div>
                                                    <input name="expiry" id="txtexpiracion" type="tel" class="form-control" placeholder="MM/YY" required="" maxlength="16" onpaste="return false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-cc"></i>
                                                    </div>
                                                    <input name="cvc" id="txtclave" type="number" class="form-control" placeholder="CVC" required="" maxlength="3" onpaste="return false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <input id="txtemail" type="email" class="form-control" placeholder="Email" required="" maxlength="100" onpaste="return false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="glyphicon glyphicon-lock"></i>
                                                    </div>
                                                    <input id="txtpassword" type="password" class="form-control" placeholder="Password" required="" maxlength="12" onkeypress="return CEspeciales(event)" onpaste="return false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                    <input id="txtcantidad" type="text" class="form-control" placeholder="Cantidad" required="" maxlength="12" onkeypress="return soloNumeros(event)" onpaste="return false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <input id="txtpventa" type="text" class="form-control" placeholder="Precio" value="<?php echo $precio?>" readonly required="" maxlength="12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-shopping-basket"></i>
                                                    </div>
                                                    <input id="txtproducto" type="text" class="form-control" placeholder="Producto" value="<?php echo $producto?>" readonly required="" maxlength="12">
                                                </div>
                                            </div>
                                            <input id="txtidproducto" type="text" class="form-control" placeholder="Producto" required="" maxlength="12" value="<?php echo $clave?>" style="visibility:hidden">
                                            <input id="txtimagen" type="text" class="form-control" placeholder="Imagen" required="" maxlength="12" value="<?php echo $imagen?>" style="visibility:hidden">
                                            <div class="text-center credit-card-custom">
                                                <button type="button" class="btn btn-info"  @click="comprar">Guardar datos</button>
                                            </div>        
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel panel-info">
                                <div class="panel-heading text-center">&nbsp;<strong>Datos de la targeta</strong></div>
                                    <br>
                                        <div class="card-wrapper"></div>
                                    <br>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel panel-info">
                                <div class="panel-heading text-center">&nbsp;<strong>Producto</strong></div>
                                    <br>
                                        <div class="text-center">
                                            <img id="img" src="../src/img/productos/<?php echo $imagen;?>" class="rounded" width="300px" height="245px">
                                        </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        <script src="../src/js/jquery-1.11.3.min.js"></script>
        <!-- <script src="../css/bootstrap.min.js"></script> -->
        <script src="../src/js/card.js"></script>
        <script src="../src/js/e-payment.js"></script>
    </body>
</html>
