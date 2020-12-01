/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.13-MariaDB : Database - bdecomexicowe
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdecomexicowe` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bdecomexicowe`;

/*Table structure for table `tblarea` */

DROP TABLE IF EXISTS `tblarea`;

CREATE TABLE `tblarea` (
  `intId_Area` int(11) NOT NULL AUTO_INCREMENT,
  `vchArea` varchar(70) NOT NULL,
  PRIMARY KEY (`intId_Area`),
  UNIQUE KEY `vchArea` (`vchArea`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tblarea` */

insert  into `tblarea`(`intId_Area`,`vchArea`) values (1,'Almacen'),(2,'Dp Administrativo'),(3,'Dp de ventas'),(4,'DpRecursos humanos');

/*Table structure for table `tblinventario` */

DROP TABLE IF EXISTS `tblinventario`;

CREATE TABLE `tblinventario` (
  `intId_Existencia` int(11) NOT NULL AUTO_INCREMENT,
  `vchProducto` varchar(50) NOT NULL,
  `vchImagen` varchar(100) NOT NULL,
  `intCantidad` int(11) NOT NULL,
  `intCantVendida` int(11) NOT NULL,
  `intCantAlmacen` int(11) NOT NULL,
  `intId_Producto` int(11) NOT NULL,
  PRIMARY KEY (`intId_Existencia`),
  KEY `intId_Producto` (`intId_Producto`),
  CONSTRAINT `tblinventario_ibfk_1` FOREIGN KEY (`intId_Producto`) REFERENCES `tblproductos` (`intId_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tblinventario` */

/*Table structure for table `tblpersona` */

DROP TABLE IF EXISTS `tblpersona`;

CREATE TABLE `tblpersona` (
  `intId_Persona` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(30) NOT NULL,
  `vchApPaterno` varchar(30) NOT NULL,
  `vchApMaterno` varchar(30) NOT NULL,
  `vchDireccion` varchar(30) NOT NULL,
  `vchTelefono` varchar(10) NOT NULL,
  `intId_Area` int(11) DEFAULT NULL,
  PRIMARY KEY (`intId_Persona`),
  UNIQUE KEY `vchTelefono` (`vchTelefono`),
  KEY `intId_Area` (`intId_Area`),
  CONSTRAINT `tblpersona_ibfk_1` FOREIGN KEY (`intId_Area`) REFERENCES `tblarea` (`intId_Area`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tblpersona` */

insert  into `tblpersona`(`intId_Persona`,`vchNombre`,`vchApPaterno`,`vchApMaterno`,`vchDireccion`,`vchTelefono`,`intId_Area`) values (2,'Jose','Gayosso','Sotero','San Francisco','3243434545',2);

/*Table structure for table `tblpreventa` */

DROP TABLE IF EXISTS `tblpreventa`;

CREATE TABLE `tblpreventa` (
  `intId_Preventa` int(11) NOT NULL AUTO_INCREMENT,
  `intId_Producto` int(11) NOT NULL,
  `vchImagen` varchar(100) NOT NULL,
  `flPrecioVenta` float NOT NULL,
  `intCantidad` int(11) NOT NULL,
  `flSubtotal` float NOT NULL,
  `intId_Persona` int(11) DEFAULT NULL,
  `vchFechaCompra` varchar(50) NOT NULL,
  PRIMARY KEY (`intId_Preventa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tblpreventa` */

/*Table structure for table `tblproductos` */

DROP TABLE IF EXISTS `tblproductos`;

CREATE TABLE `tblproductos` (
  `intId_Producto` int(11) NOT NULL AUTO_INCREMENT,
  `vchProducto` varchar(50) NOT NULL,
  `flPrecioCompra` float NOT NULL,
  `flPrecioVenta` float NOT NULL,
  `intCantidad` int(11) NOT NULL,
  `flSubTotal` float NOT NULL,
  `vchImagen` varchar(100) NOT NULL,
  `vchDescripcion` varchar(900) NOT NULL,
  `intId_Proveedor` int(11) NOT NULL,
  `intCategoria` int(11) NOT NULL,
  PRIMARY KEY (`intId_Producto`),
  KEY `intId_Proveedor` (`intId_Proveedor`),
  CONSTRAINT `tblproductos_ibfk_1` FOREIGN KEY (`intId_Proveedor`) REFERENCES `tblproveedores` (`intId_Proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tblproductos` */

/*Table structure for table `tblproveedores` */

DROP TABLE IF EXISTS `tblproveedores`;

CREATE TABLE `tblproveedores` (
  `intId_Proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(100) NOT NULL,
  `vchApPaterno` varchar(100) NOT NULL,
  `vchApMaterno` varchar(100) NOT NULL,
  `vchEmail` varchar(100) DEFAULT NULL,
  `vchDireccion` varchar(200) NOT NULL,
  `vchTelefono` varchar(10) NOT NULL,
  PRIMARY KEY (`intId_Proveedor`),
  UNIQUE KEY `vchTelefono` (`vchTelefono`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tblproveedores` */

insert  into `tblproveedores`(`intId_Proveedor`,`vchNombre`,`vchApPaterno`,`vchApMaterno`,`vchEmail`,`vchDireccion`,`vchTelefono`) values (1,'Pedro','Escamilla','Hernandez','Pedro@live.com','Huehuetla','0905809348'),(3,'Juana','Gonzalez','Hernandez','Juana@live.com','Poza rica','7897987897');

/*Table structure for table `tblrool` */

DROP TABLE IF EXISTS `tblrool`;

CREATE TABLE `tblrool` (
  `intId_Rool` int(11) NOT NULL AUTO_INCREMENT,
  `vchRool` varchar(50) NOT NULL,
  PRIMARY KEY (`intId_Rool`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tblrool` */

insert  into `tblrool`(`intId_Rool`,`vchRool`) values (1,'Administrador'),(2,'Cliente');

/*Table structure for table `tblusuarios` */

DROP TABLE IF EXISTS `tblusuarios`;

CREATE TABLE `tblusuarios` (
  `intId_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `intId_Persona` int(11) NOT NULL,
  `vchEmail` varchar(50) NOT NULL,
  `vchPassword` varchar(12) NOT NULL,
  `intId_Rool` int(11) NOT NULL,
  `vchAcceso` varchar(100) NOT NULL,
  PRIMARY KEY (`intId_Usuario`),
  UNIQUE KEY `vchEmail` (`vchEmail`),
  KEY `intId_Rool` (`intId_Rool`),
  KEY `intId_Persona` (`intId_Persona`),
  CONSTRAINT `tblusuarios_ibfk_1` FOREIGN KEY (`intId_Rool`) REFERENCES `tblrool` (`intId_Rool`),
  CONSTRAINT `tblusuarios_ibfk_2` FOREIGN KEY (`intId_Persona`) REFERENCES `tblpersona` (`intId_Persona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tblusuarios` */

insert  into `tblusuarios`(`intId_Usuario`,`intId_Persona`,`vchEmail`,`vchPassword`,`intId_Rool`,`vchAcceso`) values (1,2,'Jose@live.com','123',1,'Concedido');

/*Table structure for table `tblvdetalle` */

DROP TABLE IF EXISTS `tblvdetalle`;

CREATE TABLE `tblvdetalle` (
  `intId_VDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `intId_Producto` int(11) NOT NULL,
  `flPrecioVenta` float NOT NULL,
  `intCantidad` int(11) NOT NULL,
  `flSubtotal` float NOT NULL,
  `intId_Persona` int(11) DEFAULT NULL,
  `vchFechaCompra` varchar(30) NOT NULL,
  PRIMARY KEY (`intId_VDetalle`),
  KEY `intId_Producto` (`intId_Producto`),
  KEY `intId_Persona` (`intId_Persona`),
  CONSTRAINT `tblvdetalle_ibfk_1` FOREIGN KEY (`intId_Producto`) REFERENCES `tblproductos` (`intId_Producto`),
  CONSTRAINT `tblvdetalle_ibfk_2` FOREIGN KEY (`intId_Persona`) REFERENCES `tblpersona` (`intId_Persona`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `tblvdetalle` */

/*Table structure for table `tblvonline` */

DROP TABLE IF EXISTS `tblvonline`;

CREATE TABLE `tblvonline` (
  `intId_Online` int(11) NOT NULL AUTO_INCREMENT,
  `intId_Producto` int(11) NOT NULL,
  `vchImagen` varchar(100) NOT NULL,
  `flPrecioVenta` float NOT NULL,
  `intCantidad` int(11) NOT NULL,
  `flSubTotal` float NOT NULL,
  `intId_Persona` int(11) NOT NULL,
  `vchDireccion` varchar(900) NOT NULL,
  `vchFechaCompra` varchar(60) NOT NULL,
  PRIMARY KEY (`intId_Online`),
  KEY `intId_Persona` (`intId_Persona`),
  CONSTRAINT `tblvonline_ibfk_1` FOREIGN KEY (`intId_Persona`) REFERENCES `tblpersona` (`intId_Persona`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `tblvonline` */

/* Trigger structure for table `tblproductos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `TGTInsert-tblinventario` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `TGTInsert-tblinventario` AFTER INSERT ON `tblproductos` FOR EACH ROW BEGIN
	insert into tblinventario(vchProducto,vchImagen,intCantidad,intCantVendida,intCantAlmacen,intId_Producto)
	values(NEW.vchProducto,NEW.vchImagen,NEW.intCantidad,0,NEW.intCantidad,NEW.intId_Producto);
    END */$$


DELIMITER ;

/* Trigger structure for table `tblproductos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `TGTUpdate-tblinventario` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `TGTUpdate-tblinventario` AFTER UPDATE ON `tblproductos` FOR EACH ROW BEGIN
	update tblinventario set vchProducto=NEW.vchProducto,intCantidad=NEW.intCantidad,intCantAlmacen=NEW.intCantidad
	where intId_Producto=NEW.intId_Producto;
    END */$$


DELIMITER ;

/* Trigger structure for table `tblproductos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `TGTDelete-tblinventario` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `TGTDelete-tblinventario` BEFORE DELETE ON `tblproductos` FOR EACH ROW BEGIN
	delete from tblinventario where intId_Producto=OLD.intId_Producto;
    END */$$


DELIMITER ;

/* Trigger structure for table `tblvdetalle` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `TGTInser-tblvdetalle` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `TGTInser-tblvdetalle` AFTER INSERT ON `tblvdetalle` FOR EACH ROW BEGIN
	UPDATE tblinventario SET intCantVendida=(intCantVendida+NEW.intCantidad),intCantAlmacen=(intCantAlmacen-NEW.intCantidad) 
	WHERE intId_Producto=NEW.intId_Producto;
    END */$$


DELIMITER ;

/* Trigger structure for table `tblvonline` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `TGRInsert-tblvonline` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `TGRInsert-tblvonline` AFTER INSERT ON `tblvonline` FOR EACH ROW BEGIN
	UPDATE tblinventario SET intCantVendida=(intCantVendida+NEW.intCantidad),intCantAlmacen=(intCantAlmacen-NEW.intCantidad) 
	WHERE intId_Producto=NEW.intId_Producto;
	insert into tblvdetalle(intId_Producto,flPrecioVenta,intCantidad,flSubtotal,intId_Persona,vchFechaCompra)
	values(NEW.intId_Producto,NEW.flPrecioVenta,NEW.intCantidad,NEW.flSubtotal,NEW.intId_Persona,NEW.vchFechaCompra);
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
