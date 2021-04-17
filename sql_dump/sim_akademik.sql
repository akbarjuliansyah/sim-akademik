/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - sim_akademik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sim_akademik` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sim_akademik`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

/*Table structure for table `class_details` */

DROP TABLE IF EXISTS `class_details`;

CREATE TABLE `class_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `class_id` bigint(20) DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `class_details_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `class_details_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `class_details` */

insert  into `class_details`(`id`,`class_id`,`student_id`,`created_at`,`updated_at`) values 
(6,16,24,'2021-04-17 06:58:19','2021-04-17 06:58:19'),
(9,12,22,'2021-04-17 08:28:58','2021-04-17 08:28:58'),
(10,12,25,'2021-04-17 08:28:58','2021-04-17 08:28:58');

/*Table structure for table `classes` */

DROP TABLE IF EXISTS `classes`;

CREATE TABLE `classes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `teacher_id` bigint(20) NOT NULL,
  `grade` enum('10','11','12') DEFAULT NULL,
  `majors` enum('IPA','IPS') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `classes` */

insert  into `classes`(`id`,`name`,`course_id`,`teacher_id`,`grade`,`majors`,`created_at`,`updated_at`) values 
(12,'Biologi C',22,12,'10','IPA','2021-04-17 06:19:12','2021-04-17 08:28:58'),
(16,'Sejarah A',27,12,'12','IPS','2021-04-17 06:58:19','2021-04-17 06:58:19');

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `majors` enum('IPA','IPS') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `courses` */

insert  into `courses`(`id`,`name`,`majors`,`created_at`,`updated_at`) values 
(22,'Biologi','IPA',NULL,NULL),
(23,'Sosiologi','IPS',NULL,NULL),
(24,'Kimia','IPA','2021-04-17 06:48:23','2021-04-17 06:48:23'),
(25,'Fisika','IPA','2021-04-17 06:48:51','2021-04-17 06:48:51'),
(26,'Bahasa Jerman','IPS','2021-04-17 06:56:49','2021-04-17 06:56:49'),
(27,'Sejarah','IPS','2021-04-17 06:57:02','2021-04-17 06:57:02');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_04_15_140154_create_admins_table',2);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nisn` bigint(10) NOT NULL,
  `grade` enum('10','11','12') NOT NULL,
  `majors` enum('IPA','IPS') NOT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `students` */

insert  into `students`(`id`,`name`,`nisn`,`grade`,`majors`,`gender`,`birthdate`,`created_at`,`updated_at`) values 
(22,'Nouval Rizky Akbar Juliansyah',413577812,'12','IPA','L','2001-07-04',NULL,NULL),
(23,'Agus Putrawan',9826667281,'12','IPA','L','2000-08-24','2021-04-17 06:19:49','2021-04-17 06:19:49'),
(24,'Juniadi',1203456789,'10','IPA','L','2000-09-12','2021-04-17 06:33:56','2021-04-17 06:33:56'),
(25,'Yuli Kharisma Putri',8261890333,'12','IPS','P','2001-12-08','2021-04-17 06:59:03','2021-04-17 07:00:15'),
(27,'Asep Andika',1203456733,'12','IPS','L','2002-07-08','2021-04-17 07:00:40','2021-04-17 07:00:40');

/*Table structure for table `teachers` */

DROP TABLE IF EXISTS `teachers`;

CREATE TABLE `teachers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `courses_id` bigint(20) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `courses_id` (`courses_id`),
  CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `teachers` */

insert  into `teachers`(`id`,`name`,`nip`,`courses_id`,`gender`,`created_at`,`updated_at`) values 
(10,'Komang Priyadi','2230399122',22,'L','2021-04-17 14:17:18','0000-00-00 00:00:00'),
(11,'Desak Made','434233244',23,'L','2021-04-17 06:40:54','2021-04-17 06:40:54'),
(12,'Dimas Anugrah','312313123',22,'L','2021-04-17 06:41:16','2021-04-17 06:41:16');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
