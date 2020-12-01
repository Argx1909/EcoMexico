<?php
include_once 'conexion.php';
$objeto=new Conexion();
$conexion=$objeto->Abrir_conexion();
$_POST=json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
switch($opcion){
    case 1: 
        $consulta = "SELECT tblproductos.`intId_Producto`,CONCAT(tblproveedores.`vchNombre`,' ',tblproveedores.`vchApPaterno`,' ',tblproveedores.`vchApPaterno`)AS Proveedor,tblproveedores.`vchEmail`,tblproveedores.`vchTelefono`,tblproductos.`vchProducto`,tblproductos.`flPrecioCompra`,tblinventario.`intCantAlmacen` FROM tblproductos,tblproveedores,tblinventario WHERE tblinventario.`intCantAlmacen`=0 AND tblproductos.`intId_Producto`=tblinventario.`intId_Producto` AND tblproductos.`intId_Proveedor`=tblproveedores.`intId_Proveedor`;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        break;
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>