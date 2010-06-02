CREATE TABLE `content` (
  `id` int(11) NOT NULL auto_increment,
  `tag` varchar(30) default NULL,
  `title` varchar(100) default NULL,
  `content` longtext,
  `perminate` int(1) NOT NULL,
  `has_sub_menu` int(1) NOT NULL,
  `sub_item_of` int(11) NOT NULL,
  `sort_order` int(11) default NULL,
  `module` int(1) NOT NULL,
  `template` varchar(100) default NULL,
  `created_datetime` int(11) NOT NULL default '0',
  `created_by` int(11) NOT NULL default '0',
  `updated_datetime` int(11) NOT NULL default '0',
  `updated_by` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `tag` (`tag`,`perminate`,`has_sub_menu`,`sub_item_of`,`sort_order`,`module`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL auto_increment,
  `group` varchar(100) default NULL,
  `tag` varchar(50) default NULL,
  `title` varchar(100) default NULL,
  `text` longtext,
  `value` longtext,
  `type` varchar(50) default NULL,
  `sortOrder` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `group` (`group`,`tag`),
  KEY `sortOrder` (`sortOrder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `settings` (`id`, `group`, `tag`, `title`, `text`, `value`, `type`, `sortOrder`) VALUES
(1, 'SEO', 'keywords', 'Keywords', NULL, '', 'textarea', 3),
(2, 'SEO', 'description', 'Description', NULL, '', 'textarea', 2),
(3, 'Analytics', 'analytics_google', 'Google Analytics', NULL, '', 'text', 1),
(4, 'Analytics', 'analytics_woopra', 'Woopra', NULL, 0, 'bool', 2),
(5, 'SEO', 'title', 'Site Title', NULL, '', 'text', 1),
(6, 'Contact Info', 'email', 'Email Address', NULL, '', 'text', 1),
(7, 'Contact Info', 'contact-subject', 'Contact Form Subject', NULL, '', 'text', 2),
(8, 'Social', 'twitterUser', 'Twitter Username', NULL, '', 'text', 1),
(9, 'Social', 'facebookUser', 'Facebook Username', NULL, '', 'text', 2),
(10, 'Social', 'flickrEmail', 'Flickr Email Address', NULL, '', 'text', 4);

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(100) default NULL,
  `lname` varchar(100) default NULL,
  `email_address` varchar(100) NOT NULL,
  `resetCode` varchar(100) default NULL,
  `created_datetime` int(11) NOT NULL default '0',
  `created_by` int(11) NOT NULL default '0',
  `updated_datetime` int(11) NOT NULL default '0',
  `updated_by` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `users` VALUES(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'User', 'admin@domain.com', null, 0, 0, 0, 0);

CREATE TABLE `users_privlages` (
  `userid` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  KEY `userid` (`userid`,`menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
