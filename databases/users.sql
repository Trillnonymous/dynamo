CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL auto_increment,
	`fullname` varchar(100) NOT NULL default '',
	`username` varchar(40) NOT NULL default '',
	`groups` varchar(450) NOT NULL default '',
	`status` int(3) NOT NULL default '0',
	`isModerator` int(1) NOT NULL default '0',
	`isAdmin` int(1) NOT NULL default '0',
	`isGlobalModerator` int(1) NOT NULL default '0',
	PRIMARY KEY (`id`)
);
