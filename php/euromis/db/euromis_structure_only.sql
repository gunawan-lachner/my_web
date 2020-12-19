/*
SQLyog Enterprise - MySQL GUI v6.0
Host - 5.1.47-log : Database - euromis
*********************************************************************
Server version : 5.1.47-log
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `euromis`;

USE `euromis`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `jos_ak_acl` */

DROP TABLE IF EXISTS `jos_ak_acl`;

CREATE TABLE `jos_ak_acl` (
  `user_id` bigint(20) unsigned NOT NULL,
  `permissions` mediumtext,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_ak_profiles` */

DROP TABLE IF EXISTS `jos_ak_profiles`;

CREATE TABLE `jos_ak_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `configuration` longtext,
  `filters` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_ak_stats` */

DROP TABLE IF EXISTS `jos_ak_stats`;

CREATE TABLE `jos_ak_stats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `comment` longtext,
  `backupstart` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `backupend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('run','fail','complete') NOT NULL DEFAULT 'run',
  `origin` varchar(30) NOT NULL DEFAULT 'backend',
  `type` varchar(30) NOT NULL DEFAULT 'full',
  `profile_id` bigint(20) NOT NULL DEFAULT '1',
  `archivename` longtext,
  `absolute_path` longtext,
  `multipart` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(255) DEFAULT NULL,
  `filesexist` tinyint(1) NOT NULL DEFAULT '0',
  `remote_filename` varchar(1000) DEFAULT NULL,
  `total_size` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_fullstatus` (`filesexist`,`status`),
  KEY `idx_stale` (`status`,`origin`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_banner` */

DROP TABLE IF EXISTS `jos_banner`;

CREATE TABLE `jos_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT 'banner',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `showBanner` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_bannerclient` */

DROP TABLE IF EXISTS `jos_bannerclient`;

CREATE TABLE `jos_bannerclient` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` time DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_bannertrack` */

DROP TABLE IF EXISTS `jos_bannertrack`;

CREATE TABLE `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_categories` */

DROP TABLE IF EXISTS `jos_categories`;

CREATE TABLE `jos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_components` */

DROP TABLE IF EXISTS `jos_components`;

CREATE TABLE `jos_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` varchar(255) NOT NULL DEFAULT '',
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_contact_details` */

DROP TABLE IF EXISTS `jos_contact_details`;

CREATE TABLE `jos_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_content` */

DROP TABLE IF EXISTS `jos_content`;

CREATE TABLE `jos_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
  `catid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `parentid` int(11) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_content_frontpage` */

DROP TABLE IF EXISTS `jos_content_frontpage`;

CREATE TABLE `jos_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_content_rating` */

DROP TABLE IF EXISTS `jos_content_rating`;

CREATE TABLE `jos_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_core_acl_aro` */

DROP TABLE IF EXISTS `jos_core_acl_aro`;

CREATE TABLE `jos_core_acl_aro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_value` varchar(240) NOT NULL DEFAULT '0',
  `value` varchar(240) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_core_acl_aro_groups` */

DROP TABLE IF EXISTS `jos_core_acl_aro_groups`;

CREATE TABLE `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_core_acl_aro_map` */

DROP TABLE IF EXISTS `jos_core_acl_aro_map`;

CREATE TABLE `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(230) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_core_acl_aro_sections` */

DROP TABLE IF EXISTS `jos_core_acl_aro_sections`;

CREATE TABLE `jos_core_acl_aro_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(230) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_core_acl_groups_aro_map` */

DROP TABLE IF EXISTS `jos_core_acl_groups_aro_map`;

CREATE TABLE `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(240) NOT NULL DEFAULT '',
  `aro_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_core_log_items` */

DROP TABLE IF EXISTS `jos_core_log_items`;

CREATE TABLE `jos_core_log_items` (
  `time_stamp` date NOT NULL DEFAULT '0000-00-00',
  `item_table` varchar(50) NOT NULL DEFAULT '',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_core_log_searches` */

DROP TABLE IF EXISTS `jos_core_log_searches`;

CREATE TABLE `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_docman` */

DROP TABLE IF EXISTS `jos_docman`;

CREATE TABLE `jos_docman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '1',
  `dmname` text NOT NULL,
  `dmdescription` longtext,
  `dmdate_published` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dmowner` int(4) NOT NULL DEFAULT '-1',
  `dmfilename` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `dmurl` text,
  `dmcounter` int(11) DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `dmthumbnail` text,
  `dmlastupdateon` datetime DEFAULT '0000-00-00 00:00:00',
  `dmlastupdateby` int(5) NOT NULL DEFAULT '-1',
  `dmsubmitedby` int(5) NOT NULL DEFAULT '-1',
  `dmmantainedby` int(5) DEFAULT '0',
  `dmlicense_id` int(5) DEFAULT '0',
  `dmlicense_display` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `attribs` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pub_appr_own_cat_name` (`published`,`approved`,`dmowner`,`catid`,`dmname`(64)),
  KEY `appr_pub_own_cat_date` (`approved`,`published`,`dmowner`,`catid`,`dmdate_published`),
  KEY `own_pub_appr_cat_count` (`dmowner`,`published`,`approved`,`catid`,`dmcounter`),
  KEY `own_pub_appr_cat_id` (`dmowner`,`published`,`approved`,`catid`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_docman_groups` */

DROP TABLE IF EXISTS `jos_docman_groups`;

CREATE TABLE `jos_docman_groups` (
  `groups_id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_name` text NOT NULL,
  `groups_description` longtext,
  `groups_access` tinyint(4) NOT NULL DEFAULT '1',
  `groups_members` text,
  PRIMARY KEY (`groups_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_docman_history` */

DROP TABLE IF EXISTS `jos_docman_history`;

CREATE TABLE `jos_docman_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `revision` int(5) NOT NULL DEFAULT '1',
  `his_date` datetime NOT NULL,
  `his_who` int(11) NOT NULL,
  `his_obs` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_docman_licenses` */

DROP TABLE IF EXISTS `jos_docman_licenses`;

CREATE TABLE `jos_docman_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `license` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_docman_log` */

DROP TABLE IF EXISTS `jos_docman_log`;

CREATE TABLE `jos_docman_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_docid` int(11) NOT NULL,
  `log_ip` text NOT NULL,
  `log_datetime` datetime NOT NULL,
  `log_user` int(11) NOT NULL DEFAULT '0',
  `log_browser` text,
  `log_os` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_a` */

DROP TABLE IF EXISTS `jos_euromis_a`;

CREATE TABLE `jos_euromis_a` (
  `A_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `A_RESPONSE_CODE` varchar(5) NOT NULL,
  `A_ACTION` varchar(10) NOT NULL,
  `A_DESCRIPTION` varchar(100) NOT NULL,
  PRIMARY KEY (`A_ID`),
  UNIQUE KEY `INDEX01` (`A_RESPONSE_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_b` */

DROP TABLE IF EXISTS `jos_euromis_b`;

CREATE TABLE `jos_euromis_b` (
  `B_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `B_TIMESTAMP` varchar(25) NOT NULL,
  `B_DATE` date NOT NULL,
  `B_TIME` time NOT NULL,
  `B_ORIGINATOR` varchar(50) NOT NULL,
  `B_DESTINATION` varchar(50) NOT NULL,
  `B_CHANNEL` varchar(50) NOT NULL,
  `B_BODYXML` text NOT NULL,
  `B_STATUS` int(1) NOT NULL,
  PRIMARY KEY (`B_ID`),
  KEY `INDEX01` (`B_TIMESTAMP`,`B_DATE`,`B_TIME`)
) ENGINE=InnoDB AUTO_INCREMENT=3576426 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_c` */

DROP TABLE IF EXISTS `jos_euromis_c`;

CREATE TABLE `jos_euromis_c` (
  `C_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `C_TIMESTAMP` varchar(25) NOT NULL,
  `C_DATE` date NOT NULL,
  `C_TIME` time NOT NULL,
  `C_ORIGINATOR` varchar(50) NOT NULL,
  `C_DESTINATION` varchar(50) NOT NULL,
  `C_CHANNEL` varchar(50) NOT NULL,
  `C_BODYXML` text NOT NULL,
  `C_STATUS` int(1) NOT NULL,
  PRIMARY KEY (`C_ID`),
  KEY `INDEX01` (`C_TIMESTAMP`,`C_DATE`,`C_TIME`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_d` */

DROP TABLE IF EXISTS `jos_euromis_d`;

CREATE TABLE `jos_euromis_d` (
  `D_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `D_TRMSGC` varchar(2) NOT NULL,
  `D_TRMSGF` varchar(1) NOT NULL,
  `D_TRMSGT` varchar(1) NOT NULL,
  `D_TRMICD` varchar(3) NOT NULL,
  `D_TRTRTY` varchar(2) NOT NULL,
  `D_TRTRFA` varchar(2) NOT NULL,
  `D_TRTRTA` varchar(2) NOT NULL,
  `D_TRACTN` varchar(1) NOT NULL,
  `D_TRRSPC` varchar(2) NOT NULL,
  `D_TRAPR` varchar(6) NOT NULL,
  `D_TRCRD` varchar(19) NOT NULL,
  `D_TRXMDT` int(7) NOT NULL,
  `D_TRXMTM` int(6) NOT NULL,
  `D_TRSTAN` int(12) NOT NULL,
  `D_TRRRF` varchar(12) NOT NULL,
  `D_TRAQPT` varchar(3) NOT NULL,
  `D_TRISPT` varchar(3) NOT NULL,
  `D_TRI2PT` varchar(3) NOT NULL,
  `D_TRAQND` varchar(3) NOT NULL,
  `D_TRISND` varchar(3) NOT NULL,
  `D_TRI2ND` varchar(3) NOT NULL,
  `D_TRNTID` varchar(3) NOT NULL,
  `D_TRGWAY` varchar(3) NOT NULL,
  `D_TRMCAT` varchar(4) NOT NULL,
  `D_TRCAID` varchar(15) NOT NULL,
  `D_TRCATI` varchar(8) NOT NULL,
  `D_TRCATA` varchar(40) NOT NULL,
  `D_TRAQID` varchar(11) NOT NULL,
  `D_TRI1ID` varchar(11) NOT NULL,
  `D_TRI2ID` varchar(11) NOT NULL,
  `D_TRTDAT` varchar(7) NOT NULL,
  `D_TRTTIM` varchar(6) NOT NULL,
  `D_TRCASD` varchar(7) NOT NULL,
  `D_TRASDT` varchar(7) NOT NULL,
  `D_TRI1DT` varchar(7) NOT NULL,
  `D_TRI2DT` varchar(7) NOT NULL,
  `D_TRPOSL` varchar(12) NOT NULL,
  `D_TRTRCC` varchar(3) NOT NULL,
  `D_TRTRN` varchar(15) NOT NULL,
  `D_TRATR` varchar(15) NOT NULL,
  `D_TRTRFE` varchar(15) NOT NULL,
  `D_TRCOCC` varchar(3) NOT NULL,
  `D_TRCOT` varchar(15) NOT NULL,
  `D_TRACO` varchar(15) NOT NULL,
  `D_TRCICC` varchar(3) NOT NULL,
  `D_TRCIT` varchar(15) NOT NULL,
  `D_TRASCC` varchar(3) NOT NULL,
  `D_TRASA` varchar(15) NOT NULL,
  `D_TRASF` varchar(15) NOT NULL,
  `D_TRASP` varchar(15) NOT NULL,
  `D_TRASCR` varchar(15) NOT NULL,
  `D_TRI1BC` varchar(3) NOT NULL,
  `D_TRI1CC` varchar(3) NOT NULL,
  `D_TRI1A` varchar(15) NOT NULL,
  `D_TRI1F` varchar(15) NOT NULL,
  `D_TRI1P` varchar(15) NOT NULL,
  `D_TRI1CR` varchar(15) NOT NULL,
  `D_TRI2BC` varchar(3) NOT NULL,
  `D_TRI2CC` varchar(3) NOT NULL,
  `D_TRI2A` varchar(15) NOT NULL,
  `D_TRI2F` varchar(15) NOT NULL,
  `D_TRI2P` varchar(15) NOT NULL,
  `D_TRI2CR` varchar(15) NOT NULL,
  `D_TRC1CC` varchar(3) NOT NULL,
  `D_TRC1A` varchar(15) NOT NULL,
  `D_TRC1AF` varchar(15) NOT NULL,
  `D_TRC1PF` varchar(15) NOT NULL,
  `D_TRC1SF` varchar(15) NOT NULL,
  `D_TRC1M` varchar(15) NOT NULL,
  `D_TRC1MP` varchar(15) NOT NULL,
  `D_TRSC1R` varchar(15) NOT NULL,
  `D_TRC2CC` varchar(3) NOT NULL,
  `D_TRC2A` varchar(15) NOT NULL,
  `D_TRC2AF` varchar(15) NOT NULL,
  `D_TRC2PF` varchar(15) NOT NULL,
  `D_TRC2SF` varchar(15) NOT NULL,
  `D_TRC2M` varchar(15) NOT NULL,
  `D_TRC2MP` varchar(15) NOT NULL,
  `D_TRSC2R` varchar(15) NOT NULL,
  `D_TRAC1Q` varchar(2) NOT NULL,
  `D_TRAC1B` varchar(10) NOT NULL,
  `D_TRAC1T` varchar(2) NOT NULL,
  `D_TRAC1` varchar(19) NOT NULL,
  `D_TRAC2Q` varchar(2) NOT NULL,
  `D_TRAC2B` varchar(10) NOT NULL,
  `D_TRAC2T` varchar(2) NOT NULL,
  `D_TRAC2` varchar(19) NOT NULL,
  `D_TRPNEM` varchar(2) NOT NULL,
  `D_TRPNEC` varchar(1) NOT NULL,
  `D_TRPNCC` varchar(2) NOT NULL,
  `D_TRPCCD` varchar(2) NOT NULL,
  `D_TRTRKT` varchar(1) NOT NULL,
  `D_TRCRDL` varchar(2) NOT NULL,
  `D_TRISOL` varchar(3) NOT NULL,
  `D_TRMBR` varchar(1) NOT NULL,
  `D_TRVEXD` varchar(1) NOT NULL,
  `D_TRDATI` varchar(1) NOT NULL,
  `D_TREXDT` varchar(4) NOT NULL,
  `D_TRCVVV` varchar(1) NOT NULL,
  `D_TRCVVI` varchar(1) NOT NULL,
  `D_TRCVVL` varchar(1) NOT NULL,
  `D_TRCVCD` varchar(3) NOT NULL,
  `D_TRSVCI` varchar(1) NOT NULL,
  `D_TRSVCD` varchar(3) NOT NULL,
  `D_TRVPIN` varchar(1) NOT NULL,
  `D_TRPBTY` varchar(1) NOT NULL,
  `D_TRPINB` varchar(16) NOT NULL,
  `D_TROFFU` varchar(1) NOT NULL,
  `D_TROFFL` varchar(3) NOT NULL,
  `D_TRPINO` varchar(12) NOT NULL,
  `D_TRPVKI` varchar(1) NOT NULL,
  `D_TRPVKC` varchar(1) NOT NULL,
  `D_TRPVVI` varchar(1) NOT NULL,
  `D_TRPVVC` varchar(4) NOT NULL,
  `D_TRAQCO` varchar(3) NOT NULL,
  `D_TRAFMT` varchar(1) NOT NULL,
  `D_TRPOZP` varchar(9) NOT NULL,
  `D_TRPOAD` varchar(20) NOT NULL,
  `D_TRUBDF` varchar(1) NOT NULL,
  `D_TRCCNV` varchar(1) NOT NULL,
  `D_TRSVCF` varchar(1) NOT NULL,
  `D_TRWSVC` varchar(1) NOT NULL,
  `D_TRDNFG` varchar(1) NOT NULL,
  `D_TRRETF` varchar(1) NOT NULL,
  `D_TRCZID` varchar(20) NOT NULL,
  `D_TRVND` varchar(5) NOT NULL,
  `D_TRVNDQ` varchar(2) NOT NULL,
  `D_TRDOC1` varchar(7) NOT NULL,
  `D_TRDOC2` varchar(7) NOT NULL,
  `D_TRDOC` varchar(5) NOT NULL,
  `D_TRSPDY` varchar(3) NOT NULL,
  `D_TRSPDT` varchar(7) NOT NULL,
  `D_TRUSER` varchar(10) NOT NULL,
  `D_TRTOVR` varchar(1) NOT NULL,
  `D_TRSOVR` varchar(1) NOT NULL,
  `D_TROARF` varchar(1) NOT NULL,
  `D_TRPST1` varchar(1) NOT NULL,
  `D_TRPST2` varchar(1) NOT NULL,
  `D_TRRPSF` varchar(1) NOT NULL,
  `D_TRITKY` varchar(6) NOT NULL,
  `D_TRSECS` varchar(15) NOT NULL,
  `D_TRPROD` varchar(3) NOT NULL,
  `D_TROREQ` varchar(10) NOT NULL,
  `D_TRVDEV` varchar(10) NOT NULL,
  `D_TRITBF` varchar(1) NOT NULL,
  `D_TRABFL` varchar(1) NOT NULL,
  `D_TRCAFL` varchar(1) NOT NULL,
  `D_TRI1BF` varchar(1) NOT NULL,
  `D_TRI2BF` varchar(1) NOT NULL,
  `D_TRSND` varchar(3) NOT NULL,
  `D_TRREVS` varchar(1) NOT NULL,
  `D_TRRCST` varchar(1) NOT NULL,
  `D_TRDSRN` varchar(23) NOT NULL,
  PRIMARY KEY (`D_ID`),
  KEY `INDEX01` (`D_TRXMDT`,`D_TRXMTM`),
  KEY `INDEX02` (`D_TRSTAN`,`D_TRAC2`,`D_TRCZID`,`D_TRCRD`)
) ENGINE=InnoDB AUTO_INCREMENT=34792072 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_e` */

DROP TABLE IF EXISTS `jos_euromis_e`;

CREATE TABLE `jos_euromis_e` (
  `E_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `E_DATE` date NOT NULL,
  `E_TIME` time NOT NULL,
  `E_NODE` varchar(3) NOT NULL,
  `E_DESCRIPTION` varchar(50) NOT NULL,
  `E_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`E_ID`),
  KEY `INDEX01` (`E_DATE`,`E_TIME`)
) ENGINE=InnoDB AUTO_INCREMENT=1090429 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_f` */

DROP TABLE IF EXISTS `jos_euromis_f`;

CREATE TABLE `jos_euromis_f` (
  `F_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `F_DATE` date NOT NULL,
  `F_TIME` time NOT NULL,
  `F_MODULE` varchar(5) NOT NULL,
  `F_DESCRIPTION` varchar(50) NOT NULL,
  `F_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`F_ID`),
  KEY `INDEX01` (`F_DATE`,`F_TIME`)
) ENGINE=InnoDB AUTO_INCREMENT=3524 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_g` */

DROP TABLE IF EXISTS `jos_euromis_g`;

CREATE TABLE `jos_euromis_g` (
  `G_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `G_DATE` date NOT NULL,
  `G_TIME` time NOT NULL,
  `G_NODE` varchar(5) NOT NULL,
  `G_DESCRIPTION` varchar(50) NOT NULL,
  `G_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`G_ID`),
  KEY `INDEX01` (`G_DATE`,`G_TIME`)
) ENGINE=InnoDB AUTO_INCREMENT=3578333 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_h` */

DROP TABLE IF EXISTS `jos_euromis_h`;

CREATE TABLE `jos_euromis_h` (
  `H_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `H_DATE` date NOT NULL,
  `H_TIME` time NOT NULL,
  `H_ATMID` varchar(7) NOT NULL,
  `H_LOCATION` varchar(50) NOT NULL,
  `H_STATUS` varchar(1) NOT NULL,
  `H_CASH_STATUS` int(2) NOT NULL,
  PRIMARY KEY (`H_ID`),
  KEY `INDEX01` (`H_DATE`,`H_TIME`)
) ENGINE=InnoDB AUTO_INCREMENT=5437740 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_i` */

DROP TABLE IF EXISTS `jos_euromis_i`;

CREATE TABLE `jos_euromis_i` (
  `I_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `I_RC_ITM` varchar(2) NOT NULL,
  `I_RC_JUN` varchar(3) NOT NULL,
  `I_DESCRIPTION` varchar(100) NOT NULL,
  PRIMARY KEY (`I_ID`),
  KEY `INDEX01` (`I_RC_ITM`,`I_RC_JUN`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_euromis_j` */

DROP TABLE IF EXISTS `jos_euromis_j`;

CREATE TABLE `jos_euromis_j` (
  `I_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `J_DATE` date NOT NULL,
  `J_TIME` time NOT NULL,
  `J_DTSTAN` varchar(12) NOT NULL,
  `J_DTDTID` varchar(3) NOT NULL,
  `J_DTPHONE` varchar(15) NOT NULL,
  `J_DTAMOUNT` varchar(8) NOT NULL,
  `J_DTSERIAL` varchar(15) NOT NULL,
  PRIMARY KEY (`I_ID`),
  KEY `INDEX01` (`J_DATE`,`J_TIME`),
  KEY `INDEX02` (`J_DTSTAN`,`J_DTPHONE`)
) ENGINE=InnoDB AUTO_INCREMENT=133008922 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_fua_categories` */

DROP TABLE IF EXISTS `jos_fua_categories`;

CREATE TABLE `jos_fua_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_groupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_fua_components` */

DROP TABLE IF EXISTS `jos_fua_components`;

CREATE TABLE `jos_fua_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_groupid` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_fua_items` */

DROP TABLE IF EXISTS `jos_fua_items`;

CREATE TABLE `jos_fua_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid_groupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_fua_menuaccess` */

DROP TABLE IF EXISTS `jos_fua_menuaccess`;

CREATE TABLE `jos_fua_menuaccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuid_groupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_fua_modules` */

DROP TABLE IF EXISTS `jos_fua_modules`;

CREATE TABLE `jos_fua_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_groupid` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_fua_sections` */

DROP TABLE IF EXISTS `jos_fua_sections`;

CREATE TABLE `jos_fua_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_groupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_fua_usergroups` */

DROP TABLE IF EXISTS `jos_fua_usergroups`;

CREATE TABLE `jos_fua_usergroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `url` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_fua_userindex` */

DROP TABLE IF EXISTS `jos_fua_userindex`;

CREATE TABLE `jos_fua_userindex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_groups` */

DROP TABLE IF EXISTS `jos_groups`;

CREATE TABLE `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_joomdoc` */

DROP TABLE IF EXISTS `jos_joomdoc`;

CREATE TABLE `jos_joomdoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '1',
  `dmname` text NOT NULL,
  `dmdescription` longtext,
  `dmdate_published` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dmowner` int(4) NOT NULL DEFAULT '-1',
  `dmfilename` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `dmurl` text,
  `dmcounter` int(11) DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `dmthumbnail` text,
  `dmlastupdateon` datetime DEFAULT '0000-00-00 00:00:00',
  `dmlastupdateby` int(5) NOT NULL DEFAULT '-1',
  `dmsubmitedby` int(5) NOT NULL DEFAULT '-1',
  `dmmantainedby` int(5) DEFAULT '0',
  `dmlicense_id` int(5) DEFAULT '0',
  `dmlicense_display` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `attribs` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pub_appr_own_cat_name` (`published`,`approved`,`dmowner`,`catid`,`dmname`(64)),
  KEY `appr_pub_own_cat_date` (`approved`,`published`,`dmowner`,`catid`,`dmdate_published`),
  KEY `own_pub_appr_cat_count` (`dmowner`,`published`,`approved`,`catid`,`dmcounter`),
  KEY `own_pub_appr_cat_id` (`dmowner`,`published`,`approved`,`catid`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_joomdoc_groups` */

DROP TABLE IF EXISTS `jos_joomdoc_groups`;

CREATE TABLE `jos_joomdoc_groups` (
  `groups_id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_name` text NOT NULL,
  `groups_description` longtext,
  `groups_access` tinyint(4) NOT NULL DEFAULT '1',
  `groups_members` text,
  PRIMARY KEY (`groups_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_joomdoc_history` */

DROP TABLE IF EXISTS `jos_joomdoc_history`;

CREATE TABLE `jos_joomdoc_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `revision` int(5) NOT NULL DEFAULT '1',
  `his_date` datetime NOT NULL,
  `his_who` int(11) NOT NULL,
  `his_obs` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_joomdoc_licenses` */

DROP TABLE IF EXISTS `jos_joomdoc_licenses`;

CREATE TABLE `jos_joomdoc_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `license` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_joomdoc_log` */

DROP TABLE IF EXISTS `jos_joomdoc_log`;

CREATE TABLE `jos_joomdoc_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_docid` int(11) NOT NULL,
  `log_ip` text NOT NULL,
  `log_datetime` datetime NOT NULL,
  `log_user` int(11) NOT NULL DEFAULT '0',
  `log_browser` text,
  `log_os` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_jumi` */

DROP TABLE IF EXISTS `jos_jumi`;

CREATE TABLE `jos_jumi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `custom_script` text,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `published` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_menu` */

DROP TABLE IF EXISTS `jos_menu`;

CREATE TABLE `jos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `componentid` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL DEFAULT '0',
  `browserNav` tinyint(4) DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `utaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL DEFAULT '0',
  `rgt` int(11) unsigned NOT NULL DEFAULT '0',
  `home` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_menu_types` */

DROP TABLE IF EXISTS `jos_menu_types`;

CREATE TABLE `jos_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_messages` */

DROP TABLE IF EXISTS `jos_messages`;

CREATE TABLE `jos_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` int(11) NOT NULL DEFAULT '0',
  `priority` int(1) unsigned NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_messages_cfg` */

DROP TABLE IF EXISTS `jos_messages_cfg`;

CREATE TABLE `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_migration_backlinks` */

DROP TABLE IF EXISTS `jos_migration_backlinks`;

CREATE TABLE `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_modules` */

DROP TABLE IF EXISTS `jos_modules`;

CREATE TABLE `jos_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `numnews` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `control` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_modules_menu` */

DROP TABLE IF EXISTS `jos_modules_menu`;

CREATE TABLE `jos_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_newsfeeds` */

DROP TABLE IF EXISTS `jos_newsfeeds`;

CREATE TABLE `jos_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(11) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(11) unsigned NOT NULL DEFAULT '3600',
  `checked_out` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_phocadownload` */

DROP TABLE IF EXISTS `jos_phocadownload`;

CREATE TABLE `jos_phocadownload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sectionid` int(11) NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(250) NOT NULL DEFAULT '',
  `filesize` int(11) NOT NULL DEFAULT '0',
  `filename_play` varchar(250) NOT NULL DEFAULT '',
  `filename_preview` varchar(250) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  `author_email` varchar(255) NOT NULL DEFAULT '',
  `author_url` varchar(255) NOT NULL DEFAULT '',
  `license` varchar(255) NOT NULL DEFAULT '',
  `license_url` varchar(255) NOT NULL DEFAULT '',
  `image_filename` varchar(255) NOT NULL DEFAULT '',
  `image_filename_spec1` varchar(255) NOT NULL DEFAULT '',
  `image_filename_spec2` varchar(255) NOT NULL DEFAULT '',
  `image_download` varchar(255) NOT NULL DEFAULT '',
  `link_external` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `version` varchar(255) NOT NULL DEFAULT '',
  `directlink` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `textonly` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `confirm_license` int(11) NOT NULL DEFAULT '0',
  `unaccessible_file` int(11) NOT NULL DEFAULT '0',
  `params` text,
  `metakey` text,
  `metadesc` text,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_phocadownload_categories` */

DROP TABLE IF EXISTS `jos_phocadownload_categories`;

CREATE TABLE `jos_phocadownload_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `section` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `uploaduserid` text,
  `accessuserid` text,
  `deleteuserid` text,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text,
  `metakey` text,
  `metadesc` text,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_phocadownload_licenses` */

DROP TABLE IF EXISTS `jos_phocadownload_licenses`;

CREATE TABLE `jos_phocadownload_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_phocadownload_sections` */

DROP TABLE IF EXISTS `jos_phocadownload_sections`;

CREATE TABLE `jos_phocadownload_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` text,
  `scope` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text,
  `metakey` text,
  `metadesc` text,
  PRIMARY KEY (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_phocadownload_settings` */

DROP TABLE IF EXISTS `jos_phocadownload_settings`;

CREATE TABLE `jos_phocadownload_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `value` text,
  `values` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_phocadownload_user_stat` */

DROP TABLE IF EXISTS `jos_phocadownload_user_stat`;

CREATE TABLE `jos_phocadownload_user_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_plugins` */

DROP TABLE IF EXISTS `jos_plugins`;

CREATE TABLE `jos_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `folder` varchar(100) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_poll_data` */

DROP TABLE IF EXISTS `jos_poll_data`;

CREATE TABLE `jos_poll_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_poll_date` */

DROP TABLE IF EXISTS `jos_poll_date`;

CREATE TABLE `jos_poll_date` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL DEFAULT '0',
  `poll_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_poll_menu` */

DROP TABLE IF EXISTS `jos_poll_menu`;

CREATE TABLE `jos_poll_menu` (
  `pollid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_polls` */

DROP TABLE IF EXISTS `jos_polls`;

CREATE TABLE `jos_polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_sections` */

DROP TABLE IF EXISTS `jos_sections`;

CREATE TABLE `jos_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_session` */

DROP TABLE IF EXISTS `jos_session`;

CREATE TABLE `jos_session` (
  `username` varchar(150) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `usertype` varchar(50) DEFAULT '',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_stats_agents` */

DROP TABLE IF EXISTS `jos_stats_agents`;

CREATE TABLE `jos_stats_agents` (
  `agent` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_templates_menu` */

DROP TABLE IF EXISTS `jos_templates_menu`;

CREATE TABLE `jos_templates_menu` (
  `template` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `jos_users` */

DROP TABLE IF EXISTS `jos_users`;

CREATE TABLE `jos_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Table structure for table `jos_weblinks` */

DROP TABLE IF EXISTS `jos_weblinks`;

CREATE TABLE `jos_weblinks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
