# Host: localhost  (Version 5.5.5-10.4.13-MariaDB)
# Date: 2020-07-17 08:41:28
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "acos"
#

DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "acos"
#

INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'Produtos',1,2),(2,NULL,NULL,NULL,'Pedidos',3,4),(3,NULL,NULL,NULL,'Clientes',5,6),(4,NULL,NULL,NULL,'PedidosProdutos',7,8),(5,NULL,NULL,NULL,'Pedidos_Produtos',9,10),(6,NULL,NULL,NULL,'Items',11,12);

#
# Structure for table "aros"
#

DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "aros"
#

INSERT INTO `aros` VALUES (1,NULL,NULL,NULL,'Administrador',1,4),(2,NULL,NULL,NULL,'Cliente',5,8),(3,1,'Cliente',8,NULL,2,3),(4,2,'Cliente',9,NULL,6,7);

#
# Structure for table "aros_acos"
#

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `idx_aco_id` (`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Data for table "aros_acos"
#

INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,1,2,'1','1','1','1'),(3,1,4,'1','1','1','1'),(4,1,3,'1','1','1','1'),(5,1,5,'1','1','1','1'),(6,1,6,'1','1','1','1'),(7,2,2,'1','1','1','1'),(8,2,1,'1','1','1','1'),(9,2,6,'1','1','1','1');

#
# Structure for table "clientes"
#

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` int(5) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(400) DEFAULT NULL,
  `aro_parent_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Data for table "clientes"
#

INSERT INTO `clientes` VALUES (8,'Dayane','31 de Março',25,'17510393','17964546784','d@d.com.br','7f55439cc63c0e0d294f239a35ffa92e7d1244ffb94c41258089c901615c1057',1,'2020-07-16 18:30:23','2020-07-16 18:30:23',NULL),(9,'Camila','Alcides Lajes',46,'17512547','1498754258','c@c.com.br','7f55439cc63c0e0d294f239a35ffa92e7d1244ffb94c41258089c901615c1057',2,'2020-07-16 18:33:49','2020-07-16 18:33:49',NULL);

#
# Structure for table "pedidos"
#

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

#
# Data for table "pedidos"
#

INSERT INTO `pedidos` VALUES (30,8,'61','Pronto','2020-07-16 23:09:29','2020-07-17 12:56:44',NULL),(31,8,'43.9','Confirmado','2020-07-16 23:09:29','2020-07-17 12:55:59',NULL),(32,8,'105.5','Confirmado','2020-07-16 23:09:29','2020-07-17 00:45:08',NULL),(34,8,'41.7','Pronto','2020-07-16 23:09:29','2020-07-16 23:10:17',NULL),(35,8,'15.5','Aguardando','2020-07-16 23:09:29','2020-07-16 23:10:17',NULL),(36,8,'4','Confirmado','2020-07-16 23:09:29','2020-07-16 23:10:17',NULL),(37,8,'15.5','Pronto','2020-07-16 23:09:29','2020-07-16 23:10:17',NULL),(38,8,'29.4','Aguardando','2020-07-16 23:42:45','2020-07-17 00:23:13',NULL),(39,8,'49.8','Preparando','2020-07-17 00:28:35','2020-07-17 00:31:40',NULL),(40,8,'43.3','Aguardando','2020-07-17 00:31:56','2020-07-17 00:32:07',NULL),(41,8,'29.4','Pronto','2020-07-17 00:34:28','2020-07-17 00:34:59',NULL),(42,8,'29.4','Aguardando','2020-07-17 00:35:52','2020-07-17 00:36:05',NULL),(43,8,'45.5','Pronto','2020-07-17 00:41:40','2020-07-17 00:49:36',NULL),(44,9,'45.5','Aguardando','2020-07-17 01:04:36','2020-07-17 01:04:55',NULL),(45,9,'4','Aguardando','2020-07-17 12:00:13','2020-07-17 12:01:19',NULL),(46,NULL,NULL,'Confirmado','2020-07-17 12:55:01','2020-07-17 12:55:01',NULL),(47,NULL,NULL,'Confirmado','2020-07-17 12:55:14','2020-07-17 12:55:14',NULL),(48,9,NULL,NULL,'2020-07-17 13:13:28','2020-07-17 13:13:28',NULL),(49,9,'29.4','Aguardando','2020-07-17 13:15:50','2020-07-17 13:18:05',NULL);

#
# Structure for table "produtos"
#

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `preco` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#
# Data for table "produtos"
#

INSERT INTO `produtos` VALUES (1,'X-burguer Salada','Hamburguer','Hamburguer artesanal de 150g, queijo, tomate, alface, molho especial da casa','chesseBurguer.jpg','15.50','2020-07-16 13:38:45','2020-07-16 13:38:45',NULL),(2,'X-frango','Hamburguer','Hamburguer de Frango, queijio, alface e molho especial','x-frango.jpg','13.90','2020-07-16 13:44:34','2020-07-16 13:44:34',NULL),(3,'Coca Cola','Bebida','Coca cola lata 350ml','caoca.jpg','4.00','2020-07-16 13:46:46','2020-07-16 13:46:46',NULL),(4,'Fanta','Bebida','Fanta lata 350ml','fanta.jpg','4.00','2020-07-16 13:47:09','2020-07-16 13:47:09',NULL),(5,'Petit Gateau','Sobremesa','Delicioso bolho de chocolate com sorvete de creme da casa','petit gateau.jpeg','15.00','2020-07-16 13:47:39','2020-07-16 13:47:39',NULL),(6,'Batata Frita','Acompanhamento','Porção de batata frita 500g, serve duas pessoal muito bem','porcao de batata.jpg','22.00','2020-07-16 13:48:40','2020-07-16 13:48:40',NULL),(7,'Frango frito','Acompanhamento','Porção de frango frito com batata 500g, serve duas pessoas','porcao de frango.jpg','30.00','2020-07-16 13:49:42','2020-07-16 13:49:42',NULL);

#
# Structure for table "items"
#

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_id_fk` (`pedido_id`),
  KEY `produto_id_fk` (`produto_id`),
  CONSTRAINT `pedidos_id_fk` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produto_id_fk` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

#
# Data for table "items"
#

INSERT INTO `items` VALUES (4,30,6,NULL,'2020-07-16 21:44:57','2020-07-16 21:44:57'),(5,30,6,NULL,'2020-07-17 12:41:02','2020-07-17 12:41:02'),(6,30,1,NULL,'2020-07-16 21:44:53','2020-07-16 21:44:53'),(7,30,2,'2020-07-16 21:49:32','2020-07-17 00:34:13','2020-07-17 00:34:13'),(8,30,3,'2020-07-16 21:49:35','2020-07-17 00:34:06','2020-07-17 00:34:06'),(9,30,4,'2020-07-16 21:49:37','2020-07-17 00:32:14','2020-07-17 00:32:14'),(10,31,2,'2020-07-16 22:29:03','2020-07-16 22:29:03',NULL),(11,31,7,'2020-07-16 22:29:27','2020-07-16 22:29:27',NULL),(12,31,4,'2020-07-16 22:29:30','2020-07-17 00:43:33','2020-07-17 00:43:33'),(13,32,1,'2020-07-16 22:32:16','2020-07-17 00:36:10','2020-07-17 00:36:10'),(14,32,7,'2020-07-16 22:32:18','2020-07-16 22:32:18',NULL),(15,32,7,'2020-07-16 22:32:20','2020-07-16 22:32:20',NULL),(17,34,2,'2020-07-16 22:49:59','2020-07-16 22:49:59',NULL),(18,34,2,'2020-07-16 22:50:05','2020-07-16 22:50:05',NULL),(19,34,2,'2020-07-16 22:50:08','2020-07-16 22:50:08',NULL),(20,35,1,'2020-07-16 22:51:04','2020-07-16 22:51:04',NULL),(21,36,4,'2020-07-16 22:52:18','2020-07-16 22:52:18',NULL),(22,37,1,'2020-07-16 23:09:29','2020-07-16 23:09:29',NULL),(23,38,1,'2020-07-16 23:42:46','2020-07-16 23:42:46',NULL),(24,38,2,'2020-07-17 00:22:53','2020-07-17 00:22:58','2020-07-17 00:22:58'),(25,38,2,'2020-07-17 00:23:04','2020-07-17 00:23:04',NULL),(26,39,2,'2020-07-17 00:28:35','2020-07-17 00:28:35',NULL),(27,39,2,'2020-07-17 00:29:37','2020-07-17 00:29:37',NULL),(28,39,6,'2020-07-17 00:29:39','2020-07-17 00:35:37','2020-07-17 00:35:37'),(29,40,1,'2020-07-17 00:31:56','2020-07-17 00:31:56',NULL),(30,40,2,'2020-07-17 00:31:58','2020-07-17 00:31:58',NULL),(31,40,2,'2020-07-17 00:32:00','2020-07-17 00:32:00',NULL),(32,41,1,'2020-07-17 00:34:28','2020-07-17 00:34:28',NULL),(33,41,6,'2020-07-17 00:34:29','2020-07-17 00:34:34','2020-07-17 00:34:34'),(34,41,3,'2020-07-17 00:34:32','2020-07-17 00:34:47','2020-07-17 00:34:47'),(35,41,2,'2020-07-17 00:34:52','2020-07-17 00:42:02','2020-07-17 00:42:02'),(36,42,1,'2020-07-17 00:35:53','2020-07-17 00:36:00','2020-07-17 00:36:00'),(37,42,1,'2020-07-17 00:35:54','2020-07-17 00:35:54',NULL),(38,42,2,'2020-07-17 00:35:56','2020-07-17 00:35:56',NULL),(39,43,1,'2020-07-17 00:41:40','2020-07-17 00:41:49','2020-07-17 00:41:49'),(40,43,2,'2020-07-17 00:41:42','2020-07-17 00:41:47','2020-07-17 00:41:47'),(41,43,7,'2020-07-17 00:41:43','2020-07-17 00:41:43',NULL),(42,30,1,'2020-07-17 00:43:52','2020-07-17 02:10:03','2020-07-17 02:10:03'),(43,30,2,'2020-07-17 00:43:54','2020-07-17 00:43:59','2020-07-17 00:43:59'),(44,32,2,'2020-07-17 00:44:13','2020-07-17 00:44:17','2020-07-17 00:44:17'),(45,32,7,'2020-07-17 00:44:57','2020-07-17 00:44:57',NULL),(46,32,1,'2020-07-17 00:45:04','2020-07-17 00:45:04',NULL),(47,43,1,'2020-07-17 00:48:06','2020-07-17 00:48:06',NULL),(48,44,1,'2020-07-17 01:04:36','2020-07-17 01:04:36',NULL),(49,44,7,'2020-07-17 01:04:50','2020-07-17 01:04:50',NULL),(50,30,1,'2020-07-17 02:11:08','2020-07-17 02:11:08',NULL),(51,30,3,'2020-07-17 02:11:10','2020-07-17 02:12:01','2020-07-17 02:12:01'),(52,45,3,'2020-07-17 12:00:13','2020-07-17 12:00:13',NULL),(53,45,3,'2020-07-17 12:00:21','2020-07-17 12:00:25','2020-07-17 12:00:25'),(54,45,5,'2020-07-17 12:00:30','2020-07-17 12:01:17','2020-07-17 12:01:17'),(55,30,7,'2020-07-17 12:41:07','2020-07-17 12:41:07',NULL),(56,30,1,'2020-07-17 12:41:09','2020-07-17 12:41:09',NULL),(57,48,1,'2020-07-17 13:13:28','2020-07-17 13:13:28',NULL),(58,49,1,'2020-07-17 13:15:50','2020-07-17 13:15:50',NULL),(59,49,2,'2020-07-17 13:15:53','2020-07-17 13:15:53',NULL);
