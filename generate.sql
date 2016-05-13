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


