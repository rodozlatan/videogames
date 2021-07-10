CREATE DATABASE /*!32312 IF NOT EXISTS*/`videogames`;

USE `videogames`;

/*Table structure for table `videogames` */

DROP TABLE IF EXISTS `videogames`;

CREATE TABLE `videogames` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `publisher` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `nickname` varchar(150) COLLATE utf8mb4_bin DEFAULT NULL,
  `rating` enum('Favorite','Meh','Dislike') COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `PUB_NAME_INDEX` (`publisher`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;