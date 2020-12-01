<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
$_POST= json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
switch($opcion){
   case 1:
      $consulta="SELECT tblvonline.`intId_Online`,CONCAT(tblpersona.`vchNombre`,' ',tblpersona.`vchApPaterno`,' ',tblpersona.`vchApMaterno`)AS Nombre,tblvonline.`vchImagen`,tblvonline.`intCantidad`,tblvonline.`flPrecioVenta`,tblvonline.`flSubTotal`,tblvonline.`vchDireccion`,tblvonline.`vchFechaCompra` FROM tblpersona,tblvonline WHERE tblpersona.`intId_Persona`=tblvonline.`intId_Persona`;";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();  
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
      break;
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>