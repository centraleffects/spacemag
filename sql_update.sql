ALTER TABLE `shops` ADD `commission_article_sale` VARCHAR(5) NULL DEFAULT NULL AFTER `y_coordinate`, 
ADD `commission_salespot` VARCHAR(5) NULL DEFAULT NULL AFTER `commission_article_sale`;

------------------------
ALTER TABLE `shops` ADD `owner` INT(11) NULL AFTER `user_id`;