<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
$_POST= json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$clave=(isset($_POST['clave'])) ? $_POST['clave'] : '';
$persona=(isset($_POST['persona'])) ? $_POST['persona'] : '';
$email=(isset($_POST['email'])) ? $_POST['email'] : '';
$password=(isset($_POST['password'])) ? $_POST['password'] : '';
$rool=(isset($_POST['rool'])) ? $_POST['rool'] : '';
$acceso=(isset($_POST['acceso'])) ? $_POST['acceso'] : '';
switch($opcion){
    case 1:
        $consulta="SELECT intId_Usuario,intId_Persona,vchEmail,vchPassword,intId_Rool,vchAcceso FROM tblusuarios;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case 2:
        $consulta="SELECT intId_Persona,CONCAT(vchNombre,' ',vchApPaterno,' ',vchApMaterno)AS Nombre FROM tblpersona;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case 3:
        $consulta="SELECT intId_Rool,vchRool FROM tblrool;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case 4:
        $consulta="INSERT INTO tblusuarios(intId_Persona,vchEmail,vchPassword,intId_Rool,vchAcceso)VALUES('$persona','$email','$password','$rool','$acceso');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 5:
        $consulta="UPDATE tblusuarios SET intId_Persona='$persona',vchEmail='$email',vchPassword='$password',intId_Rool='$rool',vchAcceso='$acceso' WHERE intId_Usuario='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
        break;       
    case 6:
        $consulta = "DELETE FROM tblusuarios WHERE intId_Usuario='$clave';";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break; 
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>