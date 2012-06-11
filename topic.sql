-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 06 月 11 日 07:21
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `topic`
--

-- --------------------------------------------------------

--
-- 表的结构 `ad`
--

CREATE TABLE IF NOT EXISTS `ad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `banner` text NOT NULL,
  `post_time` datetime NOT NULL,
  `count` int(10) NOT NULL DEFAULT '0',
  `name` char(16) NOT NULL,
  `author` char(50) NOT NULL,
  `editor` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tid` int(10) NOT NULL,
  `title` text NOT NULL,
  `topicbanner` text NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `post_time` datetime NOT NULL,
  `count` int(10) NOT NULL DEFAULT '0',
  `name` char(16) NOT NULL,
  `author` char(50) NOT NULL,
  `editor` char(50) CHARACTER SET ucs2 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- 表的结构 `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `topicbanner` text NOT NULL,
  `description` longtext NOT NULL,
  `comments` longtext NOT NULL,
  `votetitle` text NOT NULL,
  `op1` char(20) NOT NULL,
  `op2` char(20) NOT NULL,
  `op3` char(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `post_time` datetime NOT NULL,
  `count` int(10) NOT NULL DEFAULT '0',
  `name` char(16) NOT NULL,
  `author` char(50) NOT NULL,
  `editor` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(16) NOT NULL,
  `editname` char(32) NOT NULL,
  `realname` char(16) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registerTime` datetime NOT NULL,
  `ip` char(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `editname`, `realname`, `password`, `email`, `registerTime`, `ip`, `status`) VALUES
(1, 'admin', 'Rming', '王守谦', '21232f297a57a5a743894a0e4a801fc3', 'r.ming@qq.com', '2012-03-31 00:00:00', '127.0.0.1', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
