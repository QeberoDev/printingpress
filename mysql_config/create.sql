DROP DATABASE IF EXISTS printingpress_test;
CREATE DATABASE IF NOT EXISTS printingpress_test DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

use printingpress_test;

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` ( 
	`customer_id` INT NOT NULL AUTO_INCREMENT, 
	`name` VARCHAR(128) NOT NULL , 
	`phonenumber` VARCHAR(13) NOT NULL UNIQUE, 
	`address` VARCHAR(256) NULL DEFAULT NULL , 
	`email` VARCHAR(250) NULL DEFAULT NULL , 
	PRIMARY KEY (`customer_id`), 
	UNIQUE (`phonenumber`, `email`)
) ENGINE = InnoDB; 

DROP TABLE IF EXISTS `employee_type`;
CREATE TABLE IF NOT EXISTS `employee_type` (
	`employee_type_id` int(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(40) NOT NULL,
	`description` TEXT NOT NULL,
	PRIMARY KEY (`employee_type_id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `employee_type_id` varchar(40) NOT NULL,
  `address` varchar(256) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY (`phone_number`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` ( 
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`employee_id` INT NOT NULL,
	`username` VARCHAR(64) NOT NULL,
	`password` VARCHAR(128) NOT NULL,
	`created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`active` BOOLEAN NOT NULL DEFAULT TRUE,
	PRIMARY KEY (`user_id`),
	UNIQUE (`employee_id`, `username`),
	FOREIGN KEY (`employee_id`) REFERENCES employee(`employee_id`)
	ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
	`user_role_id` INT NOT NULL AUTO_INCREMENT,
	`name` INT NOT NULL,
	`description` TEXT NULL,
	PRIMARY KEY (`user_role_id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `user_role_map`;
CREATE TABLE `user_role_map` (
	`user_id` INT NOT NULL,
	`user_role_id` INT NOT NULL,
	FOREIGN KEY (`user_id`) REFERENCES user(`user_id`),
	FOREIGN KEY (`user_role_id`) REFERENCES user_role(`user_role_id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
	`order_id` INT NOT NULL AUTO_INCREMENT,
	`customer_id` INT NOT NULL,
	`cashier_id` INT NOT NULL,
	`order_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`order_id`),
	FOREIGN KEY (`customer_id`) REFERENCES customer(`customer_id`),
	FOREIGN KEY (`cashier_id`) REFERENCES employee(`employee_id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_type`;
CREATE TABLE IF NOT EXISTS `order_type` (
	`order_type_id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`order_type_id`),
	UNIQUE (`name`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_type_map`;
CREATE TABLE IF NOT EXISTS `order_type_map` (
	`order_id` INT NOT NULL,
	`employee_id` INT NOT NULL,
	`order_type_id` INT NOT NULL,
	`unit_price` DOUBLE NOT NULL,
	`amount` INT NOT NULL,
	FOREIGN KEY (`order_id`) REFERENCES `order`(`order_id`),
	FOREIGN KEY (`employee_id`) REFERENCES employee(`employee_id`),
	FOREIGN KEY (`order_type_id`) REFERENCES order_type(`order_type_id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
	`username` VARCHAR(64) NOT NULL,
	`password` VARCHAR(64) NOT NULL,
	`created_date` TIMESTAMP NOT NULL
) ENGINE = InnoDB;