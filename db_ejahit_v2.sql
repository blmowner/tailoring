/*
SQLyog Community v11.31 (32 bit)
MySQL - 10.1.16-MariaDB : Database - db_ejahit_v2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ejahit_v2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_ejahit_v2`;

/*Table structure for table `color` */

DROP TABLE IF EXISTS `color`;

CREATE TABLE `color` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(55) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `color` */

insert  into `color`(`c_id`,`c_name`) values (1,'Black'),(2,'Grey'),(3,'Blue'),(4,'Aqua'),(5,'Turquoise'),(6,'Brown'),(7,'Green'),(8,'Orange'),(9,'Peach'),(10,'Purple'),(11,'Violet'),(12,'Red'),(13,'White'),(14,'Yellow'),(15,'Gold');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `c_id` varchar(55) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_gender` varchar(55) NOT NULL,
  `c_phone` varchar(22) NOT NULL,
  `c_shipping` text NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`c_id`,`c_name`,`c_gender`,`c_phone`,`c_shipping`) values ('customer','customer','lelaki','1231232131','asdas'),('saleha','siti saleha','perempuan','0123456789','jln kasturi');

/*Table structure for table `fabric` */

DROP TABLE IF EXISTS `fabric`;

CREATE TABLE `fabric` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(100) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `fabric` */

insert  into `fabric`(`f_id`,`f_name`) values (2,'Sutera'),(3,'Cotton');

/*Table structure for table `garment` */

DROP TABLE IF EXISTS `garment`;

CREATE TABLE `garment` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_type` varchar(100) NOT NULL,
  `g_fabric` varchar(100) NOT NULL,
  `g_color` varchar(55) NOT NULL,
  `g_neck` decimal(11,2) NOT NULL,
  `g_shoulder` decimal(11,2) NOT NULL,
  `g_bust` decimal(11,2) NOT NULL,
  `g_waist` decimal(11,2) NOT NULL,
  `g_hips` decimal(11,2) NOT NULL,
  `g_length` decimal(11,2) NOT NULL,
  `g_arm_hole` decimal(11,2) NOT NULL,
  `g_others` text NOT NULL,
  `c_id` varchar(55) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `garment` */

insert  into `garment`(`g_id`,`g_type`,`g_fabric`,`g_color`,`g_neck`,`g_shoulder`,`g_bust`,`g_waist`,`g_hips`,`g_length`,`g_arm_hole`,`g_others`,`c_id`) values (1,'baju melayu','Cotton','','11.00','11.00','11.00','11.00','11.00','11.00','11.00','11','hafiz'),(2,'Baju Kurung','Sutera','Grey','12.00','12.00','12.00','12.00','12.00','12.00','12.00','jgn labuh sgt tau','saleha'),(3,'Baju Cheongsam','Sutera','Aqua','15.00','15.00','15.00','15.00','15.00','15.00','15.00','fit to the body plz.','siti'),(46,'Baju Melayu Cekak Musang','Sutera','Violet','1.00','1.00','1.00','1.00','1.00','1.00','1.00','1','customer'),(47,'Baju Kurung Pahang','Sutera','Blue','1.00','1.00','1.00','1.00','1.00','1.00','1.00','1','customer');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `o_id` varchar(55) NOT NULL,
  `o_date` varchar(55) NOT NULL,
  `o_quantity` int(11) NOT NULL,
  `o_price` varchar(55) NOT NULL DEFAULT 'processing',
  `o_payment_status` varchar(55) NOT NULL DEFAULT 'pending',
  `o_alter_status` varchar(255) NOT NULL DEFAULT 'sedang menganalisa ukuran',
  `o_payment_proof` varchar(100) NOT NULL,
  `o_status` varchar(255) NOT NULL DEFAULT 'processing',
  `o_tracking` varchar(55) NOT NULL,
  `g_id` int(11) NOT NULL,
  `c_id` varchar(55) NOT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`o_id`,`o_date`,`o_quantity`,`o_price`,`o_payment_status`,`o_alter_status`,`o_payment_proof`,`o_status`,`o_tracking`,`g_id`,`c_id`) values ('ID-19188','2017-03-10',1,'20','processing','sedang menganalisa ukuran','plain_gray.PNG','processing','',47,'customer'),('ID-20718','2017-03-10',1,'processing','pending','sedang menganalisa ukuran','','processing','',46,'customer');

/*Table structure for table `ref_image` */

DROP TABLE IF EXISTS `ref_image`;

CREATE TABLE `ref_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_id` int(11) DEFAULT NULL,
  `g_fabric` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `image_path` varchar(150) DEFAULT NULL,
  `c_id` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `ref_image` */

insert  into `ref_image`(`image_id`,`g_id`,`g_fabric`,`file_name`,`image_path`,`c_id`) values (28,46,'Sutera','1.JPG','uploads/1.JPG','customer'),(29,47,'Sutera','9.JPG','uploads/9.JPG','customer');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`user_id`,`password`,`level`) values (30,'admin','21232f297a57a5a743894a0e4a801fc3','admin'),(87,'saleha','b683f820dd6b78aa9ae3795e21c68f99','customer'),(94,'customer','91ec1f9324753048c0096d036a694f86','customer');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
