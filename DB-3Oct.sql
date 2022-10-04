/*
SQLyog Community v8.71 
MySQL - 5.5.5-10.4.20-MariaDB : Database - incubarsoporte
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`incubarsoporte` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `incubarsoporte`;

/*Table structure for table `agentes` */

DROP TABLE IF EXISTS `agentes`;

CREATE TABLE `agentes` (
  `id_agente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_agente` varchar(20) DEFAULT NULL,
  `correo_agente` varchar(30) DEFAULT NULL,
  `usuario_agente` varchar(20) DEFAULT NULL,
  `contrasena_agente` varchar(10) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_agente`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

/*Data for the table `agentes` */

insert  into `agentes`(`id_agente`,`nombre_agente`,`correo_agente`,`usuario_agente`,`contrasena_agente`,`id_rol`,`eliminar`,`fecha_eliminado`) values (1,'prueba','prueba1@gmail.com','prueba1','123456',1,0,NULL),(21,'veronica dussan','veanmi_12@hotmail.com','veronicadussan1127','vgpIkHSz',1,0,NULL),(22,'veronica dussan','veanmi_12@hotmail.com','veronicadussan2369','cT8KxThf',1,0,NULL),(23,'veronica dussan','veanmi_12@hotmail.com','veronicadussan0591','qwEe7AUK',1,0,NULL),(24,'ana milena','anmidupa@hotmail.com','AnaMilenaDussan437_','tOGodXuO',2,1,'2022-10-03 19:09:47'),(25,'miguel dussan','vejumadu@gmail.com','migueldussan3731','yU3GpxFc',1,0,NULL),(26,'veronicadussan','veanmi_1122@hotmail.com','veronicadussan0749','systGnJx',1,0,NULL),(27,'veronica dussan','veanmi_12@hotmail.com','veronicadussan4_45','ZOl5SLDM',2,0,NULL),(28,'veronica dussan','veanmi_12@hotmail.com','veronicadussan_2_6','xsfLOrUx',1,0,NULL),(29,'veronica dussan','veanmi_12@hotmail.com','veronicadussan7244','JONGEtbl',1,0,'2022-10-03 19:12:41'),(30,'veronica dussan','veanmi_12@hotmail.com','veronicadussan5569','nAIS7yEV',1,0,NULL),(31,'veronica','veronica@hotmail.com','veronica8622','8yNZm5ah',2,0,NULL),(32,'pruebas agentes','pruebas@gotmiallll.com','pruebasagentes','gWKzlYgO',1,0,'0000-00-00 00:00:00'),(33,'ana veronica parra','veanmi_12@hotmail.com','anaveronicaparra','dYVIp8Nn',1,0,'0000-00-00 00:00:00');

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(45) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `categorias` */

insert  into `categorias`(`id_categoria`,`nombre_categoria`,`eliminar`,`fecha_eliminado`) values (1,'Sin categoria',0,NULL),(2,'Efectividad de la instalacion',0,NULL),(3,'Equipos desconectados / manipulacion',0,NULL),(4,'Informacion/actualizacion',0,NULL),(5,'Lentitud en el servicio',0,NULL),(6,'Llamada callidad del servicio',0,NULL),(7,'Mantenimiento correctivo',0,NULL),(8,'Mantenimiento preventivo',0,NULL);

/*Table structure for table `cierre_tickets` */

DROP TABLE IF EXISTS `cierre_tickets`;

CREATE TABLE `cierre_tickets` (
  `id_cierre_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_cierre_ticket` datetime DEFAULT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cierre_ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cierre_tickets` */

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(45) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `eliminar` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `clientes` */

insert  into `clientes`(`id_cliente`,`nombre_cliente`,`id_proyecto`,`eliminar`,`fecha_eliminado`) values (1,'promocion social',1,NULL,NULL),(2,'la escuelita',1,NULL,NULL),(3,'alcaldia de neiva',2,NULL,NULL),(4,'alcaldia del huila',2,NULL,NULL);

/*Table structure for table `estados` */

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `estados` */

insert  into `estados`(`id_estado`,`estado`,`eliminar`,`fecha_eliminado`) values (1,'En proceso',NULL,NULL),(2,'En espera de la respuesta del cliente',NULL,NULL),(3,'En espera de respuesta del agente',NULL,NULL),(4,'Cerrado',NULL,NULL);

/*Table structure for table `permisos` */

DROP TABLE IF EXISTS `permisos`;

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(30) DEFAULT NULL,
  `descripcion_permiso` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

/*Data for the table `permisos` */

insert  into `permisos`(`id_permiso`,`permiso`,`descripcion_permiso`) values (1,'Ver sin asignar','Visibilidad de la lista de tickets sin asignar.'),(2,'Vista asignado a mí','Ticket asignado al propio usuario. Esto también habilitará notas privadas.'),(3,'Ver otras personas asignadas','Ticket asignado a todos los demás agentes. Esto también habilitará notas privadas.'),(4,'Asignar sin asignar','Capacidad de agente de asignación de tickets sin asignar.'),(5,'Asignar asignado a mí','Ticket asignado al propio usuario. Asignar capacidad adicional.'),(6,'Asignar asignado a otros','Ticket asignado a todos los otros agentes asignan capacidad adicional.'),(7,'Responder sin asignar','Capacidad de respuesta de tickets sin asignar.'),(8,'Responder asignado a mí','Ticket asignado a la capacidad de respuesta del propio usuario.'),(9,'Responder asignado a otros','Ticket asignado a todos los otros agentes de capacidad de respuesta.'),(10,'Cambiar estado sin asignar','Capacidad de cambio de estado de ticket sin asignar.'),(11,'Cambiar estado asignado a mí','Ticket asignado al propio usuario cambiar la capacidad de estado del boleto.'),(12,'Cambiar estado asignado a otro','El ticket asignado a todos los demás agentes cambia la capacidad de estado del ticket.'),(13,'Cambiar campos de ticket sin a','Capacidad de campos de ticket de cambio sin asignar.'),(14,'Cambiar los campos de ticket q','Ticket asignado al propio usuario cambiar la capacidad de los campos del boleto.'),(15,'Cambiar campos de ticket asign','Ticket asignado a todos los otros agentes cambian la capacidad de los campos del boleto.'),(16,'Cambiar Agente sólo campos sin','Capacidad de campos de agente de cambio no asignados.'),(17,'Cambiar los campos de agente s','Ticket asignado al propio usuario cambiar la capacidad de los campos de agente solo.'),(18,'Cambiar los campos de agente s','El ticket asignado a todos los demás agentes cambia la capacidad de los campos de solo agente.'),(19,'Cambio elevado por no asignado','Cambio de ticket no asignado provocado por la capacidad.'),(20,'Cambio elevado por asignado a ','Ticket asignado por el propio usuario cambiado por capacidad.'),(21,'Cambio elevado por otros asign','El ticket asignado a todos los otros agentes cambiado elevado por capacidad.'),(22,'Eliminar sin asignar','Eliminar la capacidad del ticket sin asignar.'),(23,'Eliminar asignado a mí','Ticket asignado al propio usuario para eliminar la capacidad.'),(24,'Eliminar asignados a otros','Ticket asignado a todos los otros agentes de eliminar la capacidad.'),(25,'Nota privada sin asignar','Capacidad de ticket no asignado de nota privada.'),(26,'Nota privada que me asignaron','Ticket asignado al propio usuario con capacidad de nota privada.'),(27,'Nota privada asignada a otros','Ticket asignado a todos los demás agentes capacidad de nota privada.'),(28,'Editar/Eliminar subprocesos no','Capacidad de editar/eliminar subprocesos de tickets no asignados.'),(29,'Editar/Eliminar subprocesos as','Capacidad de editar/eliminar subprocesos de tickets por el propio usuario.'),(30,'Editar/Eliminar Subprocesos as','Capacidad de editar/eliminar subprocesos de tickets asignados a todos los agentes.');

/*Table structure for table `pivote_permisos` */

DROP TABLE IF EXISTS `pivote_permisos`;

CREATE TABLE `pivote_permisos` (
  `id_pivote_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `id_permiso` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pivote_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pivote_permisos` */

/*Table structure for table `prioridades` */

DROP TABLE IF EXISTS `prioridades`;

CREATE TABLE `prioridades` (
  `id_prioridad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prioridad` varchar(40) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_prioridad`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `prioridades` */

insert  into `prioridades`(`id_prioridad`,`nombre_prioridad`,`id_proyecto`,`eliminar`,`fecha_eliminado`) values (1,'Prioridad 1 (Alta o perdida completa)',1,0,NULL),(2,'Prioridad 2 (Media o intermitencia)',1,0,NULL),(3,'Prioridad 3 (Bajo o informacion)',1,0,NULL),(4,'Prioridad 4 General',1,0,NULL);

/*Table structure for table `procesos_tickets` */

DROP TABLE IF EXISTS `procesos_tickets`;

CREATE TABLE `procesos_tickets` (
  `id_proceso_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_respuesta` datetime DEFAULT NULL,
  `respuesta` varchar(300) DEFAULT NULL,
  `archivo_adjunto_proceso` varchar(90) DEFAULT NULL,
  `nombre_cliente_respuesta` varchar(20) DEFAULT NULL,
  `correo_cliente_respuesta` varchar(20) DEFAULT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  `id_agente` int(11) DEFAULT NULL,
  `id_prioridad` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proceso_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `procesos_tickets` */

/*Table structure for table `proyectos` */

DROP TABLE IF EXISTS `proyectos`;

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` varchar(30) DEFAULT NULL,
  `identificador_proyecto` varchar(4) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `proyectos` */

insert  into `proyectos`(`id_proyecto`,`nombre_proyecto`,`identificador_proyecto`,`eliminar`,`fecha_eliminado`) values (1,'Institucion o sede educativa','IE',0,NULL),(2,'Sede alcaldia de Neiva','SA',0,NULL),(3,'General','G',0,'0000-00-00 00:00:00');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(30) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`id_rol`,`nombre_rol`,`eliminar`,`fecha_eliminado`) values (1,'administrador',NULL,NULL),(2,'agente',NULL,NULL);

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `numero_ticket` varchar(10) DEFAULT NULL,
  `nombre_apellido_usuario` varchar(40) DEFAULT NULL,
  `numero_identificacion_usuario` varchar(25) DEFAULT NULL,
  `celular_usuario` varchar(15) DEFAULT NULL,
  `correo_usuario` varchar(30) DEFAULT NULL,
  `asunto` varchar(80) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `archivo_adjunto_ticket` varchar(90) DEFAULT NULL,
  `fecha_creacion_ticket` datetime DEFAULT NULL,
  `id_tipo_identificacion` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_tipo_requerimiento` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tickets` */

insert  into `tickets`(`id_ticket`,`numero_ticket`,`nombre_apellido_usuario`,`numero_identificacion_usuario`,`celular_usuario`,`correo_usuario`,`asunto`,`descripcion`,`archivo_adjunto_ticket`,`fecha_creacion_ticket`,`id_tipo_identificacion`,`id_cliente`,`id_tipo_requerimiento`,`id_estado`,`eliminar`,`fecha_eliminado`) values (17,'IE17','JUAN NARVAEZ','12136555','3174459874','vejumadu@gmail.com','no se','talvezz','ESPECTROFOTOMETRÍA.docx','2022-09-21 22:36:20',1,1,1,1,NULL,NULL),(18,'IE18','miguel dussan','132454888','3126554896','vejumadu@gmail.com','dew','ewdw','WhatsApp Image 2022-09-19 at 2.46.41 PM.jpeg','2022-09-21 22:41:57',1,2,2,1,NULL,NULL),(19,'IE18','veronica dussan','1075296985','3265478521','veanmi_12@hotmail.com','de132','cewcwe','Arma (1).docx','2022-09-21 22:43:42',1,1,3,1,NULL,NULL),(20,'prueba','veronica dussan','123','121','veanmi_12@hotmail.com','ccde','cxew','Resumen herramienta de diagnostico.docx','2022-09-25 23:27:10',4,2,2,1,NULL,NULL),(21,'prueba','Veronica dussan parra','32123','232','veanmi_12@hotmail.com','de','dew','Resumen herramienta de diagnostico.docx','2022-09-25 23:27:54',2,2,1,1,NULL,NULL);

/*Table structure for table `tipo_identificaciones` */

DROP TABLE IF EXISTS `tipo_identificaciones`;

CREATE TABLE `tipo_identificaciones` (
  `id_tipo_identificacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_identificacion` varchar(25) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tipo_identificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tipo_identificaciones` */

insert  into `tipo_identificaciones`(`id_tipo_identificacion`,`tipo_identificacion`,`eliminar`,`fecha_eliminado`) values (1,'Cedula de ciudadania',NULL,NULL),(2,'NIT',NULL,NULL),(3,'Pasaporte',NULL,NULL),(4,'Codigo DANE',NULL,NULL),(5,'Tarjeta de identidad',NULL,NULL),(6,'Cedula estrangera',NULL,NULL);

/*Table structure for table `tipo_requerimientos` */

DROP TABLE IF EXISTS `tipo_requerimientos`;

CREATE TABLE `tipo_requerimientos` (
  `id_tipo_requerimiento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_requerimiento` varchar(30) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tipo_requerimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tipo_requerimientos` */

insert  into `tipo_requerimientos`(`id_tipo_requerimiento`,`tipo_requerimiento`,`eliminar`,`fecha_eliminado`) values (1,'Incidente(Reporte de fallas)',NULL,NULL),(2,'solicitud(Informacion)',NULL,NULL),(3,'General',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
