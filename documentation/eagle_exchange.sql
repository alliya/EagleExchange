CREATE DATABASE eagle_exchange;
USE eagle_exchange;

CREATE TABLE `users` (
	`id` int(6) NOT NULL,
	`first_name` varchar(255) COLLATE utf8_unicode_ci,
	`last_name` varchar(255) COLLATE utf8_unicode_ci,
	`obf_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`email` varchar(255) COLLATE utf8_unicode_ci,
	`password` char(64) COLLATE utf8_unicode_ci NOT NULL,
	`contact_number` varchar(12) DEFAULT '0',
	`image` text COLLATE utf8_unicode_ci,
	`reputation` int(1) DEFAULT 0,
	`salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
	`type` enum("NORMAL", "ADMIN") DEFAULT "NORMAL",
	PRIMARY KEY (`id`),
	UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `auction` (
	`id` int(12) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`seller_id` int(6) NOT NULL,
	`category` text COLLATE utf8_unicode_ci NOT NULL,
	`condition` enum("NEW","USED") DEFAULT "NEW",
	`duration` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`price` int(12) NOT NULL DEFAULT 0,
	`images` text COLLATE utf8_unicode_ci,
	`description` text COLLATE utf8_unicode_ci DEFAULT '',
	`status` enum("CANCELLED", "EXPIRED", "ONGOING", "SOLD") DEFAULT "ONGOING",
	`buyer_id` int(6),
	PRIMARY KEY (`id`)
);

CREATE TABLE `bid` (
	`id` int(12) NOT NULL AUTO_INCREMENT,
	`amount` int(12) NOT NULL DEFAULT 0,
	`bid_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`user_id` int(6) NOT NULL,
	`auction_id` int(12) NOT NULL,
	PRIMARY KEY (`id`)
);
