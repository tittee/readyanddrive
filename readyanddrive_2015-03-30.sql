# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: readyanddrive
# Generation Time: 2015-03-30 03:26:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table award
# ------------------------------------------------------------

DROP TABLE IF EXISTS `award`;

CREATE TABLE `award` (
    `award_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `award_product` tinyint(5) DEFAULT NULL COMMENT 'เก็บเป็น int ไปไปโปรแกรมต่อเอง',
    `member_id` int(10) DEFAULT NULL,
    `award_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `award_description` text,
    `award_order` int(5) DEFAULT NULL,
    PRIMARY KEY (`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fan_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fan_page`;

CREATE TABLE `fan_page` (
    `fan_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `fanpage_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    `member_fb_id` varchar(100) DEFAULT NULL,
    PRIMARY KEY (`fan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
    `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `member_fb_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    `member_email` varchar(50) DEFAULT NULL,
    `member_fname` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    `member_lname` varchar(20) DEFAULT NULL,
    `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `member_gender` enum('1','0') DEFAULT '0' COMMENT '0 = male / 1 = female',
    `member_province` int(2) DEFAULT NULL,
    `member_mobileno` varchar(15) DEFAULT NULL,
    `member_create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `member_update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `member_backlist` enum('0','1') DEFAULT '0' COMMENT '0 = backlist / 1 = un backlist',
    `member_order` int(10) DEFAULT NULL,
    PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table playgame
# ------------------------------------------------------------

DROP TABLE IF EXISTS `playgame`;

CREATE TABLE `playgame` (
    `play_id` int(15) unsigned NOT NULL AUTO_INCREMENT,
    `member_id` int(10) DEFAULT NULL,
    `store_id` int(2) DEFAULT NULL,
    `store_other` varchar(50) DEFAULT NULL COMMENT 'ร้นอื่นๆ ที่ไม่มีการกรอก',
    `play_bill` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รหัสใบเสร็จ',
    `play_ready_color` smallint(5) DEFAULT NULL COMMENT 'รสชาติน้ำ',
    `play_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `createdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `play_order` int(15) DEFAULT NULL,
    PRIMARY KEY (`play_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table playrule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `playrule`;

CREATE TABLE `playrule` (
    `rule_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `rule_play` int(5) DEFAULT NULL COMMENT 'จำนวนรอบให้เล่น ปกติคือ 1',
    `rule_startdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `rule_enddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `rule_createdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `rule_updatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `rule_order` int(5) DEFAULT NULL,
    PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='กฏการเล่นเกมส์';

LOCK TABLES `playrule` WRITE;
/*!40000 ALTER TABLE `playrule` DISABLE KEYS */;

INSERT INTO `playrule` (`rule_id`, `rule_play`, `rule_startdate`, `rule_enddate`, `rule_createdate`, `rule_updatedate`, `rule_order`)
VALUES
(1,2,'2015-03-31 00:00:00','2015-03-31 00:00:00','2015-03-28 01:50:57','2015-03-28 01:50:57',1);

/*!40000 ALTER TABLE `playrule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table province
# ------------------------------------------------------------

DROP TABLE IF EXISTS `province`;

CREATE TABLE `province` (
    `province_id` int(4) NOT NULL AUTO_INCREMENT,
    `province_order` int(4) NOT NULL,
    `region_id` int(10) DEFAULT NULL,
    `province_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `province_name_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`province_id`),
    KEY `province_region_FK` (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='จังหวัด';

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;

INSERT INTO `province` (`province_id`, `province_order`, `region_id`, `province_name`, `province_name_en`)
VALUES
(1,1,5,'กระบี่','Krabi'),
(2,2,6,'กรุงเทพมหานคร','Bangkok'),
(3,3,3,'กาญจนบุรี','Kanchanaburi'),
(4,4,2,'กาฬสินธุ์','Kalasin'),
(5,5,1,'กำแพงเพชร','Kamphaeng Phet'),
(6,6,2,'ขอนแก่น','Khon Kaen'),
(7,7,4,'จันทบุรี','Chantaburi'),
(8,8,4,'ฉะเชิงเทรา','Chachoengsao'),
(9,8,4,'ชลบุรี','Chonburi'),
(10,9,6,'ชัยนาท','Cholburi'),
(11,10,2,'ชัยภูมิ','Chaiyaphum'),
(12,12,5,'ชุมพร','Chumporn'),
(13,13,1,'เชียงราย','Chiang Rai'),
(14,14,1,'เชียงใหม่','Chiang Mai'),
(15,15,5,'ตรัง','Trang'),
(16,16,4,'ตราด','Trat'),
(17,17,3,'ตาก','Tak'),
(18,18,6,'นครนายก','Nakhonnayok'),
(19,19,6,'นครปฐม','Nakhonpathom'),
(20,20,2,'นครพนม','Naknon Phanom'),
(21,21,2,'นครราชสีมา','Nakhon Ratchasima'),
(22,22,5,'นครศรีธรรมราช','Nakhonsi Thammarat'),
(23,23,1,'นครสวรรค์','Nakhonsawan'),
(24,24,6,'นนทบุรี','Nonthaburi'),
(25,25,5,'นราธิวาส','Narathiwat'),
(26,26,1,'น่าน','Nan'),
(27,27,2,'บุรีรัมย์','Buriram'),
(28,28,6,'ปทุมธานี','Pathumthani'),
(29,29,3,'ประจวบคีรีขันธ์','Prachuapkhirikhan'),
(30,30,4,'ปราจีนบุรี','Prachinburi'),
(31,31,5,'ปัตตานี','Pattani'),
(32,32,6,'พระนครศรีอยุธยา','Ayuthaya'),
(33,33,1,'พะเยา','Phayao'),
(34,34,5,'พังงา','Phang Nga'),
(35,35,5,'พัทลุง','Phatthalung'),
(36,36,1,'พิจิตร','Phichit'),
(37,37,1,'พิษณุโลก','Phitsanulok'),
(38,38,3,'เพชรบุรี','Phetchaburi'),
(39,39,1,'เพชรบูรณ์','Phetchabun'),
(40,40,1,'แพร่','Phrae'),
(41,41,5,'ภูเก็ต','Phuket'),
(42,42,2,'มหาสารคาม','Maha Sarakham'),
(43,43,2,'มุกดาหาร','Mukdaharn'),
(44,44,1,'แม่ฮ่องสอน','Mae Hong Son'),
(45,45,2,'ยโสธร','Yasothon'),
(46,46,5,'ยะลา','Yala'),
(47,47,2,'ร้อยเอ็ด','Roi Et'),
(48,48,5,'ระนอง','Ranong'),
(49,49,4,'ระยอง','Rayong'),
(50,50,3,'ราชบุรี','Ratchaburi'),
(51,51,6,'ลพบุรี','Lopburi'),
(52,52,1,'ลำปาง','Lamphang'),
(53,53,1,'ลำพูน','Lamphun'),
(54,54,2,'เลย','Loei'),
(55,55,2,'ศรีสะเกษ','Si Saket'),
(56,56,2,'สกลนคร','Sakon Nakhon'),
(57,57,5,'สงขลา','Songkhla'),
(58,58,5,'สตูล','Satun'),
(59,59,6,'สมุทรปราการ','Samutprakan'),
(60,60,6,'สมุทรสงคราม','Samut Songkhram'),
(61,61,6,'สมุทรสาคร','Samut Sakhon'),
(62,62,4,'สระแก้ว','Sakaeo'),
(63,63,6,'สระบุรี','Saraburi'),
(64,64,6,'สิงห์บุรี','Singburi'),
(65,65,1,'สุโขทัย','Sukhothai'),
(66,66,6,'สุพรรณบุรี','Suphanburi'),
(67,67,5,'สุราษฎร์ธานี','Suratthani'),
(68,68,2,'สุรินทร์','Surin'),
(69,69,2,'หนองคาย','Nong Khai'),
(70,70,2,'หนองบัวลำภู','Nong Bua Lamphu'),
(71,71,6,'อ่างทอง','Ang Thong'),
(72,72,2,'อำนาจเจริญ','Amnat Charoen'),
(73,73,2,'อุดรธานี','Udon Thani'),
(74,74,1,'อุตรดิตถ์','Uttaradit'),
(75,75,1,'อุทัยธานี','Uthaithani'),
(76,76,2,'อุบลราชธานี','Ubon Ratchathani');

/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table report
# ------------------------------------------------------------

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
    `report_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `member_id` int(10) DEFAULT NULL,
    `store_id` int(2) DEFAULT NULL,
    `play_id` int(15) DEFAULT NULL,
    `createdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
    `staff_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
    `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `group_id` mediumint(8) unsigned NOT NULL DEFAULT '2' COMMENT '1=Admin, 2=Staff',
    `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `UpdateDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `CreateDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;

INSERT INTO `staff` (`staff_id`, `username`, `password`, `email`, `status`, `name`, `group_id`, `lastlogin`, `UpdateDate`, `CreateDate`)
VALUES
(1,'webmaster','8da7144cd98787ec0d953a61f05c54f7','webmaster@zoftwin.com','1','WebMaster',88,'2015-03-27 22:35:40','0000-00-00 00:00:00','2009-02-11 10:47:15'),
(2,'acmebell','d0970714757783e6cf17b26fb8e2298f','supawan_s4@yahoo.com','1','acmebell',1,'2015-02-11 15:02:37','2014-12-12 12:40:26','2013-02-20 13:13:46'),
(3,'veesupawan','cfbb73c5258a425bdbfec05acc9191db','supawan_s4@yahoo.com','1','vee',1,'0000-00-00 00:00:00','2014-12-12 12:39:17','2014-10-11 15:23:07');

/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table store
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
    `store_id` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'รหัสร้านค้า',
    `store_name` varchar(20) DEFAULT NULL,
    `store_primary_img` varchar(100) DEFAULT NULL,
    `store_bill` int(15) DEFAULT NULL COMMENT 'อันนี้ จะไว้ตรวจสอบ',
    `store_bill_description` varchar(255) DEFAULT NULL,
    `createdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `store_order` int(2) DEFAULT NULL,
    PRIMARY KEY (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;

INSERT INTO `store` (`store_id`, `store_name`, `store_primary_img`, `store_bill`, `store_bill_description`, `createdate`, `updatedate`, `store_order`)
VALUES
(1,'TESCO LOTUS','20150328005244Q85H.png',16,'ตัวเลข 16 หลัก \r\nตัวอย่างตำแหน่งเลขที่ใบเสร็จของ Tesco Lotus (เลขชุดสุดท้ายที่ต่อจากวันที่และเวลา)','2015-03-28 00:52:44','2015-03-28 01:07:44',1),
(2,'BIG C','20150328010812cVYk.png',9,'ตัวเลข 9 หลัก\r\nRcpt#ตามด้วยเลขที่ใบเสร็จ9หลัก Update 18 Mar.','2015-03-28 01:08:12','2015-03-28 01:08:16',2),
(3,'Mini BIG C','20150328010902iGjy.png',9,'ตัวเลข 9 หลัก \r\nRcpt#ตามด้วยเลขที่ใบเสร็จ9หลัก\r\nUpdate 18 Mar.','2015-03-28 01:09:02','2015-03-28 01:09:02',3),
(4,'TOPS MARKET','20150328011004qQnX.png',6,'ตัวเลข 6 หลัก\r\nUpdate 18 Mar.','2015-03-28 01:10:04','2015-03-28 01:10:04',4);

/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usercolor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usercolor`;

CREATE TABLE `usercolor` (
    `usercolor_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `sess_id` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    `play_ready_color` smallint(5) DEFAULT NULL,
    PRIMARY KEY (`usercolor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usercolor` WRITE;
/*!40000 ALTER TABLE `usercolor` DISABLE KEYS */;

INSERT INTO `usercolor` (`usercolor_id`, `sess_id`, `play_ready_color`)
VALUES
(1,'64a6d98d61419f5a40d5eb66477f66f2',1);

/*!40000 ALTER TABLE `usercolor` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
