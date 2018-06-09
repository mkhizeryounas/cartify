-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 09, 2018 at 02:18 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cartify`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `category_slug` varchar(50) NOT NULL,
  `category_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `collection_id` int(11) NOT NULL,
  `collection_name` varchar(150) NOT NULL,
  `collection_key` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `collection_publish` tinyint(1) NOT NULL,
  `collection_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `collection_products`
--

CREATE TABLE `collection_products` (
  `cp_id` int(11) NOT NULL,
  `collection_key` varchar(50) NOT NULL,
  `product_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `country_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
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
  `coupon_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_key` varchar(50) NOT NULL,
  `customer_name` varchar(500) NOT NULL,
  `customer_email` varchar(500) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `customer_password` varchar(500) DEFAULT 'No Password',
  `store_id` int(11) NOT NULL,
  `customer_address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_src` varchar(50) NOT NULL,
  `product_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_key` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `order_shippping_address` varchar(1000) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `order_payment` varchar(100) NOT NULL DEFAULT 'COD',
  `order_status` varchar(100) NOT NULL DEFAULT 'Awaiting confirmation',
  `order_discount` float NOT NULL DEFAULT '0',
  `customer_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `op_id` int(11) NOT NULL,
  `product_key` varchar(50) NOT NULL,
  `op_qty` int(11) NOT NULL DEFAULT '1',
  `op_price` float NOT NULL,
  `op_sale_price` float NOT NULL,
  `order_key` varchar(50) NOT NULL,
  `op_message` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(500) NOT NULL,
  `page_content` longtext NOT NULL,
  `page_status` tinyint(4) NOT NULL DEFAULT '1',
  `page_key` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `page_slug` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
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
  `product_compare_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(25) NOT NULL,
  `store_email` varchar(50) NOT NULL,
  `store_password` varchar(50) NOT NULL,
  `store_key` varchar(50) NOT NULL,
  `store_full_name` varchar(50) NOT NULL,
  `store_shipping_int` tinyint(1) NOT NULL DEFAULT '1',
  `store_shipping_int_first` float NOT NULL DEFAULT '0',
  `store_shipping_int_each` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax_countries`
--

CREATE TABLE `tax_countries` (
  `tc_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `tc_percentage` float NOT NULL DEFAULT '0',
  `tc_key` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_key` (`category_key`),
  ADD KEY `fk_c1` (`store_id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`collection_id`),
  ADD UNIQUE KEY `collection_key` (`collection_key`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `collection_products`
--
ALTER TABLE `collection_products`
  ADD PRIMARY KEY (`cp_id`),
  ADD KEY `product_key` (`product_key`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`),
  ADD UNIQUE KEY `country_code` (`country_code`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD UNIQUE KEY `coupon_key` (`coupon_key`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_key` (`customer_key`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_key` (`order_key`),
  ADD KEY `country_code` (`country_code`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `customer_key` (`customer_key`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`op_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`),
  ADD KEY `page_key` (`page_key`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_key` (`product_key`),
  ADD KEY `category_key` (`category_key`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `tax_countries`
--
ALTER TABLE `tax_countries`
  ADD PRIMARY KEY (`tc_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `store_id` (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `collection_products`
--
ALTER TABLE `collection_products`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tax_countries`
--
ALTER TABLE `tax_countries`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`);

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
