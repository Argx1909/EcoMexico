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
$direccion=(isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono=(isset($_POST['telefono'])) ? $_POST['telefono'] : '';
switch($opcion){
     case 1:
        $consulta="SELECT intId_Persona,vchNombre,vchApPaterno,vchApMaterno,vchDireccion,vchTelefono FROM tblpersona;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case 2:
        $consulta="INSERT INTO tblpersona(vchNombre,vchApPaterno,vchApMaterno,vchDireccion,vchTelefono)VALUES('$nombre','$paterno','$materno','$direccion','$telefono');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 3:
        $consulta="UPDATE tblpersona SET vchNombre='$nombre',vchApPaterno='$paterno',vchApMaterno='$materno',vchDireccion='$direccion',vchTelefono='$telefono' WHERE intId_Persona='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
        break;       
    case 4:
        $consulta = "DELETE FROM tblpersona WHERE intId_Persona='$clave';";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break; 
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>