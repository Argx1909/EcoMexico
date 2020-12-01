<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
//$_POST = json_decode(file_get_contents("php://input"), true);
$opcion =(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$clave=(isset($_POST['clave'])) ? $_POST['clave'] : '';
$producto= (isset($_POST['producto'])) ? $_POST['producto'] : '';
$pcompra= (isset($_POST['pcompra'])) ? $_POST['pcompra'] : '';
$pventa= (isset($_POST['pventa'])) ? $_POST['pventa'] : '';
$cantidad= (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$subtotal= (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
$imagen=(isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name']: '';
$descripcion=(isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$proveedor=(isset($_POST['proveedor'])) ? $_POST['proveedor'] : '';
$categoria=(isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$borrar=(isset($_POST['borrar'])) ? $_POST['borrar'] : '';
switch($opcion){
    case 1:
        $consulta = "SELECT intId_Producto,vchProducto,flPrecioCompra,intCantidad,vchImagen,intId_Proveedor,intCategoria FROM tblproductos;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "SELECT intId_Proveedor,CONCAT(vchNombre,' ',vchApPaterno,' ',vchApMaterno)AS Nombre FROM tblproveedores;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta="INSERT INTO tblproductos(vchProducto,flPrecioCompra,flPrecioVenta,intCantidad,flSubTotal,vchImagen,vchDescripcion,intId_Proveedor,intCategoria)VALUES('$producto','$pcompra','$pventa','$cantidad','$subtotal','$imagen','$descripcion','$proveedor','$categoria');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $rtactual=$_FILES['imagen']['tmp_name']; 
        $ruta="../src/img/productos/".$imagen;
        if($resultado) {
            move_uploaded_file($rtactual,$ruta);
        }   
        break;
    case 4:
        if($imagen==null){
            $consulta="UPDATE tblproductos SET vchProducto='$producto',flPrecioCompra='$pcompra',flPrecioVenta='$pventa',intCantidad='$cantidad',flSubTotal='$subtotal',intId_Proveedor='$proveedor',intCategoria='$categoria' WHERE intId_Producto='$clave';";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        }else{
            $consulta="UPDATE tblproductos SET vchProducto='$producto',flPrecioCompra='$pcompra',flPrecioVenta='$pventa',intCantidad='$cantidad',flSubTotal='$subtotal',vchImagen='$imagen',intId_Proveedor='$proveedor',intCategoria='$categoria' WHERE intId_Producto='$clave';";
            $rtactual=$_FILES['imagen']['tmp_name']; 
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $ruta="../src/img/productos/".$imagen;
            if($resultado) {
                move_uploaded_file($rtactual,$ruta);
                unlink($borrar);
            }
        }
        break;
    case 5:
        $consulta = "DELETE FROM tblproductos WHERE intId_Producto='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        if($resultado) 
        {
            unlink($borrar);
        }
        break;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>