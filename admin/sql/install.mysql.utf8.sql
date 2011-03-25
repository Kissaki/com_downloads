


CREATE TABLE `#__downloads_categories` (
  `cid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `desc` text,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;



CREATE TABLE `#__downloads_downloads` (
  `dlid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` text,
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `homepage` varchar(100) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `rating` double unsigned NOT NULL DEFAULT '0',
  `nr_ratings` int(10) unsigned NOT NULL DEFAULT '0',
  `nr_files` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `nr_comments` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`dlid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;



CREATE TABLE `#__downloads_files` (
  `fid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dlid` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `url` varchar(250) NOT NULL,
  `filepath` varchar(250) DEFAULT NULL,
  `size` int(10) unsigned DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `order` mediumint(3) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

