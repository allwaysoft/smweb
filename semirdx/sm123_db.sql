# SQL Manager 2007 for MySQL 4.3.4.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : sm123_db


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `sm123_db`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `sm123_db`;

#
# Structure for the `ag_homepage` table : 
#

CREATE TABLE `ag_homepage` (
  `hId` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `hType` INTEGER(11) DEFAULT '1',
  `hTitle` VARCHAR(110) COLLATE utf8_general_ci DEFAULT NULL,
  `hContents` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `hPic` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `hUrl` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `hSort` INTEGER(11) DEFAULT '1',
  `post_time` DATETIME DEFAULT NULL,
  PRIMARY KEY (`hId`)
)ENGINE=MyISAM
AUTO_INCREMENT=10 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Structure for the `ag_menu` table : 
#

CREATE TABLE `ag_menu` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `typeId` INTEGER(11) NOT NULL DEFAULT '1',
  `menuUrl` VARCHAR(65) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `menuName` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `parent_id` INTEGER(11) NOT NULL DEFAULT '1',
  `menuSort` INTEGER(11) NOT NULL DEFAULT '1',
  `optional` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `menuPic` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `seoKeyword` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `menuBackpic` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `menuLeftpic` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `show_type` INTEGER(11) NOT NULL DEFAULT '1',
  `template` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM
AUTO_INCREMENT=38 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT='InnoDB free: 3072 kB';

#
# Structure for the `ag_menu_type` table : 
#

CREATE TABLE `ag_menu_type` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `typeName` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `is_del` INTEGER(11) NOT NULL DEFAULT '1',
  `mt_url` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `admin_mt_url` VARCHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM
AUTO_INCREMENT=6 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Structure for the `ag_product` table : 
#

CREATE TABLE `ag_product` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `tid` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `name` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `introduction` VARCHAR(400) COLLATE utf8_general_ci DEFAULT NULL,
  `remark` TEXT COLLATE utf8_general_ci,
  `content` TEXT COLLATE utf8_general_ci,
  `keyword` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `hots` INTEGER(10) DEFAULT NULL,
  `thumpic` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `pics` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `sort` TINYINT(1) NOT NULL DEFAULT '0',
  `show` TINYINT(1) NOT NULL DEFAULT '0',
  `update_time` DATETIME DEFAULT NULL,
  `home_show` INTEGER(11) NOT NULL DEFAULT '0',
  `new_show` INTEGER(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM
AUTO_INCREMENT=72 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Structure for the `ag_product_type` table : 
#

CREATE TABLE `ag_product_type` (
  `tid` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `root_id` INTEGER(11) NOT NULL DEFAULT '0',
  `typeName` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `introduction` TEXT COLLATE utf8_general_ci,
  `seoKeyword` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `sort` INTEGER(11) NOT NULL DEFAULT '1',
  `typePic` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`tid`)
)ENGINE=MyISAM
AUTO_INCREMENT=13 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT='InnoDB free: 3072 kB';

#
# Structure for the `ag_sys_config` table : 
#

CREATE TABLE `ag_sys_config` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `domain` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `title` VARCHAR(200) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `keyword` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `contents` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `templates` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `copyright` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `copyrighturl` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM
AUTO_INCREMENT=6 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT='InnoDB free: 3072 kB';

#
# Structure for the `ag_user` table : 
#

CREATE TABLE `ag_user` (
  `uid` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `userpass` VARCHAR(32) COLLATE utf8_general_ci DEFAULT NULL,
  `email` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `is_del` TINYINT(1) DEFAULT NULL,
  `group_id` INTEGER(10) DEFAULT NULL,
  `mid` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
)ENGINE=MyISAM
AUTO_INCREMENT=14 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Structure for the `ag_user_group` table : 
#

CREATE TABLE `ag_user_group` (
  `group_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `group_name` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `permissions` VARCHAR(400) COLLATE utf8_general_ci DEFAULT NULL,
  `makes` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`group_id`)
)ENGINE=MyISAM
AUTO_INCREMENT=7 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the `ag_homepage` table  (LIMIT 0,500)
#

INSERT INTO `ag_homepage` (`hId`, `hType`, `hTitle`, `hContents`, `hPic`, `hUrl`, `hSort`, `post_time`) VALUES 
  (2,1,'订 货','','20160612150955.1383139988_advancedsettings.png','http://workbench/launchModule?module=com.evangelsoft.crosslink.purchase.order.client.PurchaseContractFrame',2,'2015-02-02 21:06:23'),
  (3,1,'退 货','','20160608160815.1383742714_document_add.png','http://workbench/launchModule?module=com.evangelsoft.crosslink.purchase.order.client.PurchaseReturnContractFrame',3,'2015-02-02 22:05:03'),
  (4,0,'0','0','0','0',0,'2015-02-02 22:42:47'),
  (5,1,'配 货','','20160612151929.1383139890_x-office-address-book.png','http://workbench/launchModule?module=com.evangelsoft.crosslink.logistics.admeasure.client.DocumentAdmeasureFrame',1,'2016-06-12 15:19:21'),
  (6,1,'盘 点','','20160612152157.1383139280_applications-office.png','http://workbench/launchModule?module=com.evangelsoft.crosslink.logistics.stocktake.client.StocktakeFrame',1,'2016-06-12 15:21:59'),
  (7,1,'调 拨','','20160612152234.success.png','http://workbench/launchModule?module=com.evangelsoft.crosslink.logistics.transfer.client.TransferNoteFrame',1,'2016-06-12 15:22:37'),
  (8,1,'入 库','','20160612153608.ooopic_1465716961.png','http://workbench/launchModule?module=com.evangelsoft.crosslink.logistics.receiving.client.GoodsReceivingTaskFrame',1,'2016-06-12 15:24:03'),
  (9,1,'出 库','','20160612153712.ooopic_1465717031.png','http://workbench/launchModule?module=com.evangelsoft.crosslink.logistics.delivering.client.GoodsDeliveryTaskFrame',1,'2016-06-12 15:37:13');
COMMIT;

#
# Data for the `ag_menu` table  (LIMIT 0,500)
#

INSERT INTO `ag_menu` (`id`, `typeId`, `menuUrl`, `menuName`, `parent_id`, `menuSort`, `optional`, `menuPic`, `seoKeyword`, `menuBackpic`, `menuLeftpic`, `show_type`, `template`) VALUES 
  (11,1,'contactus','联系我们',0,44,'0','','','0','0',1,'contact'),
  (25,1,'aboutus','关于海门',0,0,'0','20151004151503.未标题-2-恢复的.jpg','','0','0',1,'page'),
  (26,1,'introduce','公司介绍',25,1,'0','','','0','0',1,'page'),
  (27,1,'culture','发展历程',25,2,'0','','','0','0',1,'page'),
  (28,1,'team','企业荣誉',25,3,'0','','','0','0',1,'page'),
  (29,1,'idea','生产体系',0,3,'0','','','0','0',1,'page'),
  (30,1,'job','招贤纳士',25,4,'0','','','0',NULL,1,'page'),
  (31,1,'tech','设备展示',29,1,'0','','','0','0',1,'page'),
  (33,1,'client','典型客户',0,6,'0','','','0','0',1,'page'),
  (34,1,'qa','质量体系',29,3,'0','','','0',NULL,1,'page'),
  (36,3,'allpro','产品中心',0,5,'0','','','0','0',1,'product'),
  (37,1,'center','检测中心',29,2,'0','','','0',NULL,1,'page');
COMMIT;

#
# Data for the `ag_menu_type` table  (LIMIT 0,500)
#

INSERT INTO `ag_menu_type` (`id`, `typeName`, `is_del`, `mt_url`, `admin_mt_url`) VALUES 
  (1,'Content',1,'','article'),
  (2,'external links',0,'','external links'),
  (3,'Product',1,'','product'),
  (4,'Hall of Fame',0,'gallery','halloffame'),
  (5,'Venues',0,'venues','maps');
COMMIT;

#
# Data for the `ag_product` table  (LIMIT 0,500)
#

INSERT INTO `ag_product` (`id`, `tid`, `name`, `introduction`, `remark`, `content`, `keyword`, `hots`, `thumpic`, `pics`, `sort`, `show`, `update_time`, `home_show`, `new_show`) VALUES 
  (1,'10','汽油机-油壶','油壶','海门橡塑','<p>\n\t<strong>I. General Description</strong> \n</p>\n<p>\n\tThis machine is used to seal the shell together with the sealing cap.\n</p>\n ','汽油机-油壶',NULL,'20151004220410.2006215114431584.png',NULL,0,0,'2015-10-04 22:04:00',0,1),
  (2,'12','点火线-高压帽','FL40','海门橡塑','<p>\n\t<strong>I. General Description</strong> \n</p>\n<p>\n\tThis machine is used for seaming the special spin-on filters which need inward seaming.\n</p>\n<p>\n\t<strong>II. Specifications</strong> \n</p>\n<p>\n\t1.Production efficiency: 8pcs/min\n</p>\n<p>\n\t2.Seaming diameter: 80-130mm\n</p>\n<p>\n\t3.Filter assembly height: 200-300mm\n</p>\n<p>\n\t4.Steel thickness: 0.5-1mm\n</p>\n<p>\n\t5.Motor power: 2.285Kw\n</p>\n<p>\n\t6.Air pressure: 380V/50Hz\n</p>\n<p>\n\t7.Power supply: 380V/50Hz\n</p>\n<p>\n\t8.Machine weight: 400kg\n</p>\n<p>\n\t9.Machine size: 880mm*780mm*2260mm (L*W*H)\n</p>\n<p>\n\t<strong>III. Features</strong> \n</p>\n<p>\n\t1.This specially designed machine has the function of gluing and seaming at the same time, and it is high efficiency.\n</p>\n<p>\n\t2.The seaming molds moving action is automatically finished by cylinder set program.\n</p>\n<p>\n\t3.Pressing the left-right buttons manually at the same time, so as for safe operation.\n</p>','点火线',NULL,'20151004221204.2006215114431584.png',NULL,0,0,'2009-03-26 00:30:27',0,1),
  (9,'1','机油滤清器橡胶配件','15607-1030,15607-1130,6071-2104-00','机油滤清器橡胶配件','<P><STRONG>I. General Description</STRONG> </P>\n<P>It is suitable for testing and inspecting the pressure resistance of the oil filter assembly. </P>\n<P><STRONG>II. Specifications</STRONG> </P>\n<P>1.Max test pressure: 2.5MPa </P>\n<P>2.Pressure precision: one grade; </P>\n<P>3.Power supply: 220V/50Hz </P>\n<P>4.Motor power: 250W </P>\n<P>5.Machine weight: 250Kg </P>\n<P>6.Machine size: 900mm*750mm*1230mm (L*W*H) </P>\n<P><STRONG>III. Features</STRONG> </P>\n<P>1.The manual pump of the test stand will pressurize the filters until the filters burst and the pressure gauge immediately displays the pressure. </P>\n<P>2.The pressure to be displayed won¡¯t be disappeared on the gauge until the reset is done manually; </P>\n<P>3.Reasonable design, simple operation and exquisite shape </P>','日野(HINO)',NULL,'20151004214131.2006215114431584.png',NULL,0,0,'2015-10-04 21:41:00',0,1),
  (30,'3','柴油滤清器橡胶配件','7111,296','柴油滤清器橡胶配件',' ','福特(Ford)',NULL,'20151004212019.2006215114431584.png',NULL,0,0,'2015-10-04 21:20:00',0,1),
  (40,'3','日野(HINO)','23401-1030','日野(HINO)','<p>\n\t<strong>I. General Description</strong> \n</p>\n<p>\n\tThis\n</p>\n<p>\n\t<strong>II. Specifications</strong> \n</p>\n<p>\n\t1.Max pleating width: 700mm\n</p>\n<p>\n\t2.Pleating height: 20-100mm\n</p>\n<p>\n\t3.Pleating speed: 4-10m/min\n</p>\n<p>\n\t4.Dispensing gap: 25.4mm\n</p>\n<p>\n\t5.Dispensing lines: 2*26lines\n</p>\n<p>\n\t6.Power supply: 380V/50Hz\n</p>\n ','日野(HINO)',NULL,'20151004212531.2006215114431584.png',NULL,0,0,'2015-10-04 21:24:00',1,0),
  (41,'3','柴油滤清器橡胶配件 ','23401-1090','柴油滤清器橡胶配件 ','<p>\n\t<strong>I. General Description</strong> \n</p>\n<p>\n\tThis machine is used for pleating the glass fiber.\n</p>\n<p>\n\t<strong>II. Specifications</strong> \n</p>\n<p>\n\t1.Production speed: 10m/min\n</p>\n<p>\n\t2.Pleating height: 120mm; 190mm, 260mm (or customized)\n</p>\n<p>\n\t3.Max paper width: 650mm\n</p>\n<p>\n\t4.Motor power: 1.1Kw\n</p>\n<p>\n\t5.Power supply: 220V/50Hz\n</p>\n<p>\n\t6.Machine weight: 500Kg\n</p>\n<p>\n\t7.Machine size: 1800mm*1200mm*1300mm (L*W*H)\n</p>\n<br />','日野(HINO)',NULL,'20151004212735.2006215114431584.png',NULL,0,0,'2015-10-04 21:26:00',1,0),
  (51,'11','有骨雨括器-12胶条300mm','40001-01200','海门橡塑','<p>\n\t<strong>12胶条300mm</strong>\n</p>\n<p>\n\t<br />\n</p>','有骨雨括器',NULL,'20151004214708.2006215114431584.png',NULL,0,0,'2015-10-04 21:46:00',1,1),
  (52,'11','有骨雨括器 - 13胶条325mm','40001-01300','海门橡塑','<strong>13胶条325mm</strong><br />\n<img alt=\"\" src=\"/attachments/article/image/20151004/20151004215220_69598.jpg\" /><br />','有骨雨括器',NULL,'20151005134223.20151004215240_2006215114431584.png',NULL,0,0,'2009-03-26 00:01:54',1,0);
COMMIT;

#
# Data for the `ag_product_type` table  (LIMIT 0,500)
#

INSERT INTO `ag_product_type` (`tid`, `root_id`, `typeName`, `introduction`, `seoKeyword`, `sort`, `typePic`) VALUES 
  (1,5,'日野橡胶配件','','',2,''),
  (3,5,'福特橡胶配件','','',1,''),
  (5,0,'汽车滤清器橡胶配件','','',1,''),
  (6,5,'日立橡胶配件','','',3,''),
  (7,0,' 汽车滤清器塑料盖配件','','',2,''),
  (8,0,'雨括片','','',4,''),
  (9,0,'其它橡胶配件','','',255,''),
  (10,9,'汽油机配件','','',0,''),
  (11,8,'雨括片(NA系列)','','',0,''),
  (12,9,'汽油机点火线高压帽','','',0,'');
COMMIT;

#
# Data for the `ag_sys_config` table  (LIMIT 0,500)
#

INSERT INTO `ag_sys_config` (`id`, `domain`, `title`, `keyword`, `contents`, `templates`, `copyright`, `copyrighturl`) VALUES 
  (5,'http://localhost:8093/','DX-Semir','DX-Semir','DX-Semir','Dxsemir','森马股份','http://wwwsemir.com');
COMMIT;

#
# Data for the `ag_user` table  (LIMIT 0,500)
#

INSERT INTO `ag_user` (`uid`, `username`, `userpass`, `email`, `is_del`, `group_id`, `mid`) VALUES 
  (1,'admin','5fec4ba8376f207d1ff2f0cac0882b01','w67695@qq.com',1,1,0),
  (8,'itadmin','5fec4ba8376f207d1ff2f0cac0882b01','ss@sss.com',NULL,2,0);
COMMIT;

#
# Data for the `ag_user_group` table  (LIMIT 0,500)
#

INSERT INTO `ag_user_group` (`group_id`, `group_name`, `permissions`, `makes`) VALUES 
  (1,'administrator','[{\"controller\":\"all\",\"permission\":\"all\"} ]','All '),
  (2,'Article','[{\"controller\":\"article\",\"permission\":\"all\"} ]','article');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;