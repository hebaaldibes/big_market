-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 10:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `super_market`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL DEFAULT 'default_use.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `email`, `password`, `image`) VALUES
(1, 'Admin ', 'Admin@gmail.com', '123456', 'hritik.jpg'),
(2, 'Admin2', 'Admin2@gmail.com', '123456', 'default_use.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`) VALUES
(1, 'Fruits And Vegetables'),
(2, 'Grocery Staples'),
(3, 'Personal Care'),
(4, 'Household'),
(6, 'Baked goods');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Customer1', 'customer1@gmail.com', '123456', 12345678, 'amman'),
(8, 'heba', 'customer2@gmail.com', '123', 772681707, 'amman');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`id`, `order_id`, `order_date`, `customer_id`, `product_id`, `quantity`) VALUES
(1, 131797165, '2020-05-14 02:51:42', 1, 2, 3),
(2, 131797165, '2020-05-14 02:51:42', 1, 21, 2),
(3, 131797165, '2020-05-14 02:51:42', 1, 3, 1),
(7, 1734669712, '2020-05-15 11:09:40', 1, 2, 1),
(8, 1734669712, '2020-05-15 11:09:40', 1, 21, 1),
(9, 1136168259, '2020-05-15 11:27:20', 1, 23, 2),
(10, 1605366255, '2020-05-17 04:51:08', 8, 22, 1),
(11, 1605366255, '2020-05-17 04:51:08', 8, 25, 1),
(12, 899597901, '2020-05-19 07:44:56', 1, 22, 1),
(13, 899597901, '2020-05-19 07:44:56', 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `employer_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL DEFAULT 'default_use.png',
  `market_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `employer_name`, `email`, `password`, `image`, `market_id`) VALUES
(1, 'AlFarid  Employer', 'AlFarid@gmail.com', '123456', 'genu.jpg', 1),
(2, 'Carrefour Employer', 'Carrefour@gmail.com', '123456', 'default_use.png', 3),
(3, 'Safeway Employer', 'Safeway@gmail.com', '123456', 'default_use.png', 2),
(4, 'Sameh Mall Employer', 'SamehMall@gmail.com', '123456', 'default_use.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `id` int(11) NOT NULL,
  `market_name` varchar(50) NOT NULL,
  `market_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`id`, `market_name`, `market_logo`) VALUES
(1, 'AlFarid', '17358840_1259396830763193_1950020213042214101_o.jpg'),
(2, 'Safeway', '13336116_1106052902787535_1054296002368679754_n.png'),
(3, 'Carrefour', 'carrefour.jpg'),
(4, 'Sameh Mall', 'download (1).png'),
(8, 'Jordan Store', 'jordan.jpg'),
(9, 'Cozmo ', 'cozmo.png'),
(10, 'Different Shop', 'different shop.PNG'),
(12, 'x market', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` float NOT NULL,
  `new_price` float NOT NULL,
  `product_img` varchar(250) NOT NULL,
  `date_set` date NOT NULL DEFAULT current_timestamp(),
  `product_description` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `market_id` int(11) NOT NULL,
  `date_sale` date NOT NULL,
  `sale` varchar(50) NOT NULL,
  `featured_product` varchar(50) NOT NULL,
  `coming_soon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `new_price`, `product_img`, `date_set`, `product_description`, `cat_id`, `sub_cat_id`, `market_id`, `date_sale`, `sale`, `featured_product`, `coming_soon`) VALUES
(1, 'Tropicana', 15, 0, 'bv3.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin', 2, 23, 3, '0000-00-00', 'False', 'featured', 'False'),
(2, 'Frooti', 15, 14.25, 'bv2.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 23, 1, '2020-05-10', 'sale', 'False', 'False'),
(3, 'Tata Salt', 12, 0, '1.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 10, 2, '0000-00-00', 'False', 'False', 'False'),
(4, 'Fortune Sunflower', 14, 0, '2.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 24, 2, '0000-00-00', 'False', 'featured', 'False'),
(5, 'Parryss Sugar', 20, 0, '5.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 10, 4, '0000-00-00', 'False', 'False', 'soon'),
(6, 'Sona Masoori Rice', 23, 0, '7.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 9, 4, '0000-00-00', 'False', 'featured', 'False'),
(7, 'Basmati Rice', 24, 20.4, '9.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 9, 3, '2020-05-10', 'sale', 'featured', 'False'),
(8, 'Fortune Sunflower', 15, 0, '10.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 24, 1, '0000-00-00', 'False', 'False', 'False'),
(9, 'Nestle A Slim', 25, 20, '12.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 24, 2, '2020-05-10', 'sale', 'featured', 'False'),
(10, 'Bread Sandwich', 5, 0, '13.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 6, 25, 3, '0000-00-00', 'False', 'featured', 'False'),
(11, 'Fry Pan', 35, 0, 'hh1.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 16, 3, '0000-00-00', 'False', 'False', 'soon'),
(12, 'Cookware', 55, 46.75, 'hh2.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 18, 1, '2020-05-10', 'sale', 'False', 'False'),
(13, 'Dosa Tawa', 14, 0, 'hh3.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 15, 4, '0000-00-00', 'False', 'False', 'soon'),
(14, 'Flask', 13, 0, 'hh4.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 18, 4, '0000-00-00', 'False', 'featured', 'False'),
(15, 'Kadai Idly', 65, 58.5, 'hh5.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 15, 2, '2020-05-10', 'sale', 'featured', 'False'),
(16, 'Elite Set', 30, 0, 'hh7.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 16, 3, '0000-00-00', 'False', 'featured', 'False'),
(17, 'Tadka Pan', 45, 0, 'hh9.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 16, 2, '0000-00-00', 'False', 'False', 'soon'),
(18, 'Breakfast Pan', 33, 28.05, 'hh6.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 16, 1, '2020-05-10', 'sale', 'False', 'False'),
(19, 'Saffola Gold', 85, 0, 'pc6.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 3, 11, 3, '0000-00-00', 'False', 'featured', 'False'),
(20, 'Parryss Sugar', 12, 11.4, 'gu5.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 2, 10, 1, '2020-05-10', 'sale', 'featured', 'False'),
(21, 'Moisturiser', 7, 0, 'of16.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 3, 14, 1, '0000-00-00', 'False', 'featured', 'False'),
(22, 'Lady Finger', 5, 4.75, 'of17.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 1, 3, 3, '2020-05-10', 'sale', 'False', 'False'),
(23, 'Grapes', 10, 0, 'of19.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 1, 4, 2, '0000-00-00', 'False', 'featured', 'False'),
(24, 'Gel', 2, 1.9, 'of23.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 3, 12, 3, '2020-05-10', 'sale', 'False', 'False'),
(25, 'Cleaner', 3.5, 3.15, 'of22.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 18, 1, '2020-05-10', 'sale', 'featured', 'False'),
(26, 'Conditioner', 7, 0, 'of21.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 3, 14, 3, '0000-00-00', 'False', 'False', 'soon'),
(27, 'Clips', 0.8, 0, 'of20.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 4, 18, 4, '0000-00-00', 'False', 'False', 'False'),
(28, 'Baby Oil', 8, 7.6, 'of36.png', '2020-05-17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis enim sed dui placerat, quis blandit erat condimentum. Ut imperdiet condimentum urna ac tristique. Sed quis neque eu sapien semper sollicitudin.', 3, 11, 1, '2020-05-18', 'sale', 'featured', 'False');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `subCatName` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `subCatName`, `cat_id`) VALUES
(1, 'Flowers', 1),
(2, 'Fresh Herbs & Seasonings', 1),
(3, 'Fresh Vegetables', 1),
(4, 'Organic Fruits & Vegetables', 1),
(5, 'Dry Fruits', 2),
(6, 'Edible Oils & Ghee', 2),
(7, 'Flours', 2),
(8, 'Spices', 2),
(9, 'Rice & Rice Products', 2),
(10, 'Salt & Sugar ', 2),
(11, 'Baby Care', 3),
(12, 'Cosmetics', 3),
(13, 'Perfumes', 3),
(14, 'Skin Care', 3),
(15, 'Cookware', 4),
(16, 'Pans', 4),
(18, 'Kitchenware', 4),
(23, 'Juices', 2),
(24, 'Dairies', 2),
(25, 'Bread', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_count`
--

CREATE TABLE `user_count` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(11) NOT NULL,
  `total_visites` int(11) NOT NULL DEFAULT 1,
  `pages_views` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_count`
--

INSERT INTO `user_count` (`id`, `ip_address`, `total_visites`, `pages_views`) VALUES
(1, '::1', 17, 1009),
(2, '54:54:54', 1, 1),
(3, '54:54:53', 1, 1),
(4, '54:54:51', 1, 1),
(5, '54:54:52', 1, 1),
(6, '54:54:55', 1, 1),
(7, '54:54:56', 1, 1),
(8, '54:54:57', 1, 1),
(9, '54:54:58', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_count`
--
ALTER TABLE `user_count`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_count`
--
ALTER TABLE `user_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
