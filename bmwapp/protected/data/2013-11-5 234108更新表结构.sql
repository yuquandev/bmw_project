/*
SQLyog v10.2 
MySQL - 5.5.25a : Database - bmw_cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bmw_cms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bmw_cms`;

/*Table structure for table `admin_tbl` */

DROP TABLE IF EXISTS `admin_tbl`;

CREATE TABLE `admin_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(32) NOT NULL COMMENT '管理员',
  `password` char(32) NOT NULL COMMENT '密码',
  `salt` smallint(6) NOT NULL COMMENT '盐',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(1) DEFAULT '0' COMMENT '0开启，1禁用',
  `ip` char(15) DEFAULT NULL COMMENT 'IP地址',
  `last_login` datetime DEFAULT NULL COMMENT '登录时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

/*Table structure for table `banner_tbl` */

DROP TABLE IF EXISTS `banner_tbl`;

CREATE TABLE `banner_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一标示',
  `topic_id` smallint(6) NOT NULL COMMENT '栏目ID',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `image_url` varchar(256) NOT NULL COMMENT '图片地址',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0开启1关闭',
  `sort_int` smallint(6) DEFAULT NULL COMMENT '排序字段',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='banner表';

/*Table structure for table `topic_tbl` */

DROP TABLE IF EXISTS `topic_tbl`;

CREATE TABLE `topic_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0开启，1关闭',
  `update_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

/*Table structure for table `user_tbl` */

DROP TABLE IF EXISTS `user_tbl`;

CREATE TABLE `user_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户唯一标示',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `password` char(32) NOT NULL COMMENT '密码',
  `salt` smallint(6) NOT NULL COMMENT '盐',
  `telephone` char(11) DEFAULT NULL COMMENT '手机号',
  `ip` char(15) NOT NULL COMMENT 'IP地址',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0开启，1禁用',
  `last_login` datetime DEFAULT NULL COMMENT '最后登录',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

/*Table structure for table `vote_log_tbl` */

DROP TABLE IF EXISTS `vote_log_tbl`;

CREATE TABLE `vote_log_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `work_id` int(11) NOT NULL COMMENT '作品ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '投票用户，默认0',
  `ip` char(15) NOT NULL COMMENT 'ip限制',
  `create_time` datetime DEFAULT NULL COMMENT '投票时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票日志';

/*Table structure for table `work_img_tbl` */

DROP TABLE IF EXISTS `work_img_tbl`;

CREATE TABLE `work_img_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片ID',
  `work_id` int(11) NOT NULL COMMENT '作品ID',
  `name` varchar(50) DEFAULT NULL COMMENT '图片名称',
  `description` varchar(200) DEFAULT NULL COMMENT '图片描述',
  `image_url` varchar(256) NOT NULL COMMENT '图片url',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0启用1关闭',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='作品图片表';

/*Table structure for table `works_tbl` */

DROP TABLE IF EXISTS `works_tbl`;

CREATE TABLE `works_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '作品id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(50) DEFAULT NULL COMMENT '作品名称',
  `description` varchar(200) DEFAULT NULL COMMENT '作品描述',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0启用 1关闭',
  `review` tinyint(1) DEFAULT '1' COMMENT '0审核通过 1审核不通过',
  `recommend` tinyint(4) DEFAULT '1' COMMENT '0 推荐 1不推荐',
  `vote_num` int(11) DEFAULT NULL COMMENT '作品投票数',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户作品';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
