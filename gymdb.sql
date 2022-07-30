/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - gymdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gymdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `gymdb`;

/*Table structure for table `employes` */

DROP TABLE IF EXISTS `employes`;

CREATE TABLE `employes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `surname` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `status` varchar(100) COLLATE utf8_bin NOT NULL,
  `position` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `employes` */

insert  into `employes`(`id`,`name`,`surname`,`email`,`status`,`position`) values 
(1,'name','surname','mail@gmail.com','status','blabla'),
(5,'Novi eployee name','Surname','employe@gmail.com','active','gym coach'),
(7,'test2','test2','test2@gmail.com','active','coach'),
(8,'name','surname','mail@gmail.com','status','blabla'),
(9,'test update','test update','test@gmail.com','active','coach'),
(10,'test','test','proba@gmail.com','active','coach'),
(11,'name','surname','mail@f.com','status','blabla'),
(12,'test','test','test1@gmail.com','test','test');

/*Table structure for table `membership` */

DROP TABLE IF EXISTS `membership`;

CREATE TABLE `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `membership` */

insert  into `membership`(`id`,`description`,`price`) values 
(1,'test',50),
(3,'six months',250),
(4,'yearly',450),
(9,'test',50),
(10,'test',50);

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_membership_id` int(11) NOT NULL,
  `status` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_membership_id` (`user_membership_id`),
  CONSTRAINT `fk_user_membership_id` FOREIGN KEY (`user_membership_id`) REFERENCES `users_membership` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `payments` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`description`,`email`,`password`,`role`,`created`) values 
(46,'Hamza Bakaran','Owner','hamzabakaran@gmail.com','1234','admin','2022-07-26'),
(47,'Prvi User','Prvi','prviuser@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99','user','2022-07-26'),
(48,'test update','proba','proba@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','user','2022-07-30'),
(49,'Admin 2','Drugi admin','admin@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99','admin','2022-07-26'),
(50,'Test','test','test','test','admin','2022-07-28'),
(51,'testuser','test','test','test','user','2022-07-28'),
(52,'test12','test1','test1@gmail.com','test','user','2022-07-30'),
(53,'test update 2','test mail','ssssss@gmail.com','1234','user','2022-07-30'),
(54,'Novi','blabla','blabla@gmail.com','123456','user','2022-07-28'),
(55,'Novi','Muhica','hamza.bakaran@stu.ibu.edu.ba','123','user','2022-07-28'),
(56,'blabla','Admin','prviuser@gmail.com','123','user','2022-07-28'),
(57,'tester','1','tester@gmail.com','test','user','2022-07-28'),
(58,'Proba','proba','proba@gmail.com','proba','user','2022-07-29'),
(59,'Novi','Muhica','ssssss@kmail.com','1234','user','2022-07-29'),
(60,'blabla','proba','proba@gmail.com','123','user','2022-07-29'),
(61,'blabla1','proba','proba1@gmail.com','123','user','2022-07-29'),
(62,'Novi','Muhica','proba@gmail.com','1','user','2022-07-29'),
(63,'zzzz','zzzz','zzz@gmail.com','pop','user','2022-07-29'),
(64,'blabla','proba','proba@gmail.com','444','user','2022-07-29');

/*Table structure for table `users_membership` */

DROP TABLE IF EXISTS `users_membership`;

CREATE TABLE `users_membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`),
  KEY `fk_membership` (`membership_id`),
  CONSTRAINT `fk_membership` FOREIGN KEY (`membership_id`) REFERENCES `membership` (`id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `users_membership` */

insert  into `users_membership`(`id`,`user_id`,`membership_id`,`start_date`,`end_date`) values 
(65,47,1,'2022-07-26','2022-07-27'),
(67,50,1,'2022-07-28','2022-07-29'),
(68,46,1,'2022-07-28','2022-07-29'),
(69,50,1,'2022-07-28','2022-07-29'),
(70,48,10,'2022-07-28','2022-07-29'),
(71,54,10,'2022-07-29','2022-07-29'),
(72,50,9,'2022-07-28','2022-07-29'),
(73,51,10,'2022-07-28','2022-07-29'),
(74,50,1,'2022-07-28','2022-07-29'),
(75,50,1,'2022-07-27','2022-07-28'),
(76,50,1,'2022-07-29','2022-07-30'),
(77,52,1,'2022-07-29','2022-07-30'),
(79,52,1,'2022-07-29','2022-07-31'),
(80,58,1,'2022-07-29','2022-07-30'),
(81,57,1,'2022-07-29','2022-07-30'),
(82,55,1,'2022-07-29','2022-07-30'),
(83,55,1,'2022-07-29','2022-07-30'),
(84,50,1,'2022-07-29','2022-07-29'),
(86,52,1,'2022-07-30','2022-08-03'),
(88,52,3,'2022-07-30','2022-10-01');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
