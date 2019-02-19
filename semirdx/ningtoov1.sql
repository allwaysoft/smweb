# SQL Manager 2007 for MySQL 4.3.4.1
# ---------------------------------------
# Host     : mysql.sql90.eznowdata.com
# Port     : 3306
# Database : sq_rubber888


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `sq_rubber888`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_general_ci';

USE `sq_rubber888`;

#
# Structure for the `ad_item` table : 
#

CREATE TABLE `ad_item` (
  `proId` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `classId` INTEGER(10) DEFAULT NULL,
  `proName` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `proNameFu` TEXT COLLATE utf8_general_ci NOT NULL COMMENT '1=hong,2=bai,3=fei,4=lie',
  `proContent` TEXT COLLATE utf8_general_ci,
  `proContentMore` TEXT COLLATE utf8_general_ci,
  `proPic` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `proLogo` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `proPdf` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `proMark` TEXT COLLATE utf8_general_ci,
  `seo_keyword` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `seo_description` VARCHAR(400) COLLATE utf8_general_ci DEFAULT NULL,
  `hits` INTEGER(10) DEFAULT NULL,
  `author` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `edit_author` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `verifier` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `is_best` TINYINT(1) DEFAULT NULL,
  `is_del` TINYINT(1) DEFAULT '0',
  `post_time` DATETIME DEFAULT NULL,
  `update_time` DATETIME DEFAULT NULL,
  `is_verified` TINYINT(1) DEFAULT NULL,
  `isSort` INTEGER(11) DEFAULT NULL,
  `galleryUrl` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`proId`)
)ENGINE=MyISAM
AUTO_INCREMENT=9 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Structure for the `ad_item_category` table : 
#

CREATE TABLE `ad_item_category` (
  `class_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `parent_id` INTEGER(5) DEFAULT NULL,
  `class_name` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `class_sequence` INTEGER(5) DEFAULT NULL,
  `class_optional` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `seoKeyword` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `Backpic` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `Pic` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `PDBackpic` TINYBLOB,
  PRIMARY KEY (`class_id`)
)ENGINE=MyISAM
AUTO_INCREMENT=11 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Structure for the `ag_article` table : 
#

CREATE TABLE `ag_article` (
  `article_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `classId` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `type` INTEGER(11) DEFAULT '1',
  `title` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `description` VARCHAR(400) COLLATE utf8_general_ci DEFAULT NULL,
  `content` TEXT COLLATE utf8_general_ci,
  `keyword` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `hits` INTEGER(10) DEFAULT NULL,
  `author` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `article_from` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `edit_author` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `article_pic` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `verifier` VARCHAR(40) COLLATE utf8_general_ci DEFAULT NULL,
  `is_best` TINYINT(1) DEFAULT NULL,
  `is_del` TINYINT(1) DEFAULT '0',
  `post_time` DATETIME DEFAULT NULL,
  `update_time` DATETIME DEFAULT NULL,
  `is_verified` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`article_id`)
)ENGINE=MyISAM
AUTO_INCREMENT=9 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

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
  `hSort` INTEGER(11) NOT NULL DEFAULT '1',
  `post_time` DATETIME DEFAULT NULL,
  PRIMARY KEY (`hId`)
)ENGINE=MyISAM
AUTO_INCREMENT=5 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

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
# Data for the `ag_article` table  (LIMIT 0,500)
#

INSERT INTO `ag_article` (`article_id`, `classId`, `type`, `title`, `description`, `content`, `keyword`, `hits`, `author`, `article_from`, `edit_author`, `article_pic`, `verifier`, `is_best`, `is_del`, `post_time`, `update_time`, `is_verified`) VALUES 
  (1,'26',2,'海门橡塑简介','海门橡塑','台州市海门橡塑有限公司座落于风景秀丽的台州市椒江区，濒临台州湾海门港，距黄岩民航机场5公里，交通极为便利。<br />\n<br />\n本公司现有占地面积13200多平方米, 建筑面积18558平方米。注册资金1000万，固定资产达4800多万元，员工250多名，其中高级工程师2人，技术人员23名。<br />\n<br />\n公司是集科研、生产、销售于一体的现代化民营企业。主要从事塑料制品、橡胶密封制品、特种橡胶制品的开发生产。在氟橡胶、硅橡胶、氟硅橡胶、氢化丁腈橡胶、羧基丁腈橡胶、乙丙橡胶、丙烯酸酯橡胶、丁腈橡胶、氯丁橡胶、丁基橡胶、氯硅橡胶、橡塑并用等材料的配合及应用方面具有很高的水平。为了满足汽车行业的不断需求，提升丁晴橡胶的应用范围，我们先后开发了耐高温130℃、140℃、耐低温-50℃、低压缩变形的橡胶制品。通用塑料、通用工程塑料，特别是特种工程塑料能满足汽车行业的以塑代钢的需求。<br />\n<br />\n为了进一步的提高企业的研发能力，保证产品的质量，满足不同客户的需求，本公司已通过生产许可证认证、ISO/TS16949∶2009和ISO9001∶2008质量体系认证。公司现拥有转盘式配料称重系、100吨至350吨自控硫化机50多台、45克~500克塑料机7台、橡胶产品在线自动检验机。拥有先进的测试设备：圆柱度仪、粗糙度仪，气动量仪、智能型无转子流变仪、微机液压万能试验机、电子拉力试验机、万分之一电光分析天平、比重仪、投影仪、耐臭氧试验机、脆性温度仪、动平衡试验台、高低温试验箱等。现代的经营管理为用户提供全方位的服务。<br />\n<br />\n公司专业生产汽车滤清器橡胶密封圈、O形圈、杂件、雨刷条等产品。我们目前执行标准有：美国标准：ASTM&nbsp; D2000-03a ；日本标准：JISK 6380；国标：HG/T 2579-94等标准。产品销往全国各地；并远销美国、日本、韩国、马来西亚等国家。我公司主机二次配套客户有上海大众、上海汽车、上海通用、一汽汽车、东风汽车、东南汽车等。<br />\n<br />\n<strong>我们的经营理念：</strong><br />\n诚信经营，以人为本，以质为命，求实奉献，开拓进取的企业精神，愿与各位新老客户携手共创美好未来。<br />\n<br />','海门橡塑',0,'0','0','0','',NULL,0,0,NULL,'2015-10-04 15:37:44',NULL),
  (2,'27',2,'公司发展历程','公司发展历程','<strong>主要历程:</strong><br />\n<ol>\n\t<li>\n\t\t台州市海门橡塑有限公司成立于1995年\n\t</li>\n\t<li>\n\t\t2000年与西北橡胶研究所建立技术合作关系\n\t</li>\n\t<li>\n\t\t2004年1月通过 QS9000 质量体系认证\n\t</li>\n\t<li>\n\t\t2007年1月通过 ISO/TS 16949:2002 ISO9001∶2000&nbsp; 质量体系认证 <br />\n\t</li>\n\t<li>\n\t\t2009年4月从意大利DOSS公司进口橡胶垫圈、O形圈高速\n\t</li>\n\t<li>\n\t\t全自动在线全数检验机，为产品质量提供了可靠保证\n\t</li>\n</ol>\n<p>\n\t<span style=\"font-size:16px;\">2014年产量30000万</span><span style=\"font-size:16px;\">件</span><img class=\"img-responsive img-rounded \" src=\"/attachments/article/image/20151004/20151004154630_81523.jpg\" alt=\"\" />\n</p>\n<br />\n<p>\n\t<span style=\"font-size:16px;\">2014年销售收入7700万元</span><img class=\"img-responsive img-rounded \" src=\"/attachments/article/image/20151004/20151004154652_91008.jpg\" alt=\"\" />\n</p>\n<br />','公司发展历程',0,'0','0','0','',NULL,0,0,NULL,'2015-10-04 15:53:39',NULL),
  (3,'28',2,'企业荣誉','','<img src=\"/attachments/article/image/20151004/20151004161740_81288.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/attachments/article/image/20151004/20151004162106_34696.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/attachments/article/image/20151004/20151004162213_70817.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/attachments/article/image/20151004/20151004203056_98115.jpg\" alt=\"\" /><br />','',0,'0','0','0','',NULL,0,0,NULL,'2015-10-04 20:30:59',NULL),
  (4,'30',2,'招贤纳士','','<strong><span style=\"font-size:18px;\">2015年</span></strong><strong><span style=\"font-size:18px;\">最新在</span></strong><strong><span style=\"font-size:18px;\">线招聘</span></strong><br />\n<br />\n质保部：    1名      机械专业毕业的优先         工资面议 <br />\n电&nbsp;&nbsp;  工： 1名      有电工证优先               工资面议 <br />\n<br />\n公司有厂车接送上下班，公司包吃一餐工作餐，具体工作要求面谈。 <br />\n<br />\n联系电话：0576-88024273 <br />\n联 系 人：陈小姐','',0,'0','0','0','',NULL,0,0,NULL,'2015-10-04 16:30:40',NULL),
  (5,'37',2,'检测中心 ','','<p>\n\tinformation\n</p>','',0,'0','0','0','',NULL,0,0,NULL,'2015-10-05 13:31:24',NULL),
  (6,'31',2,'设备展示 ','','<strong><span style=\"font-size:18px;\">200吨橡胶注压成型机</span></strong> <br />\n<br />\n<img width=\"568\" height=\"760\" style=\"width:298px;height:256px;\" alt=\"\" src=\"/attachments/article/image/20151005/20151005133315_71589.jpg\" /><img width=\"568\" height=\"760\" style=\"width:298px;height:256px;\" alt=\"\" src=\"/attachments/article/image/20151005/20151005133315_71589.jpg\" />','',0,'0','0','0','',NULL,0,0,NULL,'2015-10-05 13:37:47',NULL),
  (7,'34',2,'质量体系认证','','<strong>公司通过ISO/TS16949-2009质量体系认证</strong><br />\n<img src=\"/attachments/article/image/20151004/20151004204003_70351.jpg\" alt=\"\" /><br />\n<br />\n<strong>公司通过ISO9001-2008质量体系认证 <br />\n<img src=\"/attachments/article/image/20151004/20151004204138_92809.jpg\" alt=\"\" /></strong><br />','',0,'0','0','0','',NULL,0,0,NULL,'2015-10-04 20:42:17',NULL),
  (8,'11',2,'联系我们','','<strong>台州市海门橡塑有限公司</strong><br />\n地址： 浙江省台州市椒江区洪家街道烟墩坝 <br />\n邮编： 318015 <br />\n<br />\n<strong>销售部：</strong><br />\n电话： 0576-88024267 <br />\n邮箱:Commercial@haimen-rubber.com <br />\n<br />\n<strong>技术部：</strong><br />\n电话： 0576-88024290 <br />\n邮箱:technology@haimen-rubber.com <br />\n传真： 0576-88024268 <br />','',0,'0','0','0','',NULL,0,0,NULL,'2015-10-04 22:29:13',NULL);
COMMIT;

#
# Data for the `ag_homepage` table  (LIMIT 0,500)
#

INSERT INTO `ag_homepage` (`hId`, `hType`, `hTitle`, `hContents`, `hPic`, `hUrl`, `hSort`, `post_time`) VALUES 
  (2,1,'更多信息','','20150202214656.11.jpg','http://fixthisflatroof.com/references/personal.html',0,'2015-02-02 21:06:23'),
  (3,1,'testing title','sdfdff','20150202220455.222.jpg','5555',0,'2015-02-02 22:05:03'),
  (4,0,'0','0','0','0',0,'2015-02-02 22:42:47');
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
  (5,'http://www.rubberhm.com/','海门橡塑','台州市海门橡塑有限公司, 公司是集科研、生产、销售于一体的现代化民营企业。主要从事橡胶密封制品、特种橡胶制品的开发生产。在氟橡胶、硅橡胶、氟硅橡胶、氢化丁腈橡胶、羧基丁腈橡胶、乙丙橡胶、丙烯酸酯橡胶、丁腈橡胶、氯丁橡胶、丁基橡胶、氯硅橡胶、橡塑并用等材料的配合及应用方面具有很高的水平。',' 公司是集科研、生产、销售于一体的现代化民营企业。主要从事橡胶密封制品、特种橡胶制品的开发生产。在氟橡胶、硅橡胶、氟硅橡胶、氢化丁腈橡胶、羧基丁腈橡胶、乙丙橡胶、丙烯酸酯橡胶、丁腈橡胶、氯丁橡胶、丁基橡胶、氯硅橡胶、橡塑并用等材料的配合及应用方面具有很高的水平。','rubberhm','上海乐依资产管理有限公司','http://www.rubberhm.com');
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