
DROP DATABASE IF EXISTS `qualitysales`;

CREATE DATABASE IF NOT EXISTS qualitysales DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `qualitysales`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS ordertable;
DROP TABLE IF EXISTS registration;
DROP TABLE IF EXISTS login;

CREATE TABLE IF NOT EXISTS `product` (
	`productId` int(10) NOT NULL,
	`productName` varchar(200) NOT NULL,
	`unitPrice` decimal(7,2) NOT NULL,
	`discountPrice` decimal(7,2) NOT NULL,
	`stock` int(10) NOT NULL,
	`productImage` text NOT NULL,
	PRIMARY KEY (`productId`));

INSERT INTO `product` (`productId`, `productName`, `unitPrice`, `discountPrice`, `stock`, `productImage`) VALUES
(1, 'LEGO TECHNIC CAR', '420.00', '300.00', 10, '1.jpg'),
(2, 'STAR WAR R2D1', '119.00', '99.00', 34, '2.jpg'),
(3, 'JDI DRONE', '359.00', '299.00', 2, '3.jpg'),
(4, 'ASSEMBLING ROBOT', '64.00', '49.00', 7, '4.jpg'),
(5, 'TOY BRICK CRANE TRUCK', '179.00', '149.00', 10, '5.jpg'),
(6, 'ROBOTPLAM', '292.50', '250.00', 22, '6.jpg');

CREATE TABLE IF NOT EXISTS `ordertable` (
	`orderId` int(10) NOT NULL,
	`customerId` int(10) NOT NULL,	
	`creditCardInfo` varchar(200) NOT NULL,
	`productId` int(10) NOT NULL,
	`quantity` int(10) NOT NULL,
	`amount` decimal(7,2) NOT NULL,	
	`shippingaddress` varchar(200) NOT NULL,
	PRIMARY KEY (`orderId`));

INSERT INTO `ordertable` (`orderId`, `customerId`, `creditCardInfo`, `productId`, `quantity`, `amount`, `shippingaddress`) VALUES
(1, 1, '1111111111111111', 3, 1, '299.00', '132 2 Ave , Bassano, AB, T0J'),
(2, 1, '1111111111111111', 6, 1, '250.00', '195 Ste Catherine , La Prairie, QC, J5R 1P6'),
(3, 2, '3333333333333333', 1, 2, '600.00', '8691 Peter Rd Prince George BC V2K 2W3(Prince George ,British Columbia)'),
(4, 4, '4444444444444444', 1, 1, '300.00', '364 Tucana Way Nepean ON K2J 0Z8');

CREATE TABLE IF NOT EXISTS `registration` (
	`customerId` int(10) NOT NULL AUTO_INCREMENT,
	`firstName` varchar(200) NOT NULL,
	`lastName` varchar(200) NOT NULL,
	`email` varchar(40) NOT NULL,
	`password` varchar(20) NOT NULL,
	`address` varchar(200) NOT NULL,
	PRIMARY KEY (`customerId`)) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `registration` (`customerId`, `firstName`, `lastName`, `email`, `password`, `address`) VALUES
(1, 'Heidi', 'Wesley', 'heidi.wesley@gmail.com', 'password', '132 2 Ave , Bassano, AB, T0J'),
(2, 'Dallas', 'Snyder', 'd.snyder@gmail.com', 'password', '195 Ste Catherine , La Prairie, QC, J5R 1P6'),
(3, 'Vincent', 'Bull', 'vincent.b@hotmail.com', 'password', '8691 Peter Rd Prince George BC V2K 2W3(Prince George ,British Columbia)'),
(4, 'Kaylee', 'Rains', 'klr@yahoo.com', 'password', '364 Tucana Way Nepean ON K2J 0Z8');


CREATE TABLE IF NOT EXISTS `login` (
	`email` varchar(40) NOT NULL,
	`password` varchar(20) NOT NULL);

INSERT INTO `login` (`email`, `password`) VALUES
('heidi.wesley@gmail.com', 'password'),
('d.snyder@gmail.com', 'password'),
('vincent.b@hotmail.com', 'password'),
('klr@yahoo.com', 'password');

CREATE TABLE IF NOT EXISTS `cart` (
	`Id` int(10) NOT NULL AUTO_INCREMENT,
	`cartId` int(10) NOT NULL,
	`productId` int(10) NOT NULL,
	`productName` varchar(200) NOT NULL,	
	`discountPrice` decimal(7,2) NOT NULL,
	`productImage` text NOT NULL,
	`quantity` int(10) NOT NULL,
	`subtotal` decimal(7,2) NOT NULL,
	PRIMARY KEY (`Id`)) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
