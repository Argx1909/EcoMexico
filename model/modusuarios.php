<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
$_POST= json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$acceso=(isset($_POST['acceso'])) ? $_POST['acceso'] : '';
$idusuario=(isset($_POST['idusuario'])) ? $_POST['idusuario'] : '';
switch($opcion){
    case 1:
        $consulta="UPDATE tblusuarios SET vchAcceso='$acceso' WHERE intId_Usuario='$idusuario';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
    break;       
    case 2:
        $consulta = "SELECT tblusuarios.`intId_Usuario`,CONCAT(tblpersona.`vchNombre`,' ',tblpersona.`vchApPaterno`,' ',tblpersona.`vchApMaterno`) AS Nombre,tblpersona.`vchTelefono`,tblusuarios.`vchEmail`,tblrool.`vchRool`,tblusuarios.`vchAcceso` FROM tblpersona,tblusuarios,tblrool WHERE tblrool.`vchRool`='Cliente' AND tblpersona.`intId_Persona`=tblusuarios.`intId_Persona` AND tblusuarios.`intId_Rool`=tblrool.`intId_Rool`;";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                         
    break; 
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>