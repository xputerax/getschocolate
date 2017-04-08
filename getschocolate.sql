-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table getschocolate.administrators
CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.customercarts
CREATE TABLE IF NOT EXISTS `customercarts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custcart_custid` (`customer_id`),
  KEY `custcard_prodid` (`product_id`),
  CONSTRAINT `custcard_prodid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `custcart_custid` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='dah boleh delete?';

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.customerinfo
CREATE TABLE IF NOT EXISTS `customerinfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) unsigned NOT NULL,
  `line_1` varchar(50) DEFAULT NULL,
  `line_2` varchar(50) DEFAULT NULL,
  `line_3` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custinfo_custid` (`customer_id`),
  CONSTRAINT `custinfo_custid` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `line_1` varchar(50) NOT NULL,
  `line_2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `resetkey` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.invoiceitems
CREATE TABLE IF NOT EXISTS `invoiceitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoiceitems_invoiceid` (`invoice_id`),
  KEY `invoiceitems_productid` (`product_id`),
  CONSTRAINT `invoiceitems_invoiceid` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  CONSTRAINT `invoiceitems_productid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `paid` enum('Y','N') NOT NULL DEFAULT 'N',
  `payment_id` varchar(50) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_date` datetime DEFAULT NULL,
  `gateway` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_custid` (`customer_id`),
  KEY `invoices_orderid` (`order_id`),
  CONSTRAINT `invoices_custid` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `invoices_orderid` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `approved` enum('Y','N') NOT NULL DEFAULT 'N',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approval_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_custid` (`customer_id`),
  CONSTRAINT `orders_custid` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.productcategories
CREATE TABLE IF NOT EXISTS `productcategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prodcat_catid` (`category_id`),
  KEY `prodcat_prodid` (`product_id`),
  CONSTRAINT `prodcat_catid` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `prodcat_prodid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.productimages
CREATE TABLE IF NOT EXISTS `productimages` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `image_file` varchar(50) NOT NULL,
  KEY `prodimg_prodid` (`product_id`),
  CONSTRAINT `prodimg_prodid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='dah boleh delete?\r\n\r\n';

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `stock` int(11) unsigned NOT NULL,
  `description` text NOT NULL,
  `image_1` varchar(50) DEFAULT NULL,
  `image_2` varchar(50) DEFAULT NULL,
  `image_3` varchar(50) DEFAULT NULL,
  `image_1_thumb` text,
  `image_2_thumb` text,
  `image_3_thumb` text,
  PRIMARY KEY (`id`),
  KEY `products_catid` (`category_id`),
  CONSTRAINT `products_catid` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table getschocolate.productthumbnails
CREATE TABLE IF NOT EXISTS `productthumbnails` (
  `product_id` int(10) unsigned NOT NULL,
  `image` varchar(50) NOT NULL,
  KEY `prodthumb_prodid` (`product_id`),
  CONSTRAINT `prodthumb_prodid` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='dah boleh delete?';

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
