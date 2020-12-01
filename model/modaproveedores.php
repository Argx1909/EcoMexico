<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
$_POST= json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$clave=(isset($_POST['clave'])) ? $_POST['clave'] : '';
$nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$paterno=(isset($_POST['paterno'])) ? $_POST['paterno'] : '';
$materno=(isset($_POST['materno'])) ? $_POST['materno'] : '';
$email=(isset($_POST['email'])) ? $_POST['email'] : '';
$direccion=(isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono=(isset($_POST['telefono'])) ? $_POST['telefono'] : '';
switch($opcion){
    case 1:
        $consulta="SELECT intId_Proveedor,vchNombre,vchApPaterno,vchApMaterno,vchEmail,vchDireccion,vchTelefono FROM tblproveedores;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case 2:
        $consulta="INSERT INTO tblproveedores(vchNombre,vchApPaterno,vchApMaterno,vchEmail,vchDireccion,vchTelefono)VALUES('$nombre','$paterno','$materno','$email','$direccion','$telefono');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 3:
        $consulta="UPDATE tblproveedores SET vchNombre='$nombre',vchApPaterno='$paterno',vchApMaterno='$materno',vchEmail='$email',vchDireccion='$direccion',vchTelefono='$telefono' WHERE intId_Proveedor='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 4:
        $consulta="DELETE FROM tblproveedores WHERE intId_Proveedor='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
        break;        
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>