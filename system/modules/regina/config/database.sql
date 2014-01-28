CREATE TABLE `tl_regina` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `tstamp` int(10) unsigned NOT NULL default '0',

  `width` int(10) unsigned NOT NULL default '500',
  `height` int(10) unsigned NOT NULL default '500',
  `resize` char(1) NOT NULL default '',
  `scaleImg` char(1) NOT NULL default '',
  `quality` int(10) unsigned NOT NULL default '95',
  `imgType` varchar(25) NOT NULL default 'jpeg',
  `lazyLoad` char(1) NOT NULL default '',
  `position` char(1) NOT NULL default '',
  `grayscaleActive` char(1) NOT NULL default '',
  `visibility` int(10) unsigned NOT NULL default '100',
  `transcolor` varchar(6) NOT NULL default '000000',
  `constraints` varchar(25) NOT NULL default 'both',
  `slice` varchar(25) NOT NULL default '',
  `croping` varchar(25) NOT NULL default '',

  `textUseActive` char(1) NOT NULL default '',
  `fontSize` int(10) unsigned NOT NULL default '12',
  `fontColor` varchar(6) NOT NULL default '000000',
  `fontNormal` varchar(255) NOT NULL default '',
  `fontBold` varchar(255) NOT NULL default '',
  `textBoxUse` char(1) NOT NULL default '',
  `textBoxOffset` varchar(30) NOT NULL default '-1, 7, 6, 7',
  `textBoxBGColor` varchar(6) NOT NULL default 'FFFFFF',
  `textPadding` int(11) NOT NULL default '7',
  `textBoxHeight` int(10) unsigned NOT NULL default '31',
  `textAlign` varchar(5) NOT NULL default 'c',
  `textCase` varchar(5) NOT NULL default '',
  `textTransparency` int(10) unsigned NOT NULL default '90',
  `textFactor` int(10) unsigned NOT NULL default '1',

  `useExtraImage` char(1) NOT NULL default '',
  `addImage` text NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `tl_content` (
  `imageSizeType` varchar(50) NOT NULL default 'default'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;