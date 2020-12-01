<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
$_POST= json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$emailact=(isset($_POST['emailact'])) ? $_POST['emailact'] : '';
$passwordact=(isset($_POST['passwordact'])) ? $_POST['passwordact'] : '';
$emailnue=(isset($_POST['emailnue'])) ? $_POST['emailnue'] : '';
$passwordnue=(isset($_POST['passwordnue'])) ? $_POST['passwordnue'] : '';
$nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$paterno=(isset($_POST['paterno'])) ? $_POST['paterno'] : '';
$materno=(isset($_POST['materno'])) ? $_POST['materno'] : '';
switch($opcion){
    case 1:
        $consulta="UPDATE tblusuarios SET vchEmail='$emailnue',vchPassword='$passwordnue' WHERE vchEmail='$emailact' AND vchPassword='$passwordact';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
        break;       
    case 2:
        $consulta = "DELETE FROM tblusuarios WHERE vchEmail='$emailact' AND vchPassword='$passwordact';";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break; 
    case 3:
        $consulta="SELECT tblvonline.`intId_Online`,`tblvonline`.`vchImagen`, `tblvonline`.`intCantidad`, `tblvonline`.`flPrecioVenta`, `tblvonline`.`flSubTotal`, `tblvonline`.`vchFechaCompra`FROM `bdecomexicowe`.`tblvonline`INNER JOIN `bdecomexicowe`.`tblpersona` ON (`tblvonline`.`intId_Persona` = `tblpersona`.`intId_Persona`)WHERE tblpersona.`vchNombre`='$nombre' AND tblpersona.`vchApPaterno`='$paterno' AND tblpersona.`vchApMaterno`='$materno';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
        break;
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>