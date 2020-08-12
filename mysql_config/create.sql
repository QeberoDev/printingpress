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
	UNIQUE (`phonenumber`)
) ENGINE = MyISAM; 

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
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` ( 
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`employee_id` INT NOT NULL,
	`username` VARCHAR(64) NOT NULL UNIQUE,
	`password` VARCHAR(128) NOT NULL,
	`account_type` INT NOT NULL,
	`created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`user_id`),
	UNIQUE (`employee_id`),
	INDEX `emp_id` (`employee_id`),
    FOREIGN KEY (`employee_id`)
        REFERENCES employee(employee_id)
        ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = MyISAM; 

DROP TABLE IF EXISTS `order_options`;
CREATE TABLE `order_options` (
	`order_id` INT NOT NULL,
	`worker_id` INT NULL,
	`editor_id` INT NULL,
	`order_type_id` INT NOT NULL
);