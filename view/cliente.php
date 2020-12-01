<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');  
if ($_SESSION['Acceso']=='AccessoConcedidoCliente')
{?> 
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
        <!-- CSS DE LA TABLA -->
        <!-- <link rel="stylesheet" href="../css/adminlte.min.css"> -->
        <!-- <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css"> -->
        <!-- <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-table.css">
        <link rel="stylesheet" href="../css/bootstrap-editable.css"> -->
        <!-- <link rel="stylesheet" href="../css/style.css"> -->
            <!-- <link rel="stylesheet" href="../src/css/style.css">   -->
        <!-- FIN -->
        
        <script src="../src/js/jquery-2.1.0.min.js"></script>
        <script src="../src/js/bootstrap.js"></script>
        <script src="../src/js/jquery-ui-1.10.4.custom.min.js"></script>
        <link rel="stylesheet" href="../src/css/sweetalert2.min.css">     
    </head>
    <body>  
        <div id="conficliente"> 
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
                                        <a href="#!"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Mensajes</a>
                                    </li>
                                    <li>
                                        <a href="cliente.php"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                                    </li> 
                                    <?php endif; ?>
                                    <!--ADMINISTRADOR-->
                                    <?php if($_SESSION['Rool']=="Administrador"): ?>
                                    <li>
                                        <a href=" "><span class="glyphicon glyphicon-envelope"></span> &nbsp; Administrar Tickets</a>
                                    </li>
                                    <li>
                                        <a href="usuarios.php"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar Usuarios</a>
                                    </li>
                                    <li>
                                        <a href="administrador.php"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar Administradores</a>
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
                                <a href="atencionacliente.php"><span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;Atencion a cliente</a>
                            </li>
                            <li>
                                <a href="conocenos.php"><span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;Conocenos</a>
                            </li>
                            <?php if(!isset($_SESSION['Rool']) && !isset($_SESSION['Nombre'])): ?>
                            <li>
                                <a href="registro.php"><i class="fa fa-users"></i>&nbsp;&nbsp;Registro</a>
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
            <div class="container">
                <div class="row well">
                    <div class="col-sm-3">
                        <img src="../src/img/multimedia/configuracion.png" alt="Image" class="img-responsive" width="150px" height="150px">
                    </div>
                    <div class="col-sm-9 lead">
                        <h2 class="text-info"><?php echo $_SESSION["Nombre"]?><?php echo " "?><?php echo $_SESSION["Paterno"]?><?php echo " "?><?php echo $_SESSION["Materno"]?><?php echo " "?></h2>
                        <p>En este apartado puedes <strong>actualizar los datos</strong> de tu cuenta ó puedes <strong>eliminar tu cuenta</strong> permanentemente si ya no deseas ser usuario de EcoMexico</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">&nbsp;&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                            <div class="panel-body">
                                <form action="" method="" role="form">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-address-book-o"></i>
                                            </div>
                                            <input  id="txtNombre" type="text" class="form-control" value="<?php echo $_SESSION['Nombre']?>" readonly maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-address-book-o"></i>
                                            </div>
                                            <input id="txtPaterno" type="text" class="form-control" value="<?php echo $_SESSION['Paterno']?>" readonly maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-address-book-o"></i>
                                            </div>
                                            <input id="txtMaterno" type="text" class="form-control" value="<?php echo $_SESSION['Materno']?>" readonly maxlength="40">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input id="txtEmailActual" type="text" class="form-control" value="<?php echo  $_SESSION['Email']?>" readonly maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="glyphicon glyphicon-lock"></i>
                                            </div>
                                            <input id="txtPasswordActual" type="password" class="form-control" value="<?php echo $_SESSION['Password']?>" placeholder="Dato necesario" readonly maxlength="12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </div>
                                            <input id="txtNuevoEmail" type="text" class="form-control"  placeholder="Nuevo email" maxlength="50" onpaste="return false">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-unlock-alt"></i>
                                            </div>
                                            <input id="txtPasswordNuevo" type="password" class="form-control" placeholder="Nuevo password" maxlength="12" onkeypress="return CEspeciales(event)" onpaste="return false">
                                        </div>
                                    </div>
                                    <center>
                                        <button type="button" class="btn btn-info" @click="actualizar">Guardar cuenta</button>
                                        <button type="button" class="btn btn-danger" @click="eliminar">Eliminar cuenta</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">&nbsp;&nbsp;<strong>Historial de compras</strong></div>
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Clave</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Fecha</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr v-for="(compra,indice) of ctCompras">
                                            <td class="text-center">{{compra.intId_Online}}</td>
                                            <td class="text-center"><img :src="'../src/img/productos/'+compra.vchImagen" class="rounded" width="30px" height="30px"></td>
                                            <td class="text-center">{{compra.intCantidad}}</td>
                                            <td class="text-center">{{compra.flPrecioVenta}}</td>
                                            <td class="text-center">{{compra.flSubTotal}}</td>
                                            <td class="text-center">{{compra.vchFechaCompra}}</td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PIE DE PAGINA -->
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



        <!-- <script src="../css/jquery.min.js"></script> -->
        <!-- <script src="../css/jquery.dataTables.min.js"></script>
        <script src="../css/dataTables.bootstrap4.min.js"></script> -->
        <!-- <script src="../css/datatables-init.js"></script> -->
        <!-- <script src="../css/adminlte.min.js"></script> -->
        <!-- <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            });
        });
        </script> -->
        <!-- <script src="../css/jquery-1.11.3.min.js"></script>
        <script src="../css/bootstrap.min.js"></script>
        <script src="../css/bootstrap-table.js"></script>
        <script src="../css/bootstrap-table-editable.js"></script>
        <script src="../css/bootstrap-editable.js"></script> -->
        <!--VUE-->
        <script src="../src/js/vue.js"></script>
        <!--AXIOS-->
        <script src="../src/js/axios.js"></script>
        <!--SWEETALER2-->
        <script src="../src/js/sweetalert2.all.min.js"></script>
        <!-- CONTOLADOR DE INDEX -->
        <script src="../controller/concliente.js"></script>
    </body>
</html>
<?php
  }
  else
  {
    header("location:index.php");
  }
?>