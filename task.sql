/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : bjtest

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2021-11-23 00:14:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `task_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_username` varchar(255) NOT NULL DEFAULT '',
  `task_email` varchar(255) NOT NULL DEFAULT '',
  `task_text` text,
  `task_status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `task_edited` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of task
-- ----------------------------
