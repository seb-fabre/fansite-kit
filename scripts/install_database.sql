{CREATE_DATABASE}
DROP DATABASE IF EXISTS {DBNAME};

CREATE DATABASE {DBNAME};

USE {DBNAME};
{CREATE_DATABASE}

SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET AUTOCOMMIT=0;
START TRANSACTION;

CREATE TABLE IF NOT EXISTS `blacklist` (
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `pseudo` tinytext NOT NULL,
  `email` tinytext,
  `comment` mediumtext NOT NULL,
  `response` mediumint(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=432 ;

CREATE TABLE IF NOT EXISTS `commentsphoto` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `comment` tinytext,
  `user_id` int(9) NOT NULL DEFAULT '0',
  `image_id` int(9) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `dictionary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` char(2) NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `views` mediumint(9) NOT NULL DEFAULT '0',
  `user_id` int(9) NOT NULL DEFAULT '0',
  `gallery_id` int(9) DEFAULT NULL,
  `has_images` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=206 ;

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `gallery_id` int(9) NOT NULL DEFAULT '0',
  `views` mediumint(9) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `user_id` int(9) NOT NULL DEFAULT '0',
  `totalnotes` mediumint(9) DEFAULT '0',
  `totalvotes` mediumint(9) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gallery_id` (`gallery_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3852 ;

CREATE TABLE IF NOT EXISTS `liens` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `url` varchar(250) NOT NULL,
  `texte_alt` tinytext NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

CREATE TABLE IF NOT EXISTS `referrer` (
  `url` text NOT NULL,
  `cpt` mediumint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `spam_comm` (
  `texte` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user` (
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

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `user_id` int(9) NOT NULL DEFAULT '0',
  `resolution` varchar(7) NOT NULL DEFAULT '0x0',
  `duree` time NOT NULL,
  `description` text NOT NULL,
  `views` int(11) NOT NULL,
  `totalnotes` mediumint(9) NOT NULL DEFAULT '0',
  `totalvotes` mediumint(9) NOT NULL DEFAULT '0',
  `extras` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

INSERT INTO user(id, login, email, password, is_admin, is_active, is_banned, is_superadmin)
  VALUES (1, "{SUPERADMIN_LOGIN}", "{SUPERADMIN_EMAIL}", ENCODE("{SUPERADMIN_PASSWORD}", "vaihere"), 1, 1, 0, 1);

ALTER TABLE `commentsphoto`
  ADD CONSTRAINT `commentsphoto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `commentsphoto_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `image_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

SET FOREIGN_KEY_CHECKS=1;

COMMIT;
