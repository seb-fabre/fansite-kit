{CREATE_DATABASE}
DROP DATABASE IF EXISTS {DBNAME};

CREATE DATABASE {DBNAME};

USE {DBNAME};
{CREATE_DATABASE}

SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET AUTOCOMMIT=0;
START TRANSACTION;

CREATE TABLE IF NOT EXISTS `fan_blacklist` (
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `fan_commentaires` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `pseudo` tinytext NOT NULL,
  `email` tinytext,
  `comment` mediumtext NOT NULL,
  `response` mediumint(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=432 ;

CREATE TABLE IF NOT EXISTS `fan_commentsphoto` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `comment` tinytext,
  `fan_user_id` int(9) NOT NULL DEFAULT '0',
  `fan_image_id` int(9) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `fan_user_id` (`fan_user_id`),
  KEY `fan_image_id` (`fan_image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `fan_params` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `fan_dictionary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` char(2) NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `fan_gallery` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `views` mediumint(9) NOT NULL DEFAULT '0',
  `fan_user_id` int(9) NOT NULL DEFAULT '0',
  `fan_gallery_id` int(9) DEFAULT NULL,
  `has_images` tinyint(4) NOT NULL,
  `ancestors` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fan_user_id` (`fan_user_id`),
  KEY `fan_gallery_id` (`fan_gallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=206 ;

CREATE TABLE IF NOT EXISTS `fan_image` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `fan_gallery_id` int(9) NOT NULL DEFAULT '0',
  `views` mediumint(9) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `fan_user_id` int(9) NOT NULL DEFAULT '0',
  `totalnotes` mediumint(9) DEFAULT '0',
  `totalvotes` mediumint(9) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fan_gallery_id` (`fan_gallery_id`),
  KEY `fan_user_id` (`fan_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3852 ;

CREATE TABLE IF NOT EXISTS `fan_liens` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `url` varchar(250) NOT NULL,
  `texte_alt` tinytext NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

CREATE TABLE IF NOT EXISTS `fan_news` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `fan_user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fan_user_id` (`fan_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

CREATE TABLE IF NOT EXISTS `fan_referrer` (
  `url` text NOT NULL,
  `cpt` mediumint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `fan_spam_comm` (
  `texte` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `fan_user` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` blob NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL,
  `is_banned` tinyint(4) NOT NULL,
  `is_superadmin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

CREATE TABLE IF NOT EXISTS `fan_video` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `fan_user_id` int(9) NOT NULL DEFAULT '0',
  `resolution` varchar(7) NOT NULL DEFAULT '0x0',
  `duree` time NOT NULL,
  `description` text NOT NULL,
  `views` int(11) NOT NULL,
  `totalnotes` mediumint(9) NOT NULL DEFAULT '0',
  `totalvotes` mediumint(9) NOT NULL DEFAULT '0',
  `extras` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fan_user_id` (`fan_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

CREATE TABLE IF NOT EXISTS `fan_translation` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `context_id` int(10) unsigned NOT NULL default '0',
  `context_classname` varchar(255) NOT NULL default '',
  `context_field` varchar(255) default NULL,
  `locale` varchar(5) NOT NULL,
  `translated_str` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO fan_user(id, login, email, password, is_admin, is_active, is_banned, is_superadmin)
  VALUES (1, "{SUPERADMIN_LOGIN}", "{SUPERADMIN_EMAIL}", ENCODE("{SUPERADMIN_PASSWORD}", "vaihere"), 1, 1, 0, 1);

ALTER TABLE `fan_commentsphoto`
  ADD CONSTRAINT `commentsphoto_ibfk_1` FOREIGN KEY (`fan_user_id`) REFERENCES `fan_user` (`id`),
  ADD CONSTRAINT `commentsphoto_ibfk_2` FOREIGN KEY (`fan_image_id`) REFERENCES `fan_image` (`id`);

ALTER TABLE `fan_gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`fan_gallery_id`) REFERENCES `fan_gallery` (`id`),
  ADD CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`fan_user_id`) REFERENCES `fan_user` (`id`);

ALTER TABLE `fan_image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`fan_gallery_id`) REFERENCES `fan_gallery` (`id`),
  ADD CONSTRAINT `image_ibfk_2` FOREIGN KEY (`fan_user_id`) REFERENCES `fan_user` (`id`);

ALTER TABLE `fan_news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`fan_user_id`) REFERENCES `fan_user` (`id`);

ALTER TABLE `fan_video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`fan_user_id`) REFERENCES `fan_user` (`id`);

SET FOREIGN_KEY_CHECKS=1;

COMMIT;
