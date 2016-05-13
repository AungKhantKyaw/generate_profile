-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: custsql-ipg115.eigbox.net
-- Generation Time: May 12, 2016 at 10:27 PM
-- Server version: 5.5.44
-- PHP Version: 4.4.9
-- 
-- Database: `generate`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admin_user`
-- 

CREATE TABLE IF NOT EXISTS `admin_user` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(60) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `currency_config`
-- 

CREATE TABLE IF NOT EXISTS `currency_config` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `symbol` varchar(80) NOT NULL,
  `img_file` varchar(300) NOT NULL,
  `displays` tinyint(4) NOT NULL DEFAULT '99',
  `decimal_no` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `currency_post`
-- 

CREATE TABLE IF NOT EXISTS `currency_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `rate` decimal(20,4) NOT NULL,
  `location` text NOT NULL,
  `address` varchar(500) NOT NULL,
  `post_date` int(11) NOT NULL,
  `post_by` int(11) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `is_status` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `act_code` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `is_activate` tinyint(4) NOT NULL DEFAULT '0',
  `is_facebook` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2275 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2275 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `user_address`
-- 

CREATE TABLE IF NOT EXISTS `user_address` (
  `uaddress_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `uaddress` varchar(500) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uaddress_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
