CREATE TABLE IF NOT EXISTS `#__wishboxcdek_cities` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `code` int(11) NOT NULL,
    `fullname` varchar(255) NOT NULL,
    `cityname` varchar(255) NOT NULL,
    `sub_region` varchar(255) NOT NULL,
    `oblname` varchar(255) NOT NULL,
    `countrycode` varchar(50) NOT NULL,
    `nalsumlimit` varchar(255) NOT NULL,
    `longitude` double(11,7) NOT NULL,
    `latitude` double(11,7) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__wishboxcdek_offices` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `code` varchar(10) NOT NULL,
     `country_code` varchar(2) NOT NULL,
     `region_code` int(9) NOT NULL,
     `city_code` int(11) NOT NULL,
     `city` varchar(50) NOT NULL,
     `work_time` varchar(100) NOT NULL,
     `address` varchar(255) NOT NULL,
     `address_full` varchar(255) NOT NULL,
     `phone` varchar(255) NOT NULL,
     `note` varchar(255) NOT NULL,
     `location_longitude` decimal(11,8) NOT NULL,
     `location_latitude` decimal(11,8) NOT NULL,
     `type` varchar(8) NOT NULL,
     `owner_code` varchar(255) NOT NULL,
     `is_dressing_room` varchar(4) NOT NULL,
     `have_cashless` varchar(4) NOT NULL,
     `allowed_cod` varchar(255) NOT NULL,
     `nearest_station` varchar(255) NOT NULL,
     `nearest_metro_station` varchar(50) DEFAULT NULL,
     `site` varchar(255) NOT NULL,
     `office_images_list` text NOT NULL,
     `work_time_list` varchar(255) NOT NULL,
     `weight_min` float NOT NULL,
     `weight_max` float NOT NULL,
     `dimensions` text,
     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__wishboxcdek_statuses` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `code` int(11) NOT NULL,
      `description` varchar(255) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__wishboxcdek_tariffs` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `code` int(11) NOT NULL,
     `published` tinyint(1) NOT NULL,
     `name` varchar(255) NOT NULL,
     `mode` int(11) NOT NULL,
     `weight_limit` varchar(255) NOT NULL,
     `service` varchar(255) NOT NULL,
     `description` varchar(255) NOT NULL,
     PRIMARY KEY (`id`),
     UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__wishboxcdek_tariff_modes` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `code` int(11) NOT NULL,
    `title` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__wishboxcdek_tariff_modes` (`code`, `title`) VALUES
 (1, 'дверь-дверь'),
 (2, 'двер-склад'),
 (3, 'склад-дверь'),
 (4, 'склад-склад'),
 (6, 'дверь-посамат'),
 (7, 'склад-постаат'),
 (8, 'постамат-двер'),
 (9, 'постамат-склад'),
 (10, 'постамат-постамат');