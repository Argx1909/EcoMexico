<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
$opcion =(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$clave=(isset($_POST['clave'])) ? $_POST['clave'] : '';
$idproducto=(isset($_POST['idproducto'])) ? $_POST['idproducto'] : '';
$imagen=(isset($_POST['imagen'])) ? $_POST['imagen'] : '';
$producto=(isset($_POST['producto'])) ? $_POST['producto'] : '';
$pventa=(isset($_POST['pventa'])) ? $_POST['pventa'] : '';
$cantidad=(isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$subtotal=(isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
switch($opcion){
    case 1:
        $consulta = "SELECT tblproductos.`intId_Producto`,tblproductos.`vchProducto`,tblproductos.`vchImagen`,tblproductos.`flPrecioVenta`,tblinventario.`intCantAlmacen` FROM tblproductos,tblinventario WHERE tblinventario.`intCantAlmacen`>0 AND tblproductos.`intId_Producto`=tblinventario.`intId_Producto`;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta="SELECT intId_Preventa,intId_Producto,vchImagen,flPrecioVenta,intCantidad,flSubtotal FROM tblpreventa;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);         
        break;
    case 3:
        $fecha=date('d-m-Y');
        $consulta="INSERT INTO tblpreventa(intId_Producto,vchImagen,flPrecioVenta,intCantidad,flSubtotal,vchFechaCompra)VALUES('$idproducto','$imagen','$pventa','$cantidad','$subtotal','$fecha');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 4:
        $consulta="UPDATE tblpreventa SET intCantidad='$cantidad',flSubTotal='$subtotal' WHERE intId_Preventa='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 5:
        $consulta="DELETE FROM tblpreventa WHERE intId_Preventa='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 6:
        $consulta="SELECT intId_Producto,flPrecioVenta,intCantidad,flSubTotal,vchFechaCompra FROM tblpreventa;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        if($resultado->rowCount()){
            session_start();
            $contenido=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($contenido as $datos){
                $intId_Producto=$datos['intId_Producto'];
                $flPrecioVenta=$datos['flPrecioVenta'];
                $intCantidad=$datos['intCantidad'];
                $flSubTotal=$datos['flSubTotal'];
                $vchFechaCompra=$datos['vchFechaCompra'];

                $consulta="INSERT INTO tblvdetalle(intId_Producto,flPrecioVenta,intCantidad,flSubtotal,vchFechaCompra)VALUES('$intId_Producto','$flPrecioVenta','$intCantidad','$flSubTotal','$vchFechaCompra');";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }
        }  
        $consulta="DELETE FROM tblpreventa;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        break;
    case 7:
        $consulta="DELETE FROM tblpreventa;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>