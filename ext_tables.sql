#
# Table structure for table 'tx_news_domain_model_news'
#

CREATE TABLE tx_news_domain_model_news (
	comments_enabled tinyint(1) unsigned DEFAULT '1' NOT NULL,
);

CREATE TABLE sys_category (
	vanilla_forum_id int(11) unsigned DEFAULT '0' NOT NULL,
);
