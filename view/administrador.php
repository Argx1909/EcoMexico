<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if ($_SESSION['Acceso']=='AccessoConcedidoAdministrador')
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
        <link rel="stylesheet" href="../src/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
        <!-- <link rel="stylesheet" href="../src/css/dataTables.bootstrap4.css">  -->
        <script src="../src/js/jquery-2.1.0.min.js"></script>
        <script src="../src/js/bootstrap.js"></script>
        <script src="../src/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="../src/js/validaciones.js"></script>
        <link rel="stylesheet" href="../src/css/sweetalert2.min.css">
    </head>
    <body>
        <div id="confiadministrador">
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
                            <h1 class="animated lightSpeedIn">Panel administrativo</h1>
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
                <div class="row">
                    <div class="col-sm-3">
                        <img src="../src/img/multimedia/administrador.png" alt="Image" class="img-responsive" width="100px" height="100px">
                    </div>
                    <div class="col-sm-9">
                        <p class="lead text-info">Bienvenido administrador, aqui podra agregar nuevos administradores, actualizar sus datos de cuenta y podra inabilitar su cuenta si lo desea.</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#Insert" data-toggle="tab"><i class="fa fa-street-view"></i>&nbsp;&nbsp;Agregar</a></li>
                            <li><a href="#Agregar" data-toggle="tab"><i class="fa fa-user-circle-o"></i>&nbsp;&nbsp;Cuenta</a></li>
                            <li><a href="#Update" data-toggle="tab"><i class="fa fa-edit"></i>&nbsp;&nbsp;Actualizar</a></li>
                            <li><a href="#Inabilitar" data-toggle="tab"><i class="fa fa-address-card-o"></i>&nbsp;&nbsp;Inabilitar</a></li>
                        </ul>
                        <!-- SE REITE LOS NOMBRES DE LOS TEXT CAMBIARLOS-->
                        <div class="tab-content">
                            <br>
                            <!--DATOS DEL ADMINISTRADOR-->
                            <div class="tab-pane active" id="Insert">
                                <div class="col-sm-4">
                                    <div class="panel panel-info">
                                    <div class="panel-heading text-center">&nbsp;<strong>Agregar datos del nuevo administrador</strong></div>
                                        <div class="panel-body">
                                            <form role="form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-list-ol"></i>
                                                        </div>
                                                        <select id="cmbArea" class="form-control">
                                                            <option v-bind:value="0">Seleccionar</option>
                                                            <option v-for="(area,indice) of ctAreas" v-bind:value="area.intId_Area">
                                                                {{area.vchArea}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input  id="txtInsNombre" type="text" class="form-control" placeholder="Nombre" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input id="txtInsPaterno" type="text" class="form-control" placeholder="Apellido paterno" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input id="txtInsMaterno" type="text" class="form-control" placeholder="Apellido materno" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-newspaper-o"></i>
                                                        </div>
                                                        <input id="txtInsDireccion" type="text" class="form-control" placeholder="Direccion" maxlength="100" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                        <input id="txtInsTelefono" type="text" class="form-control" placeholder="Telefono" maxlength="10" onkeypress="return soloNumeros(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <center><button type="button" class="btn btn-info"  @click="insertardatos">Guardar datos</button></center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="panel panel-info">
                                    <div class="panel-heading text-center">&nbsp;<strong>Administradores registrados</strong></div>
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Clave</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Direccion</th>
                                                    <th class="text-center">Telefono</th>
                                                    <th class="text-center">Area</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(administradores,indice) of ctAdministradores">
                                                    <td class="text-center">{{administradores.intId_Persona}}</td>
                                                    <td class="text-center">{{administradores.Nombre}}</td>
                                                    <td class="text-center">{{administradores.vchDireccion}}</td>
                                                    <td class="text-center">{{administradores.vchTelefono}}</td>
                                                    <td class="text-center">{{administradores.vchArea}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--AGREGAR CUENTA-->
                            <div class="tab-pane" id="Agregar">
                                <div class="col-sm-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading text-center">&nbsp;<strong>Agregar cuenta del nuevo administrador</strong></div>
                                        <div class="panel-body">
                                            <form role="form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-card-o"></i>
                                                        </div>
                                                        <select id="cmbDatos" class="form-control">
                                                            <option v-bind:value="0">Seleccionar</option>
                                                            <option v-for="(datos,indice) of ctDatos" v-bind:value="datos.intId_Persona">
                                                                {{datos.Nombre}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-users"></i>
                                                        </div>
                                                        <select id="cmbRool" class="form-control">
                                                            <option v-bind:value="0">Seleccionar</option>
                                                            <option v-for="(rool,indice) of ctRooles" v-bind:value="rool.intId_Rool">
                                                                {{rool.vchRool}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>
                                                        <input id="txtInsEmail" type="email" class="form-control" placeholder="Email" required="" maxlength="100" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="glyphicon glyphicon-lock"></i>
                                                        </div>
                                                        <input id="txtInsPassword" type="password" class="form-control" placeholder="Password" required="" maxlength="12" onkeypress="return CEspeciales(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <center><button type="button" class="btn btn-info" @click="insertarcuenta">Guardar cuenta</button></center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="panel panel-info">
                                    <div class="panel-heading text-center">&nbsp;<strong>Cuentas administrativas</strong></div>
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Clave</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center">Password</th>
                                                    <th class="text-center">Rool</th>
                                                    <th class="text-center">Acceso</th>
                                                    <th class="text-center">Opcion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(cuentas,indice) of ctCuentas">
                                                    <td class="text-center">{{cuentas.intId_Usuario}}</td>
                                                    <td class="text-center">{{cuentas.Nombre}}</td>
                                                    <td class="text-center">{{cuentas.vchEmail}}</td>
                                                    <td class="text-center">{{cuentas.vchPassword}}</td>
                                                    <td class="text-center">{{cuentas.vchRool}}</td>
                                                    <td class="text-center">{{cuentas.vchAcceso}}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-secondary" title="Editar acceso"  @click="editarestado(cuentas.intId_Usuario,cuentas.vchAcceso,cuentas.Nombre)"><i class="fa fa-pencil"></i></button>                                                     
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--ACTUALIZAR CUENTA-->
                            <div class="tab-pane" id="Update">
                                <div class="col-sm-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading text-center">&nbsp;<strong>Actualizar datos</strong></div>
                                        <div class="panel-body">
                                            <form role="form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input id="txtUpdNombre" type="text" class="form-control" value="<?php echo $_SESSION['Nombre']?>" placeholder="Nombre" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input  id="txtUpdPaterno" type="text" class="form-control" value="<?php echo $_SESSION['Paterno']?>" placeholder="Apellido paterno" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input  id="txtUpdMaterno" type="text" class="form-control" value="<?php echo $_SESSION['Materno']?>" placeholder="Apellido materno" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-newspaper-o"></i>
                                                        </div>
                                                        <input  id="txtUpdDireccion" type="text" class="form-control" value="<?php echo $_SESSION['Direccion']?>" placeholder="Direccion"  maxlength="100" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                        <input  id="txtUpdTelefono" type="text" class="form-control" value="<?php echo $_SESSION['Telefono']?>" placeholder="Telefono"  maxlength="10" onkeypress="return soloNumeros(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>
                                                        <input  id="txtUpdEmail" type="email" class="form-control" value="<?php echo $_SESSION['Email']?>" placeholder="Email" maxlength="100" onpaste="return false">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="glyphicon glyphicon-lock"></i>
                                                        </div>
                                                        <input  id="txtUpdPassword" type="password" class="form-control" value="<?php echo $_SESSION['Password']?>" placeholder="Password" maxlength="12" onkeypress="return CEspeciales(event)" onpaste="return false">
                                                    </div>
                                                </div>
                                                <center><button type="button" class="btn btn-info" @click="actualizar">Actualizar datos</button></center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="col-xs-12 col-md-12 lead well">
                                        <img  src="../src/img/multimedia/edit.png" class="img-responsive logos_GnuLinux" alt="Image" width="150px" height="150px">
                                        <div class="text-center">
                                            <h3 class="text-info"><?php echo $_SESSION["Nombre"]?><?php echo " "?><?php echo $_SESSION["Paterno"]?><?php echo " "?><?php echo $_SESSION["Materno"]?></h3>
                                        </div>
                                        <p class="text-justify">
                                            Al actualizar tus datos automaticamente se cerrara la sesion iniciada, en caso de modificar tu email o password, deberas utilizarlo en tu proximo inicio de sesion.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--ELIMINAR CUENTA-->
                            <div class="tab-pane" id="Inabilitar">
                                <div class="col-sm-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading text-center">&nbsp;<strong>Datos actuales</strong></div>
                                        <div class="panel-body">
                                            <form role="form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input id="txtDelNombre" type="text" class="form-control" value="<?php echo $_SESSION['Nombre']?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input  id="txtDelPaterno" type="text" class="form-control" value="<?php echo $_SESSION['Paterno']?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-address-book-o"></i>
                                                        </div>
                                                        <input  id="txtDelMaterno" type="text" class="form-control" value="<?php echo $_SESSION['Materno']?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-newspaper-o"></i>
                                                        </div>
                                                        <input  id="txtDelDireccion" type="text" class="form-control" value="<?php echo $_SESSION['Direccion']?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                        <input  id="txtDelTelefono" type="text" class="form-control" value="<?php echo $_SESSION['Telefono']?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>
                                                        <input  id="txtDelEmail" type="email" class="form-control" value="<?php echo $_SESSION['Email']?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="glyphicon glyphicon-lock"></i>
                                                        </div>
                                                        <input  id="txtDelPassword" type="password" class="form-control" value="<?php echo $_SESSION['Password']?>" readonly>
                                                    </div>
                                                </div>
                                                <center><button type="button" class="btn btn-danger" @click="inabilitarcuenta">Inabilitar cuenta</button></>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="col-xs-12 col-md-12 lead wel">
                                        <img  src="../src/img/multimedia/Delete.png" class="img-responsive logos_GnuLinux" alt="Image" width="150px" height="150px">
                                        <div class="text-center">
                                            <h3 class="text-info"><?php echo $_SESSION["Nombre"]?><?php echo " "?><?php echo $_SESSION["Paterno"]?><?php echo " "?><?php echo $_SESSION["Materno"]?></h3>
                                        </div>
                                        <p class="text-justify">
                                            Al inabilitar tus datos automaticamente se cerrara la sesion iniciada, para ingresar nuevamente al sistema deberas recurrir a un administrador para reanudar tu cuenta.
                                        </p>
                                    </div>
                                </div>
                            </div>
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
        <!--VUE-->
        <script src="../src/js/vue.js"></script>
        <!--AXIOS-->
        <script src="../src/js/axios.js"></script>
        <!--SWEETALER2-->
        <script src="../src/js/sweetalert2.all.min.js"></script>
        <!-- CONTOLADOR DE INDEX -->
        <script src="../controller/conadministrador.js"></script>
    </body>
</html>
<?php
  }
  else
  {
    header("location:index.php");
  }
?>