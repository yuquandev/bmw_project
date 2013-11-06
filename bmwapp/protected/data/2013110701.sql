-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013-11-07 01:50:42
-- 服务器版本: 5.5.30
-- PHP 版本: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `bmw_cms`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_tbl`
--

CREATE TABLE IF NOT EXISTS `admin_tbl` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `username`, `password`, `salt`, `email`, `status`, `ip`, `last_login`, `update_time`, `create_time`) VALUES
(1, 'admin', 'e00cf25ad42683b3df678c61f42c6bda', 1, 'admin', 0, '127.0.0.1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `banner_tbl`
--

CREATE TABLE IF NOT EXISTS `banner_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一标示',
  `topic_id` smallint(6) NOT NULL COMMENT '栏目ID',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `image_url` varchar(256) NOT NULL COMMENT '图片地址',
  `type` tinyint(4) NOT NULL COMMENT '1图片，2视频',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0开启1关闭',
  `sort_int` smallint(6) DEFAULT NULL COMMENT '排序字段',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='banner表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `topic_tbl`
--

CREATE TABLE IF NOT EXISTS `topic_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `type` tinyint(1) NOT NULL COMMENT '1为x1，2为3系，3为5系',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0开启，1关闭',
  `update_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='栏目表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `topic_tbl`
--

INSERT INTO `topic_tbl` (`id`, `name`, `description`, `type`, `status`, `update_time`, `create_time`) VALUES
(1, '活动介绍', '', 1, 0, NULL, NULL),
(3, '活动规则', '活动规则', 1, 0, '2013-11-07 00:00:00', '2013-11-07 00:00:00'),
(4, '视频', '视频', 1, 0, '2013-11-07 00:00:00', '2013-11-07 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `user_tbl`
--

CREATE TABLE IF NOT EXISTS `user_tbl` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `username`, `nickname`, `password`, `salt`, `telephone`, `ip`, `status`, `last_login`, `update_time`, `create_time`) VALUES
(1, 'test001', 'test001', 'test001', 6, '12345678901', '127.0.0.1', 0, '2013-11-06 00:00:00', '2013-11-06 00:00:00', '2013-11-06 00:00:00'),
(2, 'test001', 'test001', 'test001', 6, '12345678901', '127.0.0.1', 0, '2013-11-06 00:00:00', '2013-11-06 00:00:00', '2013-11-06 00:00:00'),
(3, 'zhaoquan', 'zhaoquan', '9ea127a0e971afaf39808b9118a3c760', 21101, '12345678901', '127.0.0.1', 0, NULL, NULL, '2013-11-06 20:48:42'),
(4, 'zhaoquan1', 'zhaoquan1', 'ac15cf8353303de35cf67456fed5675c', 12820, '12345678901', '127.0.0.1', 0, NULL, NULL, '2013-11-06 20:53:33'),
(5, 'zhaoquan2', 'zhaoquan2', 'af68a30fb23ff2abf1b942d14749b8c2', 26864, '12345678901', '127.0.0.1', 0, NULL, NULL, '2013-11-06 20:57:45'),
(6, 'zhaoquan3', 'zhaoquan3', '72c159c091b11e9473612807381ed2c4', 1665, '12345678901', '127.0.0.1', 0, NULL, NULL, '2013-11-06 20:59:46');

-- --------------------------------------------------------

--
-- 表的结构 `vote_log_tbl`
--

CREATE TABLE IF NOT EXISTS `vote_log_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `work_id` int(11) NOT NULL COMMENT '作品ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '投票用户，默认0',
  `ip` char(15) NOT NULL COMMENT 'ip限制',
  `create_time` datetime DEFAULT NULL COMMENT '投票时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票日志' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `works_tbl`
--

CREATE TABLE IF NOT EXISTS `works_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '作品id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(50) DEFAULT NULL COMMENT '作品名称',
  `img_url` varchar(255) NOT NULL COMMENT '图片路径',
  `description` varchar(200) DEFAULT NULL COMMENT '作品描述',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0启用1关闭',
  `review` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0审核通过 1审核不通过',
  `recommend` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 推荐 1不推荐',
  `vote_num` int(11) DEFAULT NULL COMMENT '作品投票数',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户作品' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `work_img_tbl`
--

CREATE TABLE IF NOT EXISTS `work_img_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片ID',
  `work_id` int(11) NOT NULL COMMENT '作品ID',
  `name` varchar(50) DEFAULT NULL COMMENT '图片名称',
  `description` varchar(200) DEFAULT NULL COMMENT '图片描述',
  `image_url` varchar(256) NOT NULL COMMENT '图片url',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0启用1关闭',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='作品图片表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;