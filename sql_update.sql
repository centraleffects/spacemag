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

------------------------

RENAME TABLE `rebuy`.`article_tags` TO `rebuy`.`article_tag`;

--##----------------------

ALTER TABLE `notes` ADD `author_id` INT(11) NOT NULL AFTER `user_id`;

ALTER TABLE `notes` ADD CONSTRAINT `notes_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--------------

ALTER TABLE `article_labels` DROP FOREIGN KEY `article_labels_media_type_id_foreign`;

----

DROP TABLE `label_media_types`

--- 

ALTER TABLE `article_labels` ADD `print_medium` VARCHAR(50) NOT NULL AFTER `filename`;

---- 

ALTER TABLE `article_labels` ADD `sample_picture` VARCHAR(50) NOT NULL AFTER `filename`;

----

ALTER TABLE `salespots` ADD `article_id` INT(10) NOT NULL AFTER `shop_id`;