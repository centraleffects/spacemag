ALTER TABLE `shops` ADD `commission_article_sale` VARCHAR(5) NULL DEFAULT NULL AFTER `y_coordinate`, 
ADD `commission_salespot` VARCHAR(5) NULL DEFAULT NULL AFTER `commission_article_sale`;

------------------------
ALTER TABLE `shops` ADD `owner` INT(11) NULL AFTER `user_id`;

------------------------

UPDATE `users` SET `lang` = 'sv'

------------------------

ALTER TABLE `article_prices` CHANGE `status` `status` INT(1) NOT NULL DEFAULT '0';

------------------------

ALTER TABLE `shop_coupons` ADD `code` VARCHAR(100) NOT NULL AFTER `shop_id`;

------------------------

ALTER TABLE `shop_coupons` CHANGE `date_start` `date_start` DATE NULL DEFAULT NULL, CHANGE `date_end` `date_end` DATE NULL DEFAULT NULL;