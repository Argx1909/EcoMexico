<?php
include_once 'conexion.php';
$objeto=new Conexion();
$conexion=$objeto->Abrir_conexion();
$_POST=json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idpersona=(isset($_POST['idpersona'])) ? $_POST['idpersona'] : '';
$nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$paterno=(isset($_POST['paterno'])) ? $_POST['paterno'] : '';
$materno=(isset($_POST['materno'])) ? $_POST['materno'] : '';
$direccion=(isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono=(isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$rool=(isset($_POST['rool'])) ? $_POST['rool'] : '';
$email=(isset($_POST['email'])) ? $_POST['email'] : '';
$password=(isset($_POST['password'])) ? $_POST['password'] : '';
$data=null;
$idproducto=(isset($_POST['idproducto'])) ? $_POST['idproducto'] : '';
$imagen=(isset($_POST['imagen'])) ? $_POST['imagen'] : '';
$pventa=(isset($_POST['pventa'])) ? $_POST['pventa'] : '';
$cantidad=(isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$subtotal=(isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';

switch($opcion){
    case 1:
        $consulta="SELECT vchRool FROM tblrool;";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta="SELECT tblpersona.`vchNombre`,tblpersona.`vchApPaterno`,tblpersona.`vchApMaterno`,tblpersona.`vchDireccion`,tblpersona.`vchTelefono`,tblusuarios.`vchEmail`,tblusuarios.`vchPassword`,tblrool.`vchRool` FROM tblpersona,tblusuarios,tblrool WHERE tblusuarios.`vchEmail`='$email' AND tblusuarios.`vchPassword`=$password AND tblrool.`vchRool`='$rool' AND tblusuarios.`vchAcceso`='Concedido' AND tblpersona.`intId_Persona`=tblusuarios.`intId_Persona` AND tblusuarios.`intId_Rool`=tblrool.`intId_Rool`;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        if($resultado->rowCount()){
            session_start();
            $contenido=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($contenido as $datos){
                $_SESSION['Nombre']=$datos['vchNombre'];
                $_SESSION['Paterno']=$datos['vchApPaterno'];
                $_SESSION['Materno']=$datos['vchApMaterno'];
                $_SESSION['Direccion']=$datos['vchDireccion'];
                $_SESSION['Telefono']=$datos['vchTelefono'];
                $_SESSION['Email']=$datos['vchEmail'];
                $_SESSION['Password']=$datos['vchPassword'];
                $_SESSION['Rool']=$datos['vchRool'];
            }
            $_SESSION['Acceso']='AccessoConcedido'.$_SESSION['Rool'];
            $data='AccessoConcedido'.$_SESSION['Rool'];
        }
        break;  
    case 3:
        $consulta="INSERT INTO tblpersona(vchNombre,vchApPaterno,vchApMaterno,vchDireccion,vchTelefono)VALUES('$nombre','$paterno','$materno','$direccion','$telefono');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $consulta="SELECT intId_Persona,CONCAT(vchNombre,' ',vchApPaterno,' ',vchApMaterno)AS Nombre FROM tblpersona WHERE vchNombre='$nombre' AND vchApPaterno='$paterno' AND vchApMaterno='$materno' AND vchDireccion='$direccion' AND vchTelefono='$telefono';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;
    case 4:
        $consulta="INSERT INTO tblusuarios(intId_Persona,vchEmail,vchPassword,intId_Rool,vchAcceso)VALUES('$idpersona','$email','$password','2','Concedido');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        break;
    case 5:
        $consulta="SELECT tblpersona.`intId_Persona`,tblpersona.`vchDireccion` FROM tblpersona,tblusuarios WHERE tblusuarios.`vchEmail`='$email' AND tblusuarios.`vchPassword`='$password' AND tblusuarios.`intId_Persona`=tblpersona.`intId_Persona`;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        if($resultado->rowCount()){
            $data="existente";
        }
        break;
    case 6:
        $fecha=date('d-m-Y');
        $consulta="SELECT tblpersona.`intId_Persona`,tblpersona.`vchDireccion` FROM tblpersona,tblusuarios WHERE tblusuarios.`vchEmail`='$email' AND tblusuarios.`vchPassword`='$password' AND tblusuarios.`intId_Persona`=tblpersona.`intId_Persona`;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        if($resultado->rowCount()){
            $contenido=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($contenido as $datos){
                $intId_Persona=$datos['intId_Persona'];
                $direnenviar=$datos['vchDireccion'];
            }
            $consulta="INSERT INTO tblvonline(intId_Producto,vchImagen,flPrecioVenta,intCantidad,flSubTotal,intId_Persona,vchDireccion,vchFechaCompra)VALUES('$idproducto','$imagen','$pventa','$cantidad','$subtotal','$intId_Persona','$direnenviar','$fecha');";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>