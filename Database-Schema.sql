-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db690811217.db.1and1.com
-- Generation Time: Jun 02, 2018 at 09:27 AM
-- Server version: 5.5.60-0+deb7u1-log
-- PHP Version: 5.4.45-0+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db690811217`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `category_slug` varchar(50) NOT NULL,
  `category_key` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_key` (`category_key`),
  KEY `fk_c1` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE IF NOT EXISTS `collections` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_name` varchar(150) NOT NULL,
  `collection_key` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `collection_publish` tinyint(1) NOT NULL,
  `collection_slug` varchar(150) NOT NULL,
  PRIMARY KEY (`collection_id`),
  UNIQUE KEY `collection_key` (`collection_key`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `collection_products`
--

CREATE TABLE IF NOT EXISTS `collection_products` (
  `cp_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_key` varchar(50) NOT NULL,
  `product_key` varchar(50) NOT NULL,
  PRIMARY KEY (`cp_id`),
  KEY `product_key` (`product_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(50) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `country_code` (`country_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=244 ;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_type` varchar(10) NOT NULL,
  `coupon_limit` int(11) DEFAULT NULL,
  `coupon_begin` date DEFAULT NULL,
  `coupon_expire` date DEFAULT NULL,
  `coupon_key` varchar(50) NOT NULL,
  `coupon_publish` tinyint(1) NOT NULL,
  `store_id` int(11) NOT NULL,
  `coupon_limit_left` int(11) DEFAULT NULL,
  `coupon_has_count_limit` tinyint(1) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` float NOT NULL,
  PRIMARY KEY (`coupon_id`),
  UNIQUE KEY `coupon_key` (`coupon_key`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_key` varchar(50) NOT NULL,
  `customer_name` varchar(500) NOT NULL,
  `customer_email` varchar(500) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `customer_password` varchar(500) DEFAULT 'No Password',
  `store_id` int(11) NOT NULL,
  `customer_address` text,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_key` (`customer_key`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_src` varchar(50) NOT NULL,
  `product_key` varchar(50) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=181 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_key` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `order_shippping_address` varchar(1000) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `order_payment` varchar(100) NOT NULL DEFAULT 'COD',
  `order_status` varchar(100) NOT NULL DEFAULT 'Awaiting confirmation',
  `order_discount` float NOT NULL DEFAULT '0',
  `customer_key` varchar(50) NOT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_key` (`order_key`),
  KEY `country_code` (`country_code`),
  KEY `store_id` (`store_id`),
  KEY `customer_key` (`customer_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE IF NOT EXISTS `order_products` (
  `op_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_key` varchar(50) NOT NULL,
  `op_qty` int(11) NOT NULL DEFAULT '1',
  `op_price` float NOT NULL,
  `op_sale_price` float NOT NULL,
  `order_key` varchar(50) NOT NULL,
  `op_message` text,
  PRIMARY KEY (`op_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) NOT NULL,
  `category_key` varchar(50) NOT NULL,
  `product_inventory_track` tinyint(1) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_description` longtext,
  `product_shipping` tinyint(1) NOT NULL,
  `product_weight` float NOT NULL,
  `product_depth` float NOT NULL,
  `product_width` float NOT NULL,
  `product_height` float NOT NULL,
  `product_meta` text,
  `store_id` int(11) NOT NULL,
  `product_slug` varchar(150) NOT NULL,
  `product_key` varchar(50) NOT NULL,
  `product_publish` tinyint(1) NOT NULL,
  `product_sku` varchar(50) DEFAULT NULL,
  `product_taxable` tinyint(1) NOT NULL,
  `product_compare_price` float DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_key` (`product_key`),
  KEY `category_key` (`category_key`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(25) NOT NULL,
  `store_email` varchar(50) NOT NULL,
  `store_password` varchar(50) NOT NULL,
  `store_key` varchar(50) NOT NULL,
  `store_full_name` varchar(50) NOT NULL,
  `store_shipping_int` tinyint(1) NOT NULL DEFAULT '1',
  `store_shipping_int_first` float NOT NULL DEFAULT '0',
  `store_shipping_int_each` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax_countries`
--

CREATE TABLE IF NOT EXISTS `tax_countries` (
  `tc_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `tc_percentage` float NOT NULL DEFAULT '0',
  `tc_key` varchar(25) NOT NULL,
  PRIMARY KEY (`tc_id`),
  KEY `country_id` (`country_id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_c1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`);

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`);

--
-- Constraints for table `collection_products`
--
ALTER TABLE `collection_products`
  ADD CONSTRAINT `collection_products_ibfk_1` FOREIGN KEY (`product_key`) REFERENCES `products` (`product_key`);

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`country_code`) REFERENCES `countries` (`country_code`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`customer_key`) REFERENCES `customers` (`customer_key`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_p1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`),
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_key`) REFERENCES `categories` (`category_key`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`);

--
-- Constraints for table `tax_countries`
--
ALTER TABLE `tax_countries`
  ADD CONSTRAINT `tax_countries_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`),
  ADD CONSTRAINT `tax_countries_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`),
  ADD CONSTRAINT `tax_countries_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`);
