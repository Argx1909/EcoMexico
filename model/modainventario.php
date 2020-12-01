<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
$_POST= json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
switch($opcion){
   case 1:
      $consulta="SELECT intId_Existencia,vchProducto,vchImagen,intCantidad,intCantVendida,intCantAlmacen FROM tblinventario;";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();  
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
      break;
   case 2:
      $consulta="SELECT intId_Existencia,vchProducto,vchImagen,intCantidad,intCantVendida,intCantAlmacen FROM tblinventario WHERE intCantAlmacen=0;";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();  
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
      break;
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>