<?php
include_once 'conexion.php';
$objeto=new Conexion();
$conexion=$objeto->Abrir_conexion();
$_POST=json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$administrador=(isset($_POST['administrador'])) ? $_POST['administrador'] : '';
$nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$paterno=(isset($_POST['paterno'])) ? $_POST['paterno'] : '';
$materno=(isset($_POST['materno'])) ? $_POST['materno'] : '';
$direccion=(isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono=(isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$area=(isset($_POST['area'])) ? $_POST['area'] : '';
$email=(isset($_POST['email'])) ? $_POST['email'] : '';
$password=(isset($_POST['password'])) ? $_POST['password'] : '';
$rool=(isset($_POST['rool'])) ? $_POST['rool'] : '';
$acceso=(isset($_POST['acceso'])) ? $_POST['acceso'] : '';
$idusuario=(isset($_POST['idusuario'])) ? $_POST['idusuario'] : '';
$telefonoact=(isset($_POST['telefonoact'])) ? $_POST['telefonoact'] : '';
$emailact=(isset($_POST['emailact'])) ? $_POST['emailact'] : '';
$passwordact=(isset($_POST['passwordact'])) ? $_POST['passwordact'] : '';
switch($opcion){
    case 1:
        $consulta="INSERT INTO tblpersona(vchNombre,vchApPaterno,vchApMaterno,vchDireccion,vchTelefono,intId_Area)VALUES('$nombre','$paterno','$materno','$direccion','$telefono','$area');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $consulta = "SELECT intId_Persona,CONCAT(vchNombre,' ',vchApPaterno,' ',vchApMaterno)AS Nombre FROM tblpersona WHERE vchNombre='$nombre' AND vchApPaterno='$paterno' AND vchApMaterno='$materno' AND vchDireccion='$direccion' AND vchTelefono='$telefono';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        break;
    case 2:
        $consulta="INSERT INTO tblusuarios(intId_Persona,vchEmail,vchPassword,intId_Rool,vchAcceso)VALUES('$administrador','$email','$password','$rool','Concedido');";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 3:
        $consulta="UPDATE tblpersona SET vchNombre='$nombre',vchApPaterno='$paterno',vchApMaterno='$materno',vchDireccion='$direccion',vchTelefono='$telefono' WHERE vchTelefono='$telefonoact';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $consulta="UPDATE tblusuarios SET vchEmail='$email',vchPassword='$password' WHERE vchEmail='$emailact' AND vchPassword='$passwordact';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        break; 
    case 4:
        $consulta="UPDATE tblusuarios SET vchAcceso='$acceso' WHERE intId_Usuario='$idusuario';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                      
        break;
    case 5:
        $consulta = "UPDATE tblusuarios SET vchAcceso='Denegado' WHERE vchEmail='$email' AND vchPassword='$password';";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        break; 
    case 6:
        $consulta ="SELECT intId_Area,vchArea FROM tblarea ORDER BY vchArea ASC;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 7:
        $consulta = "SELECT intId_Rool,vchRool FROM tblrool ORDER BY vchRool ASC;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 8:
        $consulta ="SELECT tblpersona.`intId_Persona`,CONCAT(tblpersona.`vchNombre`,' ',tblpersona.`vchApPaterno`,' ',tblpersona.`vchApMaterno`)AS Nombre,tblpersona.`vchDireccion`,tblpersona.`vchTelefono`,tblarea.`vchArea`FROM tblpersona,tblarea WHERE tblpersona.`intId_Area`=tblarea.`intId_Area`;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 9:
        $consulta ="SELECT tblusuarios.`intId_Usuario`,CONCAT(tblpersona.`vchNombre`,' ',tblpersona.`vchApPaterno`,' ',tblpersona.`vchApMaterno`)AS Nombre,tblusuarios.`vchEmail`,tblusuarios.`vchPassword`,tblrool.`vchRool`,tblusuarios.`vchAcceso` FROM tblusuarios,tblpersona,tblrool WHERE tblusuarios.`intId_Persona`=tblpersona.`intId_Persona` AND tblusuarios.`intId_Rool`=tblrool.`intId_Rool` AND tblrool.`vchRool`='Administrador';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>