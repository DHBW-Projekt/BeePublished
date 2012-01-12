SET FOREIGN_KEY_CHECKS=0;DROP TABLE IF EXISTS configurations ;

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(30) DEFAULT NULL,
  `firstName` varchar(30) DEFAULT NULL,
  `eMail` varchar(60) DEFAULT NULL,
  `street` varchar(30) DEFAULT NULL,
  `houseNumber` int(4) DEFAULT NULL,
  `postCode` varchar(10) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `companyName` varchar(60) DEFAULT NULL,
  `legalForm` varchar(30) DEFAULT NULL,
  `vatId` varchar(30) DEFAULT NULL,
  `registerNumber` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `activeDesign` varchar(30) DEFAULT NULL,
  `activeTemplate` varchar(30) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS containers ;

CREATE TABLE `containers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `layout_type_id` int(11) DEFAULT NULL,
  `column` int(1) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `layout_id` (`layout_type_id`),
  KEY `parent_id` (`parent_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `containers_ibfk_3` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `containers_ibfk_1` FOREIGN KEY (`layout_type_id`) REFERENCES `layout_types` (`id`),
  CONSTRAINT `containers_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `containers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

INSERT INTO containers VALUES("71","","22","","0","0");
INSERT INTO containers VALUES("72","","23","","0","0");
INSERT INTO containers VALUES("73","72","","1","1","1");



DROP TABLE IF EXISTS content_values ;

CREATE TABLE `content_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `key` varchar(150) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `plugin_view_value_id` (`key`),
  CONSTRAINT `content_values_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS contents ;

CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_id` int(11) NOT NULL,
  `column` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `plugin_view_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `container_id` (`container_id`),
  KEY `plugin_id` (`plugin_view_id`),
  CONSTRAINT `contents_ibfk_4` FOREIGN KEY (`plugin_view_id`) REFERENCES `plugin_views` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contents_ibfk_3` FOREIGN KEY (`container_id`) REFERENCES `containers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

INSERT INTO contents VALUES("26","73","1","1","5");



DROP TABLE IF EXISTS gallery_entries ;

CREATE TABLE `gallery_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `gallery_picture_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS gallery_pictures ;

CREATE TABLE `gallery_pictures` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `path_to_pic` varchar(255) NOT NULL,
  `gallery_entry_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS google_maps_locations ;

CREATE TABLE `google_maps_locations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content_id` int(10) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `street_number` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO google_maps_locations VALUES("1","0","Deutschland","65451","Kelsterbach","Karlsbader Str.","11");



DROP TABLE IF EXISTS guestbook_entries ;

CREATE TABLE `guestbook_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS guestbook_posts ;

CREATE TABLE `guestbook_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(60) NOT NULL,
  `title` varchar(90) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  `released` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO guestbook_posts VALUES("1","horido","Horido","Fuck you!","2012-01-12 09:36:35","0000-00-00 00:00:00","0000-00-00 00:00:00");



DROP TABLE IF EXISTS i18n ;

CREATE TABLE `i18n` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS layout_types ;

CREATE TABLE `layout_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `columns` int(11) NOT NULL,
  `weight` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO layout_types VALUES("1","50:50 Teilung","","0","50:50");
INSERT INTO layout_types VALUES("2","33:66 Teilung","","0","33:66");
INSERT INTO layout_types VALUES("3","25:75 Teilung","","0","25:75");
INSERT INTO layout_types VALUES("4","Golder Schnitt links","","0","38:62");
INSERT INTO layout_types VALUES("5","66:33 Teilung","","0","66:33");
INSERT INTO layout_types VALUES("6","75:25 Teilung","","0","75:25");
INSERT INTO layout_types VALUES("7","Goldener Schnitt rechts","","0","62:38");
INSERT INTO layout_types VALUES("8","3 Spalten selbe Größe","","0","33:33:33");



DROP TABLE IF EXISTS log_entries ;

CREATE TABLE `log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ipaddress` int(11) NOT NULL,
  `action` tinyint(1) NOT NULL,
  `actionDate` datetime NOT NULL,
  `object_class` varchar(150) NOT NULL,
  `object_id` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS menu_entries ;

CREATE TABLE `menu_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `validFrom` datetime NOT NULL,
  `validTo` datetime NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `role_id` (`role_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `menu_entries_ibfk_5` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_entries_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `menu_entries_ibfk_4` FOREIGN KEY (`parent_id`) REFERENCES `menu_entries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

INSERT INTO menu_entries VALUES("63","","2","22","Home","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0");
INSERT INTO menu_entries VALUES("64","63","2","23","guestbook","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0");



DROP TABLE IF EXISTS pages ;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `validFrom` datetime NOT NULL,
  `validTo` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `metaTags` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateLastChange` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO pages VALUES("22","4","Home","/home","0000-00-00 00:00:00","0000-00-00 00:00:00","0","","0000-00-00 00:00:00","0000-00-00 00:00:00","");
INSERT INTO pages VALUES("23","4","guestbook","/gb","0000-00-00 00:00:00","0000-00-00 00:00:00","0","","0000-00-00 00:00:00","0000-00-00 00:00:00","");



DROP TABLE IF EXISTS permissions ;

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `permissions_ibfk_3` FOREIGN KEY (`plugin_id`) REFERENCES `plugins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO permissions VALUES("10","20","4","Write");
INSERT INTO permissions VALUES("11","20","6","Publish");
INSERT INTO permissions VALUES("12","20","2","save");
INSERT INTO permissions VALUES("13","20","5","release");
INSERT INTO permissions VALUES("14","20","6","delete");



DROP TABLE IF EXISTS plugin_views ;

CREATE TABLE `plugin_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`),
  CONSTRAINT `plugin_views_ibfk_1` FOREIGN KEY (`plugin_id`) REFERENCES `plugins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO plugin_views VALUES("1","19","Location");
INSERT INTO plugin_views VALUES("2","19","Route");
INSERT INTO plugin_views VALUES("5","20","Guestbook");



DROP TABLE IF EXISTS plugins ;

CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `schema` tinyint(1) NOT NULL,
  `routing` tinyint(1) NOT NULL,
  `version` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO plugins VALUES("19","GoogleMaps","1","1","1.0","Patrick Zamzow");
INSERT INTO plugins VALUES("20","Guestbook","1","0","1.0","Sebastian Haase");
INSERT INTO plugins VALUES("21","StaticText","0","1","1.0","Christoph KrÃ¤mer");



DROP TABLE IF EXISTS roles ;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO roles VALUES("2","3","Guest");
INSERT INTO roles VALUES("3","4","Registered");
INSERT INTO roles VALUES("4","5","Author");
INSERT INTO roles VALUES("5","6","Editor");
INSERT INTO roles VALUES("6","7","Administrator");
INSERT INTO roles VALUES("7","","Super-Adminsitrator");



DROP TABLE IF EXISTS users ;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `registered` datetime NOT NULL,
  `confirmation_token` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("1","2","christoph","9617b34607ee4ef23ee07b341de5a7ca26ede8c7","christoph@christophkraemer.de","2012-01-02 11:32:57","0000-00-00 00:00:00","","1");
INSERT INTO users VALUES("2","7","test123","e84f100d33cda3f881fe00a334e9dd941dfe2d15","christoph@christophkraemer.de","0000-00-00 00:00:00","2011-12-08 12:26:59","aaaf13160053ec8e18083ecfeb79a2ed34f7f32b","0");
INSERT INTO users VALUES("3","3","blubb","39bd73dac29aa4190d929fc2ce056dcd31bb4585","test@test.de","2011-12-08 12:44:50","2011-12-08 12:44:38","064acc795ba7d0834d6cafad0ff2b65fbf42e676","0");
INSERT INTO users VALUES("4","7","alex_m","b9c66d0192cca90fbc63ccb596b6f35b1b78ae91","alexan.chr.mueller@googlemail.com","2012-01-12 09:34:25","2012-01-12 09:31:08","e92df69e53f0c0dbf8016d8dc2bf3638eaa89094","0");



