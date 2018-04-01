CREATE TABLE IF NOT EXISTS `rooms` (
	`id` int(11) NOT NULL auto_increment,
	`name` varchar(50) NOT NULL default '',
	`title` varchar(250) NOT NULL default '',
	`users` int(3) NOT NULL default '0',
	PRIMARY KEY (`id`)
);
