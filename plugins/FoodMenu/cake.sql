-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 19. Dezember 2011 um 22:38
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `cake`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `configurations`
--

CREATE TABLE IF NOT EXISTS `configurations` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `configurations`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `containers`
--

CREATE TABLE IF NOT EXISTS `containers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `layout_type_id` int(11) DEFAULT NULL,
  `column` int(1) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `layout_id` (`layout_type_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `containers`
--

INSERT INTO `containers` (`id`, `parent_id`, `layout_type_id`, `column`, `order`) VALUES
(1, NULL, NULL, 0, 0),
(4, 1, 8, 1, 1),
(5, 1, 5, 1, 2),
(6, 5, 1, 1, 2),
(7, NULL, 8, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_id` int(11) NOT NULL,
  `column` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `plugin_id` int(11) DEFAULT NULL,
  `view_name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `container_id` (`container_id`),
  KEY `plugin_id` (`plugin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `contents`
--

INSERT INTO `contents` (`id`, `container_id`, `column`, `order`, `plugin_id`, `view_name`) VALUES
(1, 4, 1, 1, NULL, ''),
(3, 4, 3, 1, 19, 'Route'),
(4, 5, 1, 1, 19, 'Location'),
(5, 5, 2, 1, NULL, ''),
(6, 5, 2, 2, NULL, ''),
(7, 6, 1, 1, NULL, ''),
(8, 6, 2, 1, NULL, ''),
(9, 7, 1, 1, NULL, ''),
(10, 7, 2, 1, NULL, ''),
(11, 7, 3, 1, NULL, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `content_values`
--

CREATE TABLE IF NOT EXISTS `content_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `content_values`
--

INSERT INTO `content_values` (`id`, `content_id`, `key`, `value`) VALUES
(2, 4, 'LocationID', '1'),
(3, 3, 'LocationID', '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `food_menu_categories`
--

CREATE TABLE IF NOT EXISTS `food_menu_categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `food_menu_categories`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `food_menu_categories_food_menu_entries`
--

CREATE TABLE IF NOT EXISTS `food_menu_categories_food_menu_entries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `food_menu_category_id` int(11) NOT NULL,
  `food_menu_entry_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `food_menu_categories_food_menu_entries`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `food_menu_entries`
--

CREATE TABLE IF NOT EXISTS `food_menu_entries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float(5,2) NOT NULL,
  `currency` varchar(3) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `food_menu_entries`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `food_menu_menus`
--

CREATE TABLE IF NOT EXISTS `food_menu_menus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `food_menu_series_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `food_menu_menus`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `food_menu_menus_food_menu_categories`
--

CREATE TABLE IF NOT EXISTS `food_menu_menus_food_menu_categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `food_menu_menu_id` int(11) NOT NULL,
  `food_menu_category_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `food_menu_menus_food_menu_categories`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `food_menu_series`
--

CREATE TABLE IF NOT EXISTS `food_menu_series` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `seriesValue` int(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `food_menu_series`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `google_maps_locations`
--

CREATE TABLE IF NOT EXISTS `google_maps_locations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content_id` int(10) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `street_number` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `google_maps_locations`
--

INSERT INTO `google_maps_locations` (`id`, `content_id`, `country`, `zip_code`, `city`, `street`, `street_number`) VALUES
(1, 0, 'Deutschland', 65451, 'Kelsterbach', 'Karlsbader Str.', '11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `guestbook_entries`
--

CREATE TABLE IF NOT EXISTS `guestbook_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `guestbook_entries`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `i18n`
--

CREATE TABLE IF NOT EXISTS `i18n` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `i18n`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `layout_types`
--

CREATE TABLE IF NOT EXISTS `layout_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `columns` int(11) NOT NULL,
  `weight` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `layout_types`
--

INSERT INTO `layout_types` (`id`, `name`, `description`, `columns`, `weight`) VALUES
(1, '50:50 Teilung', '', 0, '50:50'),
(2, '33:66 Teilung', '', 0, '33:66'),
(3, '25:75 Teilung', '', 0, '25:75'),
(4, 'Golder Schnitt links', '', 0, '38:62'),
(5, '66:33 Teilung', '', 0, '66:33'),
(6, '75:25 Teilung', '', 0, '77:25'),
(7, 'Goldener Schnitt rechts', '', 0, '62:38'),
(8, '3 Spalten selbe Größe', '', 0, '33:33:33');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `log_entries`
--

CREATE TABLE IF NOT EXISTS `log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ipaddress` int(11) NOT NULL,
  `action` tinyint(1) NOT NULL,
  `actionDate` datetime NOT NULL,
  `object_class` varchar(150) NOT NULL,
  `object_id` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `log_entries`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_entries`
--

CREATE TABLE IF NOT EXISTS `menu_entries` (
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
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `menu_entries`
--

INSERT INTO `menu_entries` (`id`, `parent_id`, `role_id`, `page_id`, `name`, `published`, `validFrom`, `validTo`, `order`) VALUES
(1, NULL, 2, 2, 'test', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 1, 2, 1, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, NULL, 2, 1, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, NULL, 2, 1, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 1, 2, 1, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, NULL, 2, NULL, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 6, 2, NULL, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 8, 2, NULL, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(10, 9, 2, NULL, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_id` int(11) DEFAULT NULL,
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
  KEY `container_id` (`container_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `pages`
--

INSERT INTO `pages` (`id`, `container_id`, `user_id`, `title`, `name`, `validFrom`, `validTo`, `published`, `metaTags`, `dateCreated`, `dateLastChange`, `description`) VALUES
(1, 1, 1, 'Test-Page', '/', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(2, 7, 1, 'Patricks Beispiel', '/test/test', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `permissions`
--

INSERT INTO `permissions` (`id`, `plugin_id`, `role_id`, `action`) VALUES
(10, 20, 4, 'Write'),
(11, 20, 6, 'Publish');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `schema` tinyint(1) NOT NULL,
  `routing` tinyint(1) NOT NULL,
  `version` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Daten für Tabelle `plugins`
--

INSERT INTO `plugins` (`id`, `name`, `schema`, `routing`, `version`, `author`) VALUES
(19, 'GoogleMaps', 1, 0, '1.0', 'Patrick Zamzow'),
(20, 'Guestbook', 1, 1, '1.0', 'Christoph KrÃ¤mer'),
(21, 'StaticText', 0, 0, '1.0', 'Christoph KrÃ¤mer'),
(24, 'FoodMenu', 1, 1, '1.0', 'Benedikt Steffan');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`) VALUES
(2, NULL, 'Gast'),
(3, 2, 'Registriert'),
(4, 3, 'Autor'),
(5, 4, 'Editor'),
(6, 5, 'Administrator'),
(7, 6, 'Super-Adminsitrator');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `last_login`, `registered`, `confirmation_token`, `status`) VALUES
(1, 2, 'christoph', '9617b34607ee4ef23ee07b341de5a7ca26ede8c7', 'christoph@christophkraemer.de', '2011-12-09 10:06:26', '0000-00-00 00:00:00', '', 1),
(2, 7, 'test123', 'e84f100d33cda3f881fe00a334e9dd941dfe2d15', 'christoph@christophkraemer.de', '0000-00-00 00:00:00', '2011-12-08 12:26:59', 'aaaf13160053ec8e18083ecfeb79a2ed34f7f32b', 0),
(3, 3, 'blubb', '39bd73dac29aa4190d929fc2ce056dcd31bb4585', 'test@test.de', '2011-12-08 12:44:50', '2011-12-08 12:44:38', '064acc795ba7d0834d6cafad0ff2b65fbf42e676', 0);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `containers`
--
ALTER TABLE `containers`
  ADD CONSTRAINT `containers_ibfk_1` FOREIGN KEY (`layout_type_id`) REFERENCES `layout_types` (`id`),
  ADD CONSTRAINT `containers_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `containers` (`id`);

--
-- Constraints der Tabelle `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`container_id`) REFERENCES `containers` (`id`),
  ADD CONSTRAINT `contents_ibfk_2` FOREIGN KEY (`plugin_id`) REFERENCES `plugins` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `content_values`
--
ALTER TABLE `content_values`
  ADD CONSTRAINT `content_values_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `log_entries`
--
ALTER TABLE `log_entries`
  ADD CONSTRAINT `log_entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `menu_entries`
--
ALTER TABLE `menu_entries`
  ADD CONSTRAINT `menu_entries_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menu_entries` (`id`),
  ADD CONSTRAINT `menu_entries_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `menu_entries_ibfk_3` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`);

--
-- Constraints der Tabelle `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`container_id`) REFERENCES `containers` (`id`),
  ADD CONSTRAINT `pages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `permissions_ibfk_3` FOREIGN KEY (`plugin_id`) REFERENCES `plugins` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `roles` (`id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
