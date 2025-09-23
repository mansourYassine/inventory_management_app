CREATE DATABASE inventory_management_db;

CREATE TABLE `suppliers` (
    `supplier_id` INT NOT NULL AUTO_INCREMENT,
    `supplier_name` VARCHAR(50) UNIQUE NOT NULL,
    `supplier_email` VARCHAR(50) UNIQUE NOT NULL,
    `supplier_phone` VARCHAR(20),
    `supplier_address` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`supplier_id`)
);
CREATE TABLE `categories` (
    `category_id` INT NOT NULL AUTO_INCREMENT,
    `category_name` VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (`category_id`)
);
CREATE TABLE `products` (
    `product_id` INT NOT NULL AUTO_INCREMENT,
    `product_name` VARCHAR(50) UNIQUE NOT NULL,
    `category_id` INT,
    `supplier_id` INT NOT NULL,
    `product_quantity` INT NOT NULL,
    `product_price` DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (`product_id`),
    FOREIGN KEY (`supplier_id`) REFERENCES `suppliers`(`supplier_id`),
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`)
);
CREATE TABLE `stock_movements` (
    `stock_movement_id` INT NOT NULL AUTO_INCREMENT,
    `product_id` INT NOT NULL,
    `movement_quantity` INT NOT NULL,
    `movement_type` ENUM('IN','OUT') NOT NULL,
    `movement_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`stock_movement_id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)
);