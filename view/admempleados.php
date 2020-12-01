<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if ($_SESSION['Acceso']=='AccessoConcedidoAdministrador')
{?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EcoMexico</title>
  <link rel="shortcut icon" type="image/x-icon" href="../src/img/multimedia/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../src/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../src/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../src/css/adminlte.min.css">
  <script src="../src/js/validaciones.js"></script>
  <link rel="stylesheet" href="../src/css/sweetalert2.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div id="admempleados">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="menu.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user-circle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <center><span class="dropdown-item">Datos de la cuenta</span></center>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-address-card mr-2"></i><?php echo $_SESSION["Nombre"]?><?php echo " "?><?php echo $_SESSION["Paterno"]?><?php echo " "?><?php echo $_SESSION["Materno"]?>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i><?php echo $_SESSION["Email"]?>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i><?php echo $_SESSION["Rool"]?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="cerrarsesion.php" class="dropdown-item">
                                <center><i class="fas fa-power-off mr-2"></i>Cerrar sesion</center>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="" class="brand-link">
                    <img src="../src/img/multimedia/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">EcoMexico</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="../src/img/multimedia/administrador.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?php echo $_SESSION["Nombre"]?><?php echo " "?><?php echo $_SESSION["Paterno"]?><?php echo " "?><?php echo $_SESSION["Materno"]?></a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item has-treeview">
                                <a href="menu.php" class="nav-link active">
                                    <i class="nav-icon fa fa-home"></i>
                                    <p>
                                        Home
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="adminventario.php" class="nav-link">
                                            <i class="fa fa-book nav-icon"></i>
                                            <p>Inventario</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admvonline.php" class="nav-link">
                                            <i class="fa fa-desktop nav-icon"></i>
                                            <p>Ventas online</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fa fa-folder"></i>
                                    <p>
                                        Datos
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admclientes.php" class="nav-link">
                                            <i class="fa fa-street-view nav-icon"></i>
                                            <p>Clientes</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admproveedores.php" class="nav-link">
                                            <i class="fa fa-address-book nav-icon"></i>
                                            <p>Proveedores</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fa fa-shopping-bag"></i>
                                    <p>
                                        Movimientos
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admempleados.php" class="nav-link">
                                            <i class="fa fa-address-card nav-icon"></i>
                                            <p>Empleados</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admproductos.php" class="nav-link">
                                            <i class="fa fa-shopping-basket nav-icon"></i>
                                            <p>Productos</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admusuarios.php" class="nav-link">
                                            <i class="fa fa-users nav-icon"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admventas.php" class="nav-link">
                                            <i class="fa fa-shopping-cart nav-icon"></i>
                                            <p>Ventas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary" title="Nuevo empleado"  data-toggle="modal" data-target="#Insert"><i class="fa fa-address-card mr-2" aria-hidden="true"></i>Nuevo empleado</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de empleados</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Clave</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">A.Paterno</th>
                                                <th class="text-center">A.Materno</th>
                                                <th class="text-center">Direccion</th>
                                                <th class="text-center">Telefono</th>
                                                <th class="text-center">Area</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(empleados,indice) of ctEmpleados">
                                                <td class="text-center">{{empleados.intId_Persona}}</td>
                                                <td class="text-center">{{empleados.vchNombre}}</td>
                                                <td class="text-center">{{empleados.vchApPaterno}}</td>
                                                <td class="text-center">{{empleados.vchApMaterno}}</td>
                                                <td class="text-center">{{empleados.vchDireccion}}</td>
                                                <td class="text-center">{{empleados.vchTelefono}}</td>
                                                <td class="text-center">{{empleados.intId_Area}}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-success btn-sm" title="Editar empleado" data-toggle="modal" @click="cargarvalue(empleados.intId_Persona,empleados.vchNombre,empleados.vchApPaterno,empleados.vchApMaterno,empleados.vchDireccion,empleados.vchTelefono,empleados.intId_Area)" data-target="#Update" ><i class="fas fa-edit"></i></button>    
                                                        <button class="btn btn-danger btn-sm" title="Eliminar empleado" @click="eliminar(empleados.intId_Persona)"><i class="fas fa-trash"></i></button>       
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- modal insertar -->
                <div class="modal fade" id="Insert" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Empleado</h5>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <select class="form-control" id="cmbInsareas">
                                                    <option v-bind:value="0">Selecciona el area</option>
                                                    <option v-for="(areas,indice) of ctAreas" v-bind:value="areas.intId_Area">
                                                        {{areas.vchArea}}
                                                    </option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtInsnombre" type="text" class="form-control" maxlength="50" placeholder="Nombre" onkeypress="return soloLetras(event)" onpaste="return false" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtInspaterno" type="text" class="form-control" maxlength="50" placeholder="Apellido paterno" onkeypress="return soloLetras(event)" onpaste="return false" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtInsmaterno" type="text" class="form-control" maxlength="50" placeholder="Apellido materno" onkeypress="return soloLetras(event)" onpaste="return false" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtInsdireccion" type="text" class="form-control" maxlength="50" placeholder="Direccion" onkeypress="return CEspeciales(event)" onpaste="return false" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtInstelefono" type="text" class="form-control" maxlength="10" placeholder="Telefono" onkeypress="return soloNumeros(event)" onpaste="return false"/>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" title="Guardar" @click="insertar"><i class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- find del modal insertar -->
                <!-- modal actualizar -->
                <div class="modal fade" id="Update" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Empleado</h5>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <select class="form-control" id="cmbUpdareas">
                                                    <option v-bind:value="0">Selecciona el area</option>
                                                    <option v-for="(areas,indice) of ctAreas" v-bind:value="areas.intId_Area">
                                                        {{areas.vchArea}}
                                                    </option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtUpdnombre" type="text" class="form-control" maxlength="50" placeholder="Nombre" onkeypress="return soloLetras(event)" onpaste="return false"/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtUpdpaterno" type="text" class="form-control" maxlength="50" placeholder="Apellido paterno" onkeypress="return soloLetras(event)" onpaste="return false" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtUpdmaterno" type="text" class="form-control" maxlength="50" placeholder="Apellido materno" onkeypress="return soloLetras(event)" onpaste="return false" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtUpddireccion" type="text" class="form-control" maxlength="50" placeholder="Direccion" onkeypress="return CEspeciales(event)" onpaste="return false"/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input id="txtUpdtelefono" type="text" class="form-control" maxlength="10" placeholder="Telefono" onkeypress="return soloNumeros(event)" onpaste="return false"/>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" title="Guardar" @click="editar" data-dismiss="modal" aria-label="Close"><i class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- find del modal actualizar -->
            </div>
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 1.0-EcoMexico-Back-End
                </div>
                <strong>Copyright &copy; 2015-2024 <a>EcoMexico</a>.</strong> All rights
                reserved.
            </footer>
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
        </div>
    </div>
    <script src="../src/js/jquery.min.js"></script>
    <script src="../src/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/jquery.dataTables.js"></script>
    <script src="../src/js/dataTables.bootstrap4.js"></script>
    <script src="../src/js/adminlte.min.js"></script>
    <script src="../src/js/demo.js"></script>
    <script src="../src/js/vue.js"></script>
    <script src="../src/js/axios.js"></script>
    <script src="../src/js/sweetalert2.all.min.js"></script>
    <script src="../controller/conaempleados.js"></script>
    <script>
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
    </script>
</body>
</html>
<?php
  }
  else
  {
    header("location:index.php");
  }
?>