-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2021 at 06:46 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drishyas_rushabh`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminmaster`
--

CREATE TABLE `adminmaster` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_fullname` varchar(100) NOT NULL,
  `admin_password` text DEFAULT NULL,
  `admin_role` varchar(255) DEFAULT NULL,
  `admin_status` enum('0','1','2') DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminmaster`
--

INSERT INTO `adminmaster` (`id`, `admin_name`, `admin_fullname`, `admin_password`, `admin_role`, `admin_status`, `status`, `created_date`, `updated_date`) VALUES
(1, 'admin', 'Jay Shah', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1,2,3,4,5,6,7,8,9,10', '1', 0, '2020-11-03 19:46:25', '2021-01-19 06:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_address1` varchar(100) DEFAULT NULL,
  `c_address2` varchar(100) DEFAULT NULL,
  `c_address3` varchar(100) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `c_city` varchar(100) DEFAULT NULL,
  `c_pincode` int(11) DEFAULT NULL,
  `c_country` varchar(100) DEFAULT NULL,
  `c_mobile` bigint(20) DEFAULT NULL,
  `c_alt` bigint(20) DEFAULT NULL,
  `c_email` varchar(100) DEFAULT NULL,
  `c_status` tinyint(2) DEFAULT NULL,
  `c_createdDate` datetime DEFAULT NULL,
  `c_modifiedDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `c_name`, `c_address1`, `c_address2`, `c_address3`, `state_id`, `c_city`, `c_pincode`, `c_country`, `c_mobile`, `c_alt`, `c_email`, `c_status`, `c_createdDate`, `c_modifiedDate`) VALUES
(1, 'ABC ltd', 'Room no 2, sai kripa chawl gaondevi road kajupada', 'Near sivaji maidan Poisor', 'kandivali east', 13, 'Mumbai', 400101, 'india', 9082131155, 8692947183, 'sameerjha@gmail.com', 1, '2020-12-08 01:14:40', '2021-01-12 10:29:32'),
(2, 'XYZ ltd.', 'Room no 2, sai kripa', 'Near sivaji maidan Poisor', 'kandivali west', 13, 'Mumbai', 400101, 'india', 8692947183, 9082131155, 'sanketrane999@gmail.com', 1, '2020-12-08 01:16:11', '2020-12-15 01:21:12'),
(3, 'sameer', 'rrom no 5 kailash puri chawl gawndevi road kajupada', '', '', 13, '', 0, 'India', 9082131155, 0, 'sam18@gmail.com', 1, '2020-12-15 01:23:43', '2020-12-15 02:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `clientcontact`
--

CREATE TABLE `clientcontact` (
  `cc_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `cc_name` varchar(150) NOT NULL,
  `cc_mobile` bigint(15) NOT NULL,
  `cc_designation` varchar(50) NOT NULL,
  `cc_email` varchar(255) NOT NULL,
  `cc_status` smallint(2) NOT NULL,
  `cc_createdDate` datetime(5) NOT NULL,
  `cc_modifiedDate` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientcontact`
--

INSERT INTO `clientcontact` (`cc_id`, `client_id`, `cc_name`, `cc_mobile`, `cc_designation`, `cc_email`, `cc_status`, `cc_createdDate`, `cc_modifiedDate`) VALUES
(1, 1, 'Sameer Jha', 8451811118, 'Abc', 'sadhsaj@gmail.com', 1, '2020-12-22 01:58:20.00000', '2020-12-22 01:58:20.00000'),
(2, 1, 'ravi jha', 8451811118, 'Sr. Eng.', 'ravijha@gmail.com', 1, '2021-01-12 10:29:50.00000', '2021-01-12 10:29:50.00000'),
(3, 3, 'xyz', 1234567890, 'abcde', 'abcde@gmail.com', 1, '2020-12-22 01:59:30.00000', '2020-12-22 01:59:30.00000');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL,
  `countries_name` varchar(64) NOT NULL DEFAULT '',
  `countries_iso_code` varchar(2) NOT NULL,
  `countries_isd_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countries_id`, `countries_name`, `countries_iso_code`, `countries_isd_code`) VALUES
(1, 'Afghanistan', 'AF', '93'),
(2, 'Albania', 'AL', '355'),
(3, 'Algeria', 'DZ', '213'),
(4, 'American Samoa', 'AS', '684'),
(5, 'Andorra', 'AD', '376'),
(6, 'Angola', 'AO', '244'),
(7, 'Anguilla', 'AI', '264'),
(8, 'Antarctica', 'AQ', '672'),
(9, 'Antigua and Barbuda', 'AG', '268'),
(10, 'Argentina', 'AR', '54'),
(11, 'Armenia', 'AM', '374'),
(12, 'Aruba', 'AW', '297'),
(13, 'Australia', 'AU', '61'),
(14, 'Austria', 'AT', '43'),
(15, 'Azerbaijan', 'AZ', '994'),
(16, 'Bahamas', 'BS', '242'),
(17, 'Bahrain', 'BH', '973'),
(18, 'Bangladesh', 'BD', '880'),
(19, 'Barbados', 'BB', '246'),
(20, 'Belarus', 'BY', '375'),
(21, 'Belgium', 'BE', '32'),
(22, 'Belize', 'BZ', '501'),
(23, 'Benin', 'BJ', '229'),
(24, 'Bermuda', 'BM', '441'),
(25, 'Bhutan', 'BT', '975'),
(26, 'Bolivia', 'BO', '591'),
(27, 'Bosnia and Herzegowina', 'BA', '387'),
(28, 'Botswana', 'BW', '267'),
(29, 'Bouvet Island', 'BV', '47'),
(30, 'Brazil', 'BR', '55'),
(31, 'British Indian Ocean Territory', 'IO', '246'),
(32, 'Brunei Darussalam', 'BN', '673'),
(33, 'Bulgaria', 'BG', '359'),
(34, 'Burkina Faso', 'BF', '226'),
(35, 'Burundi', 'BI', '257'),
(36, 'Cambodia', 'KH', '855'),
(37, 'Cameroon', 'CM', '237'),
(38, 'Canada', 'CA', '1'),
(39, 'Cape Verde', 'CV', '238'),
(40, 'Cayman Islands', 'KY', '345'),
(41, 'Central African Republic', 'CF', '236'),
(42, 'Chad', 'TD', '235'),
(43, 'Chile', 'CL', '56'),
(44, 'China', 'CN', '86'),
(45, 'Christmas Island', 'CX', '61'),
(46, 'Cocos (Keeling) Islands', 'CC', '61'),
(47, 'Colombia', 'CO', '57'),
(48, 'Comoros', 'KM', '269'),
(49, 'Congo Democratic Republic of', 'CG', '242'),
(50, 'Cook Islands', 'CK', '682'),
(51, 'Costa Rica', 'CR', '506'),
(52, 'Cote D\'Ivoire', 'CI', '225'),
(53, 'Croatia', 'HR', '385'),
(54, 'Cuba', 'CU', '53'),
(55, 'Cyprus', 'CY', '357'),
(56, 'Czech Republic', 'CZ', '420'),
(57, 'Denmark', 'DK', '45'),
(58, 'Djibouti', 'DJ', '253'),
(59, 'Dominica', 'DM', '767'),
(60, 'Dominican Republic', 'DO', '809'),
(61, 'Timor-Leste', 'TL', '670'),
(62, 'Ecuador', 'EC', '593'),
(63, 'Egypt', 'EG', '20'),
(64, 'El Salvador', 'SV', '503'),
(65, 'Equatorial Guinea', 'GQ', '240'),
(66, 'Eritrea', 'ER', '291'),
(67, 'Estonia', 'EE', '372'),
(68, 'Ethiopia', 'ET', '251'),
(69, 'Falkland Islands (Malvinas)', 'FK', '500'),
(70, 'Faroe Islands', 'FO', '298'),
(71, 'Fiji', 'FJ', '679'),
(72, 'Finland', 'FI', '358'),
(73, 'France', 'FR', '33'),
(75, 'French Guiana', 'GF', '594'),
(76, 'French Polynesia', 'PF', '689'),
(77, 'French Southern Territories', 'TF', NULL),
(78, 'Gabon', 'GA', '241'),
(79, 'Gambia', 'GM', '220'),
(80, 'Georgia', 'GE', '995'),
(81, 'Germany', 'DE', '49'),
(82, 'Ghana', 'GH', '233'),
(83, 'Gibraltar', 'GI', '350'),
(84, 'Greece', 'GR', '30'),
(85, 'Greenland', 'GL', '299'),
(86, 'Grenada', 'GD', '473'),
(87, 'Guadeloupe', 'GP', '590'),
(88, 'Guam', 'GU', '671'),
(89, 'Guatemala', 'GT', '502'),
(90, 'Guinea', 'GN', '224'),
(91, 'Guinea-bissau', 'GW', '245'),
(92, 'Guyana', 'GY', '592'),
(93, 'Haiti', 'HT', '509'),
(94, 'Heard Island and McDonald Islands', 'HM', '011'),
(95, 'Honduras', 'HN', '504'),
(96, 'Hong Kong', 'HK', '852'),
(97, 'Hungary', 'HU', '36'),
(98, 'Iceland', 'IS', '354'),
(99, 'India', 'IN', '91'),
(100, 'Indonesia', 'ID', '62'),
(101, 'Iran (Islamic Republic of)', 'IR', '98'),
(102, 'Iraq', 'IQ', '964'),
(103, 'Ireland', 'IE', '353'),
(104, 'Israel', 'IL', '972'),
(105, 'Italy', 'IT', '39'),
(106, 'Jamaica', 'JM', '876'),
(107, 'Japan', 'JP', '81'),
(108, 'Jordan', 'JO', '962'),
(109, 'Kazakhstan', 'KZ', '7'),
(110, 'Kenya', 'KE', '254'),
(111, 'Kiribati', 'KI', '686'),
(112, 'Korea, Democratic People\'s Republic of', 'KP', '850'),
(113, 'South Korea', 'KR', '82'),
(114, 'Kuwait', 'KW', '965'),
(115, 'Kyrgyzstan', 'KG', '996'),
(116, 'Lao People\'s Democratic Republic', 'LA', '856'),
(117, 'Latvia', 'LV', '371'),
(118, 'Lebanon', 'LB', '961'),
(119, 'Lesotho', 'LS', '266'),
(120, 'Liberia', 'LR', '231'),
(121, 'Libya', 'LY', '218'),
(122, 'Liechtenstein', 'LI', '423'),
(123, 'Lithuania', 'LT', '370'),
(124, 'Luxembourg', 'LU', '352'),
(125, 'Macao', 'MO', '853'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', '389'),
(127, 'Madagascar', 'MG', '261'),
(128, 'Malawi', 'MW', '265'),
(129, 'Malaysia', 'MY', '60'),
(130, 'Maldives', 'MV', '960'),
(131, 'Mali', 'ML', '223'),
(132, 'Malta', 'MT', '356'),
(133, 'Marshall Islands', 'MH', '692'),
(134, 'Martinique', 'MQ', '596'),
(135, 'Mauritania', 'MR', '222'),
(136, 'Mauritius', 'MU', '230'),
(137, 'Mayotte', 'YT', '262'),
(138, 'Mexico', 'MX', '52'),
(139, 'Micronesia, Federated States of', 'FM', '691'),
(140, 'Moldova', 'MD', '373'),
(141, 'Monaco', 'MC', '377'),
(142, 'Mongolia', 'MN', '976'),
(143, 'Montserrat', 'MS', '664'),
(144, 'Morocco', 'MA', '212'),
(145, 'Mozambique', 'MZ', '258'),
(146, 'Myanmar', 'MM', '95'),
(147, 'Namibia', 'NA', '264'),
(148, 'Nauru', 'NR', '674'),
(149, 'Nepal', 'NP', '977'),
(150, 'Netherlands', 'NL', '31'),
(151, 'Netherlands Antilles', 'AN', '599'),
(152, 'New Caledonia', 'NC', '687    '),
(153, 'New Zealand', 'NZ', '64'),
(154, 'Nicaragua', 'NI', '505'),
(155, 'Niger', 'NE', '227'),
(156, 'Nigeria', 'NG', '234'),
(157, 'Niue', 'NU', '683'),
(158, 'Norfolk Island', 'NF', '672'),
(159, 'Northern Mariana Islands', 'MP', '670'),
(160, 'Norway', 'NO', '47'),
(161, 'Oman', 'OM', '968'),
(162, 'Pakistan', 'PK', '92'),
(163, 'Palau', 'PW', '680'),
(164, 'Panama', 'PA', '507'),
(165, 'Papua New Guinea', 'PG', '675'),
(166, 'Paraguay', 'PY', '595'),
(167, 'Peru', 'PE', '51'),
(168, 'Philippines', 'PH', '63'),
(169, 'Pitcairn', 'PN', '64'),
(170, 'Poland', 'PL', '48'),
(171, 'Portugal', 'PT', '351'),
(172, 'Puerto Rico', 'PR', '787'),
(173, 'Qatar', 'QA', '974'),
(174, 'Reunion', 'RE', '262'),
(175, 'Romania', 'RO', '40'),
(176, 'Russian Federation', 'RU', '7'),
(177, 'Rwanda', 'RW', '250'),
(178, 'Saint Kitts and Nevis', 'KN', '869'),
(179, 'Saint Lucia', 'LC', '758'),
(180, 'Saint Vincent and the Grenadines', 'VC', '784'),
(181, 'Samoa', 'WS', '685'),
(182, 'San Marino', 'SM', '378'),
(183, 'Sao Tome and Principe', 'ST', '239'),
(184, 'Saudi Arabia', 'SA', '966'),
(185, 'Senegal', 'SN', '221'),
(186, 'Seychelles', 'SC', '248'),
(187, 'Sierra Leone', 'SL', '232'),
(188, 'Singapore', 'SG', '65'),
(189, 'Slovakia (Slovak Republic)', 'SK', '421'),
(190, 'Slovenia', 'SI', '386'),
(191, 'Solomon Islands', 'SB', '677'),
(192, 'Somalia', 'SO', '252'),
(193, 'South Africa', 'ZA', '27'),
(194, 'South Georgia and the South Sandwich Islands', 'GS', '500'),
(195, 'Spain', 'ES', '34'),
(196, 'Sri Lanka', 'LK', '94'),
(197, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '290'),
(198, 'St. Pierre and Miquelon', 'PM', '508'),
(199, 'Sudan', 'SD', '249'),
(200, 'Suriname', 'SR', '597'),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', '47'),
(202, 'Swaziland', 'SZ', '268'),
(203, 'Sweden', 'SE', '46'),
(204, 'Switzerland', 'CH', '41'),
(205, 'Syrian Arab Republic', 'SY', '963'),
(206, 'Taiwan', 'TW', '886'),
(207, 'Tajikistan', 'TJ', '992'),
(208, 'Tanzania, United Republic of', 'TZ', '255'),
(209, 'Thailand', 'TH', '66'),
(210, 'Togo', 'TG', '228'),
(211, 'Tokelau', 'TK', '690'),
(212, 'Tonga', 'TO', '676'),
(213, 'Trinidad and Tobago', 'TT', '868'),
(214, 'Tunisia', 'TN', '216'),
(215, 'Turkey', 'TR', '90'),
(216, 'Turkmenistan', 'TM', '993'),
(217, 'Turks and Caicos Islands', 'TC', '649'),
(218, 'Tuvalu', 'TV', '688'),
(219, 'Uganda', 'UG', '256'),
(220, 'Ukraine', 'UA', '380'),
(221, 'United Arab Emirates', 'AE', '971'),
(222, 'United Kingdom', 'GB', '44'),
(223, 'United States', 'US', '1'),
(224, 'United States Minor Outlying Islands', 'UM', '246'),
(225, 'Uruguay', 'UY', '598'),
(226, 'Uzbekistan', 'UZ', '998'),
(227, 'Vanuatu', 'VU', '678'),
(228, 'Vatican City State (Holy See)', 'VA', '379'),
(229, 'Venezuela', 'VE', '58'),
(230, 'Vietnam', 'VN', '84'),
(231, 'Virgin Islands (British)', 'VG', '284'),
(232, 'Virgin Islands (U.S.)', 'VI', '340'),
(233, 'Wallis and Futuna Islands', 'WF', '681'),
(234, 'Western Sahara', 'EH', '212'),
(235, 'Yemen', 'YE', '967'),
(236, 'Serbia', 'RS', '381'),
(238, 'Zambia', 'ZM', '260'),
(239, 'Zimbabwe', 'ZW', '263'),
(240, 'Aaland Islands', 'AX', '358'),
(241, 'Palestine', 'PS', '970'),
(242, 'Montenegro', 'ME', '382'),
(243, 'Guernsey', 'GG', '44-1481'),
(244, 'Isle of Man', 'IM', '44-1624'),
(245, 'Jersey', 'JE', '44-1534'),
(247, 'Curaçao', 'CW', '599'),
(248, 'Ivory Coast', 'CI', '225'),
(249, 'Kosovo', 'XK', '383');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(25) DEFAULT NULL,
  `symbol` varchar(25) DEFAULT NULL,
  `thousand_separator` varchar(10) DEFAULT NULL,
  `decimal_separator` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country`, `currency`, `code`, `symbol`, `thousand_separator`, `decimal_separator`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek', ',', '.'),
(2, 'America', 'Dollars', 'USD', '$', ',', '.'),
(3, 'Afghanistan', 'Afghanis', 'AF', '؋', ',', '.'),
(4, 'Argentina', 'Pesos', 'ARS', '$', ',', '.'),
(5, 'Aruba', 'Guilders', 'AWG', 'ƒ', ',', '.'),
(6, 'Australia', 'Dollars', 'AUD', '$', ',', '.'),
(7, 'Azerbaijan', 'New Manats', 'AZ', 'ман', ',', '.'),
(8, 'Bahamas', 'Dollars', 'BSD', '$', ',', '.'),
(9, 'Barbados', 'Dollars', 'BBD', '$', ',', '.'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.', ',', '.'),
(11, 'Belgium', 'Euro', 'EUR', '€', ',', '.'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$', ',', '.'),
(13, 'Bermuda', 'Dollars', 'BMD', '$', ',', '.'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b', ',', '.'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM', ',', '.'),
(16, 'Botswana', 'Pula\'s', 'BWP', 'P', ',', '.'),
(17, 'Bulgaria', 'Leva', 'BG', 'лв', ',', '.'),
(18, 'Brazil', 'Reais', 'BRL', 'R$', ',', '.'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£', ',', '.'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$', ',', '.'),
(21, 'Cambodia', 'Riels', 'KHR', '៛', ',', '.'),
(22, 'Canada', 'Dollars', 'CAD', '$', ',', '.'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$', ',', '.'),
(24, 'Chile', 'Pesos', 'CLP', '$', ',', '.'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥', ',', '.'),
(26, 'Colombia', 'Pesos', 'COP', '$', ',', '.'),
(27, 'Costa Rica', 'Colón', 'CRC', '₡', ',', '.'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn', ',', '.'),
(29, 'Cuba', 'Pesos', 'CUP', '₱', ',', '.'),
(30, 'Cyprus', 'Euro', 'EUR', '€', ',', '.'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč', ',', '.'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr', ',', '.'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$', ',', '.'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$', ',', '.'),
(35, 'Egypt', 'Pounds', 'EGP', '£', ',', '.'),
(36, 'El Salvador', 'Colones', 'SVC', '$', ',', '.'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£', ',', '.'),
(38, 'Euro', 'Euro', 'EUR', '€', ',', '.'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£', ',', '.'),
(40, 'Fiji', 'Dollars', 'FJD', '$', ',', '.'),
(41, 'France', 'Euro', 'EUR', '€', ',', '.'),
(42, 'Ghana', 'Cedis', 'GHC', '¢', ',', '.'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£', ',', '.'),
(44, 'Greece', 'Euro', 'EUR', '€', ',', '.'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q', ',', '.'),
(46, 'Guernsey', 'Pounds', 'GGP', '£', ',', '.'),
(47, 'Guyana', 'Dollars', 'GYD', '$', ',', '.'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€', ',', '.'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L', ',', '.'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$', ',', '.'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft', ',', '.'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr', ',', '.'),
(53, 'India', 'Rupees', 'INR', 'Rp', ',', '.'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp', ',', '.'),
(55, 'Iran', 'Rials', 'IRR', '﷼', ',', '.'),
(56, 'Ireland', 'Euro', 'EUR', '€', ',', '.'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£', ',', '.'),
(58, 'Israel', 'New Shekels', 'ILS', '₪', ',', '.'),
(59, 'Italy', 'Euro', 'EUR', '€', ',', '.'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$', ',', '.'),
(61, 'Japan', 'Yen', 'JPY', '¥', ',', '.'),
(62, 'Jersey', 'Pounds', 'JEP', '£', ',', '.'),
(63, 'Kazakhstan', 'Tenge', 'KZT', 'лв', ',', '.'),
(64, 'Korea (North)', 'Won', 'KPW', '₩', ',', '.'),
(65, 'Korea (South)', 'Won', 'KRW', '₩', ',', '.'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'лв', ',', '.'),
(67, 'Laos', 'Kips', 'LAK', '₭', ',', '.'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls', ',', '.'),
(69, 'Lebanon', 'Pounds', 'LBP', '£', ',', '.'),
(70, 'Liberia', 'Dollars', 'LRD', '$', ',', '.'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF', ',', '.'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt', ',', '.'),
(73, 'Luxembourg', 'Euro', 'EUR', '€', ',', '.'),
(74, 'Macedonia', 'Denars', 'MKD', 'ден', ',', '.'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM', ',', '.'),
(76, 'Malta', 'Euro', 'EUR', '€', ',', '.'),
(77, 'Mauritius', 'Rupees', 'MUR', '₨', ',', '.'),
(78, 'Mexico', 'Pesos', 'MX', '$', ',', '.'),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮', ',', '.'),
(80, 'Mozambique', 'Meticais', 'MZ', 'MT', ',', '.'),
(81, 'Namibia', 'Dollars', 'NAD', '$', ',', '.'),
(82, 'Nepal', 'Rupees', 'NPR', '₨', ',', '.'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ', ',', '.'),
(84, 'Netherlands', 'Euro', 'EUR', '€', ',', '.'),
(85, 'New Zealand', 'Dollars', 'NZD', '$', ',', '.'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$', ',', '.'),
(87, 'Nigeria', 'Nairas', 'NG', '₦', ',', '.'),
(88, 'North Korea', 'Won', 'KPW', '₩', ',', '.'),
(89, 'Norway', 'Krone', 'NOK', 'kr', ',', '.'),
(90, 'Oman', 'Rials', 'OMR', '﷼', ',', '.'),
(91, 'Pakistan', 'Rupees', 'PKR', '₨', ',', '.'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.', ',', '.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs', ',', '.'),
(94, 'Peru', 'Nuevos Soles', 'PE', 'S/.', ',', '.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php', ',', '.'),
(96, 'Poland', 'Zlotych', 'PL', 'zł', ',', '.'),
(97, 'Qatar', 'Rials', 'QAR', '﷼', ',', '.'),
(98, 'Romania', 'New Lei', 'RO', 'lei', ',', '.'),
(99, 'Russia', 'Rubles', 'RUB', 'руб', ',', '.'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£', ',', '.'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼', ',', '.'),
(102, 'Serbia', 'Dinars', 'RSD', 'Дин.', ',', '.'),
(103, 'Seychelles', 'Rupees', 'SCR', '₨', ',', '.'),
(104, 'Singapore', 'Dollars', 'SGD', '$', ',', '.'),
(105, 'Slovenia', 'Euro', 'EUR', '€', ',', '.'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$', ',', '.'),
(107, 'Somalia', 'Shillings', 'SOS', 'S', ',', '.'),
(108, 'South Africa', 'Rand', 'ZAR', 'R', ',', '.'),
(109, 'South Korea', 'Won', 'KRW', '₩', ',', '.'),
(110, 'Spain', 'Euro', 'EUR', '€', ',', '.'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₨', ',', '.'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr', ',', '.'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF', ',', '.'),
(114, 'Suriname', 'Dollars', 'SRD', '$', ',', '.'),
(115, 'Syria', 'Pounds', 'SYP', '£', ',', '.'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$', ',', '.'),
(117, 'Thailand', 'Baht', 'THB', '฿', ',', '.'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$', ',', '.'),
(119, 'Turkey', 'Lira', 'TRY', 'TL', ',', '.'),
(120, 'Turkey', 'Liras', 'TRL', '£', ',', '.'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$', ',', '.'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴', ',', '.'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£', ',', '.'),
(124, 'United States of America', 'Dollars', 'USD', '$', ',', '.'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U', ',', '.'),
(126, 'Uzbekistan', 'Sums', 'UZS', 'лв', ',', '.'),
(127, 'Vatican City', 'Euro', 'EUR', '€', ',', '.'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs', ',', '.'),
(129, 'Vietnam', 'Dong', 'VND', '₫', ',', '.'),
(130, 'Yemen', 'Rials', 'YER', '﷼', ',', '.'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$', ',', '.');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `c_code` varchar(20) NOT NULL,
  `c_mobile` bigint(20) DEFAULT NULL,
  `ca_code` varchar(20) NOT NULL,
  `ca_mobile` bigint(20) NOT NULL,
  `c_email` varchar(100) DEFAULT NULL,
  `rt_id` int(10) NOT NULL,
  `scopeOfWork` text DEFAULT NULL,
  `r_name` varchar(100) NOT NULL,
  `c_status` int(11) DEFAULT NULL,
  `added_id` int(11) DEFAULT NULL,
  `added_by` varchar(100) DEFAULT NULL,
  `c_createdDate` datetime DEFAULT NULL,
  `c_modifiedDate` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `b_name`, `c_code`, `c_mobile`, `ca_code`, `ca_mobile`, `c_email`, `rt_id`, `scopeOfWork`, `r_name`, `c_status`, `added_id`, `added_by`, `c_createdDate`, `c_modifiedDate`, `updated_by`, `updated_id`) VALUES
(1, 'Deepak Jayantilal Shah', '', '91', 9029992341, '', 0, 'deepakjshah1008@gmail.com', 1, NULL, 'none', NULL, 1, 'admin', '2021-01-20 08:00:06', '2021-01-20 08:00:06', NULL, NULL),
(2, 'Sameer Wakil Jha', '', '91', 9082131155, '', 0, 'sameerranjan999@gmail.com', 4, NULL, 'Jay shah', NULL, 1, 'admin', '2021-01-22 08:11:44', '2021-01-22 08:11:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expensetype`
--

CREATE TABLE `expensetype` (
  `ex_id` int(11) NOT NULL,
  `ex_type` varchar(128) NOT NULL,
  `ex_desc` varchar(228) NOT NULL,
  `ex_status` tinyint(4) NOT NULL,
  `ex_createdDate` datetime NOT NULL,
  `ex_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expensetype`
--

INSERT INTO `expensetype` (`ex_id`, `ex_type`, `ex_desc`, `ex_status`, `ex_createdDate`, `ex_modifiedDate`) VALUES
(1, 'Rent', 'Rent has been paid', 1, '2020-12-08 01:21:06', '2020-12-16 12:17:49'),
(2, 'Travelling', 'Traveling expense has been paid ', 1, '2020-12-08 01:25:51', '2020-12-08 01:25:51'),
(3, 'Stationery', 'stationery Bill paid', 1, '2020-12-08 01:26:38', '2021-01-11 10:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `industrytype`
--

CREATE TABLE `industrytype` (
  `it_id` int(11) NOT NULL,
  `it_name` varchar(100) NOT NULL,
  `it_status` int(11) NOT NULL,
  `it_createdDate` datetime NOT NULL,
  `it_modifiedDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industrytype`
--

INSERT INTO `industrytype` (`it_id`, `it_name`, `it_status`, `it_createdDate`, `it_modifiedDate`) VALUES
(1, 'Customize Softwares', 1, '2020-09-11 07:41:22', '2020-09-24 02:45:31'),
(2, 'Digital Marketing Agency', 1, '2020-09-16 12:30:32', '2020-09-16 12:30:32'),
(3, 'Financial Advisor', 1, '2020-09-24 02:45:20', '2020-09-24 02:45:27'),
(4, 'Apparel retail', 1, '2020-09-24 02:46:05', '2020-09-24 02:46:05'),
(5, 'Gift Retail', 1, '2020-09-24 02:46:17', '2020-09-24 02:46:17'),
(6, 'Vastu Industry', 1, '2020-09-24 02:47:04', '2020-09-24 02:47:04'),
(7, 'Curtain Automation', 1, '2020-09-24 02:47:16', '2020-09-24 02:47:16'),
(8, 'Educational Training Institute', 1, '2020-10-05 07:30:13', '2020-10-05 07:30:13'),
(9, 'Dentist', 1, '2020-10-07 11:32:31', '2020-10-07 11:32:31'),
(10, 'Architects', 1, '2020-10-15 07:46:42', '2020-10-15 07:46:42'),
(11, 'Restaurant', 1, '2020-10-19 07:00:07', '2020-10-20 01:58:58'),
(12, 'Baker', 1, '2020-10-23 09:13:49', '2020-10-23 09:13:49'),
(13, 'IT', 1, '2020-10-26 04:41:48', '2020-10-26 04:41:48'),
(14, 'Cosmetologist', 1, '2020-11-11 08:21:38', '2020-11-11 08:21:38'),
(15, 'Laproscopic ', 1, '2020-11-13 08:04:02', '2020-11-13 08:04:02'),
(16, 'Company Secretary', 1, '2020-11-13 11:06:10', '2020-11-13 11:06:10'),
(17, 'Facility Management', 1, '2020-11-17 06:41:22', '2020-11-17 06:41:22'),
(18, 'Real Estate', 1, '2020-11-17 08:19:11', '2020-11-17 08:19:11'),
(19, 'Industrial Chemicals', 1, '2020-11-23 06:14:57', '2020-11-23 06:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inq_id` int(11) NOT NULL,
  `inq_date` date NOT NULL,
  `c_id` int(11) NOT NULL,
  `lead_status` int(11) NOT NULL DEFAULT 1,
  `inq_addedBy` varchar(50) DEFAULT NULL,
  `inq_addedId` int(11) DEFAULT NULL,
  `inq_addedDate` datetime DEFAULT NULL,
  `inq_updatedId` int(11) DEFAULT NULL,
  `inq_updatedBy` varchar(50) DEFAULT NULL,
  `inq_updatedDate` datetime DEFAULT NULL,
  `inq_status` int(11) NOT NULL,
  `inq_address` varchar(258) NOT NULL,
  `inq_sitePerson` varchar(30) NOT NULL,
  `inq_siteContact` bigint(20) NOT NULL,
  `inq_sow` text DEFAULT NULL,
  `inq_sdate` date DEFAULT NULL,
  `inq_fdate` date DEFAULT NULL,
  `inq_ss` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inq_id`, `inq_date`, `c_id`, `lead_status`, `inq_addedBy`, `inq_addedId`, `inq_addedDate`, `inq_updatedId`, `inq_updatedBy`, `inq_updatedDate`, `inq_status`, `inq_address`, `inq_sitePerson`, `inq_siteContact`, `inq_sow`, `inq_sdate`, `inq_fdate`, `inq_ss`) VALUES
(1, '2021-01-20', 1, 5, 'admin', 1, '2021-01-20 08:13:04', NULL, NULL, '2021-01-20 08:19:02', 1, '502-A chandra Apt, S.v.p Road , Borivali west , Mumbai - 400103', 'Vandana Deepak Shah', 9029992342, 'Sliding window work and Invicible grills', '2020-01-20', '2021-01-21', '1,2'),
(2, '2021-01-22', 2, 5, 'admin', 1, '2021-01-22 08:11:44', NULL, NULL, '2021-01-22 08:11:44', 1, 'flat no 5 shivalaya Building thakur complex kandivali east mumbai maharashtra 400101', 'Wakil Jha', 9920406061, 'spider glass for the office', '2021-02-12', '2021-01-22', '1,2');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_detail`
--

CREATE TABLE `inquiry_detail` (
  `inqd_id` int(11) NOT NULL,
  `inq_id` int(11) NOT NULL,
  `inqd_area` longtext DEFAULT NULL,
  `inqd_ogd` longtext DEFAULT NULL,
  `inqd_efs` longtext DEFAULT NULL,
  `inqd_jp` longtext DEFAULT NULL,
  `inqd_mSize` longtext DEFAULT NULL,
  `inqd_pCoating` longtext DEFAULT NULL,
  `inqd_glass` longtext DEFAULT NULL,
  `inqd_aSection` longtext DEFAULT NULL,
  `inqd_addedId` int(11) DEFAULT NULL,
  `inqd_addedBy` varchar(50) DEFAULT NULL,
  `inqd_createdDate` datetime NOT NULL,
  `inqd_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry_detail`
--

INSERT INTO `inquiry_detail` (`inqd_id`, `inq_id`, `inqd_area`, `inqd_ogd`, `inqd_efs`, `inqd_jp`, `inqd_mSize`, `inqd_pCoating`, `inqd_glass`, `inqd_aSection`, `inqd_addedId`, `inqd_addedBy`, `inqd_createdDate`, `inqd_modifiedDate`) VALUES
(1, 1, '3 bhk\r\nKitchen- 55sqrft,\r\nMB Bathroom1-23sqrft ,\r\nMB Bathroom2- 23 sqrft,\r\nBathroom1- 20sqrft,\r\nLiving room - 50 sqrft,\r\nBedroom1 - 100 sqrft', '200mtr', '22/3', '3 bhk\r\nKitchen- L,\r\nMB Bathroom1- R,\r\nMB Bathroom2- L ,\r\nBathroom1- R,\r\nLiving Room- C ,\r\nBedroom1- L', '2*3', 'White ', '55\"meter', '22\"', 1, 'admin- admin', '2021-01-20 09:21:28', '2021-01-20 11:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_fr`
--

CREATE TABLE `inquiry_fr` (
  `ifr_id` int(11) NOT NULL,
  `ifr_date` date NOT NULL,
  `ifr_cdate` date NOT NULL DEFAULT current_timestamp(),
  `ifr_remark` text NOT NULL,
  `lead_remarks` longtext DEFAULT NULL,
  `inq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry_fr`
--

INSERT INTO `inquiry_fr` (`ifr_id`, `ifr_date`, `ifr_cdate`, `ifr_remark`, `lead_remarks`, `inq_id`) VALUES
(1, '2021-01-21', '2021-01-21', '', 'ABCDEF', 1),
(2, '2021-01-21', '2021-01-21', '', 'abcd', 1),
(3, '2021-01-23', '2021-01-23', '', 'abcd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inq_investigation_imgs`
--

CREATE TABLE `inq_investigation_imgs` (
  `img_id` int(11) NOT NULL,
  `inq_id` int(11) DEFAULT NULL,
  `img_name` varchar(50) DEFAULT NULL,
  `img_descriptions` varchar(100) DEFAULT NULL,
  `img_uploadBy` varchar(50) DEFAULT NULL,
  `img_uploadId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inq_investigation_imgs`
--

INSERT INTO `inq_investigation_imgs` (`img_id`, `inq_id`, `img_name`, `img_descriptions`, `img_uploadBy`, `img_uploadId`) VALUES
(1, 1, 'Weight_Machines-03.png', 'abcd', 'admin- Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leadstatus`
--

CREATE TABLE `leadstatus` (
  `ls_id` int(11) NOT NULL,
  `ls_name` varchar(50) NOT NULL,
  `ls_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leadstatus`
--

INSERT INTO `leadstatus` (`ls_id`, `ls_name`, `ls_status`) VALUES
(1, 'Open', 1),
(2, 'Site Inspection', 1),
(3, 'Site revisit', 1),
(4, 'Make quotation', 1),
(5, 'Quotation to Share', 1),
(7, 'Quotation Shared', 1),
(8, 'Quotation Reshared', 1),
(9, 'Reject ', 1),
(10, 'Follow Up', 1),
(11, 'Hold', 1),
(12, 'Successfully closed ', 1),
(13, 'Unsuccessfully closed ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(128) NOT NULL,
  `p_desc` text DEFAULT NULL,
  `p_hsn` varchar(30) DEFAULT NULL,
  `p_image` varchar(255) NOT NULL,
  `p_status` tinyint(4) NOT NULL,
  `p_modifiedDate` datetime NOT NULL,
  `p_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_name`, `p_desc`, `p_hsn`, `p_image`, `p_status`, `p_modifiedDate`, `p_createdDate`) VALUES
(1, 'Aluminium', 'aluminium product has been purchased.', 'A1', 'l-2.jpg', 1, '2021-01-11 10:10:34', '2020-12-18 07:14:42'),
(2, 'glass', 'Glass has been purchased ', 'g1', 'l-1.jpg', 1, '2020-12-18 07:54:19', '2020-12-18 07:15:28'),
(3, 'jhk', 'gafjsgafashg', 'lk8', 'Weight_Machines-01.png', 1, '2021-01-19 12:38:22', '2021-01-17 11:26:08'),
(4, 'abcgf', 'sajfdsakjhfdsk', 'hjyysha', 'Weight_Machines-02.png', 1, '2021-01-19 12:33:03', '2021-01-19 12:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `purchase_remarks` text DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `purchase_status` int(11) NOT NULL,
  `purchase_addedId` int(11) NOT NULL,
  `purchase_addedBy` varchar(30) NOT NULL,
  `purchase_modifiedDate` datetime NOT NULL,
  `purchase_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `s_id`, `purchase_remarks`, `purchase_date`, `purchase_status`, `purchase_addedId`, `purchase_addedBy`, `purchase_modifiedDate`, `purchase_createdDate`) VALUES
(1, 1, 'hhsafhsajkfhsfs', '2020-12-15', 1, 1, 'admin', '2020-12-15 01:50:01', '2020-12-15 01:50:01'),
(2, 2, 'dsfkgsgfhjdsf', '2020-12-15', 1, 1, 'admin', '2020-12-15 02:17:45', '2020-12-15 02:17:45'),
(3, 2, 'azqa', '2020-12-18', 1, 1, 'admin', '2020-12-18 01:04:03', '2020-12-18 01:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `pd_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `pd_qty` int(11) NOT NULL,
  `pd_unitprice` float(11,2) NOT NULL,
  `pd_money` int(11) NOT NULL,
  `pd_addstock` int(11) NOT NULL,
  `pd_status` int(11) NOT NULL,
  `pd_addedId` int(11) NOT NULL,
  `pd_addedBy` varchar(50) NOT NULL,
  `pd_modifiedDate` datetime NOT NULL,
  `pd_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`pd_id`, `purchase_id`, `p_id`, `pd_qty`, `pd_unitprice`, `pd_money`, `pd_addstock`, `pd_status`, `pd_addedId`, `pd_addedBy`, `pd_modifiedDate`, `pd_createdDate`) VALUES
(1, 1, 1, 200, 5000.00, 0, 0, 1, 1, 'admin', '2020-12-15 02:08:25', '2020-12-15 02:01:36'),
(2, 2, 1, 78, 345678.00, 0, 0, 1, 1, 'admin', '2020-12-15 02:18:08', '2020-12-15 02:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `p_specialized`
--

CREATE TABLE `p_specialized` (
  `psp_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `psp_status` tinyint(2) NOT NULL,
  `psp_createdDate` datetime NOT NULL,
  `psp_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_specialized`
--

INSERT INTO `p_specialized` (`psp_id`, `v_id`, `p_id`, `psp_status`, `psp_createdDate`, `psp_modifiedDate`) VALUES
(1, 1, 1, 1, '2020-12-17 12:35:40', '2021-01-11 10:17:05'),
(2, 1, 2, 1, '2020-12-17 12:36:05', '2020-12-17 01:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `p_supplier`
--

CREATE TABLE `p_supplier` (
  `ps_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ps_status` tinyint(2) NOT NULL,
  `ps_createdDate` datetime NOT NULL,
  `ps_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_supplier`
--

INSERT INTO `p_supplier` (`ps_id`, `p_id`, `s_id`, `ps_status`, `ps_createdDate`, `ps_modifiedDate`) VALUES
(1, 1, 2, 1, '2020-12-17 09:16:41', '2020-12-17 03:23:14'),
(2, 2, 1, 1, '2020-12-17 09:17:06', '2020-12-17 09:17:06'),
(3, 2, 2, 1, '2020-12-17 03:23:07', '2020-12-17 03:23:07'),
(4, 1, 1, 1, '2020-12-17 03:24:32', '2020-12-17 03:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `q_id` int(11) NOT NULL,
  `inq_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `q_date` date NOT NULL,
  `q_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`q_id`, `inq_id`, `c_id`, `q_date`, `q_status`) VALUES
(1, 1, 1, '2021-01-23', 1),
(2, 2, 2, '2021-01-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotationdetails`
--

CREATE TABLE `quotationdetails` (
  `qd_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `temp_name` longtext NOT NULL,
  `temp_description` longtext NOT NULL,
  `qd_totalArea` int(11) NOT NULL,
  `qd_price` float(11,2) NOT NULL,
  `qd_unit` text NOT NULL,
  `qd_amount` float(11,2) NOT NULL,
  `qd_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotationdetails`
--

INSERT INTO `quotationdetails` (`qd_id`, `q_id`, `temp_name`, `temp_description`, `qd_totalArea`, `qd_price`, `qd_unit`, `qd_amount`, `qd_status`) VALUES
(1, 1, 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 500, 500.00, 'sqrt', 250000.00, 1),
(2, 2, 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 5000, 500.00, 'sqrt', 2500000.00, 0),
(3, 2, 'ACP Cladding with 3mm wodden sheet clading', 'ACP Cladding with 3mm wodden sheet clading', 50000, 6000.00, 'sqfrt', 300000000.00, 0),
(4, 2, 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 5000, 500.00, 'sqrt', 2500000.00, 0),
(5, 2, 'ACP Cladding with 3mm wodden sheet clading', 'ACP Cladding with 3mm wodden sheet clading', 50000, 6000.00, 'sqfrt', 300000000.00, 0),
(6, 2, 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 5000, 500.00, 'sqrt', 2500000.00, 0),
(7, 2, 'ACP Cladding with 3mm wodden sheet clading', 'ACP Cladding with 3mm wodden sheet clading', 50000, 6000.00, 'sqfrt', 300000000.00, 0),
(8, 2, 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 5000, 500.00, 'sqrt', 2500000.00, 1),
(9, 2, 'ACP Cladding with 3mm wodden sheet clading', 'ACP Cladding with 3mm wodden sheet clading', 50000, 6000.00, 'sqfrt', 300000000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `referencetype`
--

CREATE TABLE `referencetype` (
  `rt_id` int(11) NOT NULL,
  `rt_name` varchar(100) NOT NULL,
  `rt_status` int(11) NOT NULL,
  `rt_dealer` int(11) DEFAULT NULL,
  `rt_edit` int(11) DEFAULT NULL,
  `rt_createdDate` datetime NOT NULL,
  `rt_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referencetype`
--

INSERT INTO `referencetype` (`rt_id`, `rt_name`, `rt_status`, `rt_dealer`, `rt_edit`, `rt_createdDate`, `rt_modifiedDate`) VALUES
(1, 'Direct', 1, NULL, 0, '2020-09-09 04:43:00', '2020-09-09 04:43:00'),
(2, 'Facebook', 1, NULL, 0, '2020-09-09 04:58:43', '2020-09-09 04:58:43'),
(3, 'Instagram', 1, NULL, 0, '2020-09-09 04:58:52', '2020-09-09 04:58:52'),
(4, 'Client Reference', 1, NULL, 0, '2020-09-09 04:58:59', '2020-09-09 04:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `site_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `sup_id` varchar(100) NOT NULL,
  `site_name` varchar(128) NOT NULL,
  `site_address` varchar(258) NOT NULL,
  `state_id` int(11) NOT NULL,
  `site_city` varchar(128) NOT NULL,
  `site_working` tinyint(4) NOT NULL,
  `site_status` tinyint(4) NOT NULL,
  `site_createdDate` datetime NOT NULL,
  `site_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`site_id`, `client_id`, `sup_id`, `site_name`, `site_address`, `state_id`, `site_city`, `site_working`, `site_status`, `site_createdDate`, `site_modifiedDate`) VALUES
(1, 1, '1,2', 'Malad', 'abchdga', 13, 'Mumbai', 1, 1, '2020-12-08 01:19:22', '2020-12-22 01:11:01'),
(2, 1, '2,1', 'Kandivali', 'abc', 13, 'Mumbai', 1, 1, '2020-12-08 01:19:56', '2021-01-12 10:30:30'),
(3, 2, '1', 'Khar ghar', 'Abc', 13, 'Mumbai', 1, 1, '2020-12-08 01:27:22', '2020-12-08 01:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `site_report`
--

CREATE TABLE `site_report` (
  `sr_id` int(11) NOT NULL,
  `sr_images` varchar(128) DEFAULT NULL,
  `sr_document` varchar(128) DEFAULT NULL,
  `sup_id` int(11) NOT NULL,
  `inq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `s_mobile` bigint(15) NOT NULL,
  `s_alt` bigint(15) NOT NULL,
  `s_email` varchar(255) NOT NULL,
  `s_role` varchar(255) NOT NULL,
  `s_password` varchar(255) NOT NULL,
  `s_status` tinyint(1) NOT NULL,
  `s_modifiedDate` datetime(6) NOT NULL,
  `s_createdDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`s_id`, `s_name`, `s_address`, `s_mobile`, `s_alt`, `s_email`, `s_role`, `s_password`, `s_status`, `s_modifiedDate`, `s_createdDate`) VALUES
(1, 'Sameer Jha', 'Room no 5 Kailashpuri kajupada kandivali east poisar ', 9082131155, 8692947183, 'sameerranjan999@gmail.com', '1,2,3,4,5,6,7,8,9,10', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2021-01-09 10:53:40.000000', '2021-01-09 10:53:40.000000'),
(2, 'Jay shah', 'Raghulila mall shop no 158', 1234567890, 0, 'jayshah1408@gmail.com', '1,2,3,4,5,6,7,8,9,10', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2021-01-11 10:10:59.000000', '2021-01-09 10:55:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Assam'),
(3, 'Arunachal Pradesh'),
(4, 'Bihar'),
(5, 'Goa'),
(6, 'Gujarat'),
(7, 'Jammu and Kashmir'),
(8, ' Jharkhand'),
(9, 'West Bengal'),
(10, 'Karnataka'),
(11, 'Kerala'),
(12, 'Madhya Pradesh'),
(13, 'Maharashtra'),
(14, 'Manipur'),
(15, 'Meghalaya'),
(16, 'Mizoram'),
(17, 'Nagaland'),
(18, 'Orissa'),
(19, 'Punjab'),
(20, 'Rajasthan'),
(21, 'Sikkim'),
(22, 'Tamil Nadu'),
(23, 'Tripura'),
(24, 'Uttaranchal'),
(25, 'Uttar Pradesh'),
(26, 'Haryana'),
(27, 'Himachal Pradesh'),
(28, 'Chhattisgarh');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(258) NOT NULL,
  `sup_address` varchar(258) NOT NULL,
  `sup_mobile` bigint(20) NOT NULL,
  `sup_alt` bigint(20) NOT NULL,
  `sup_email` varchar(258) NOT NULL,
  `sup_role` varchar(258) NOT NULL,
  `sup_password` varchar(258) NOT NULL,
  `sup_status` tinyint(4) NOT NULL,
  `sup_modifiedDate` datetime NOT NULL,
  `sup_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`sup_id`, `sup_name`, `sup_address`, `sup_mobile`, `sup_alt`, `sup_email`, `sup_role`, `sup_password`, `sup_status`, `sup_modifiedDate`, `sup_createdDate`) VALUES
(1, 'Sameer Jha', 'Room no 2, sai kripa chawl gaondevi road kajupada', 8451811118, 0, 'sameerjha@gmail.com', '1,2,3,4,5,6,7,8,9,10', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2020-12-16 10:49:14', '2020-12-08 12:59:58'),
(2, 'Jay', 'abcdg', 8451811119, 0, 'sonali123@gmail.com', '1,2,3,4,5,6,7,8,9,10', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2020-12-22 11:03:09', '2020-12-22 11:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `s_address1` text DEFAULT NULL,
  `s_address2` varchar(100) NOT NULL,
  `s_address3` varchar(255) NOT NULL,
  `s_city` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL,
  `s_country` varchar(100) NOT NULL,
  `s_pincode` varchar(20) NOT NULL,
  `s_mobile` bigint(20) DEFAULT NULL,
  `s_alt` bigint(20) DEFAULT NULL,
  `s_email` varchar(50) DEFAULT NULL,
  `s_gst` varchar(50) DEFAULT NULL,
  `s_status` int(11) NOT NULL,
  `s_createdDate` datetime NOT NULL,
  `s_modifiedDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`s_id`, `s_name`, `s_address1`, `s_address2`, `s_address3`, `s_city`, `state_id`, `s_country`, `s_pincode`, `s_mobile`, `s_alt`, `s_email`, `s_gst`, `s_status`, `s_createdDate`, `s_modifiedDate`) VALUES
(1, 'Sameer ranjan', 'raghulila mall', '', '', 'mumbai', 13, 'India', '400082', 9082131155, 0, 'sameerranjan999@gmail.com', NULL, 1, '2020-12-15 12:26:20', '2020-12-15 12:29:09'),
(2, 'Jay Shah', 'ganjiyawala Building', '', '', 'mumbai', 13, 'India', '', 9082131155, 0, 'jayshah@gmail.com', NULL, 1, '2020-12-15 02:16:10', '2020-12-15 02:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `suppliercontact`
--

CREATE TABLE `suppliercontact` (
  `sc_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `sc_name` varchar(128) NOT NULL,
  `sc_mobile` bigint(20) NOT NULL,
  `sc_designation` varchar(258) NOT NULL,
  `sc_email` varchar(258) NOT NULL,
  `sc_status` tinyint(2) NOT NULL,
  `sc_createdDate` datetime NOT NULL,
  `sc_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliercontact`
--

INSERT INTO `suppliercontact` (`sc_id`, `s_id`, `sc_name`, `sc_mobile`, `sc_designation`, `sc_email`, `sc_status`, `sc_createdDate`, `sc_modifiedDate`) VALUES
(1, 2, 'Sameer', 9082131155, 'Sr. Developer', 'sameerranjan999@gmail.com', 1, '2020-12-16 01:20:55', '2020-12-16 01:20:55'),
(2, 2, 'Rajnesh', 9087654321, 'Jr. Developer', 'rajnish@gmail.com', 1, '2020-12-16 01:22:24', '2020-12-16 01:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `temp_id` int(11) NOT NULL,
  `temp_name` varchar(100) NOT NULL,
  `temp_desc` longtext NOT NULL,
  `temp_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`temp_id`, `temp_name`, `temp_desc`, `temp_status`) VALUES
(1, 'Strructural Glazing Stick System with 6mm SGU Toughened Glass', 'Designing , Fabricating , supply and Installation of Semi utilized glazing', 1),
(2, 'ACP Cladding with 3mm wodden sheet clading', 'Designing , Fabricating , supply and installation of 3mm thick acp wodden', 1),
(3, 'ACP Cladding with 5mm wodden sheet clading', 'abcd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `v_id` int(11) NOT NULL,
  `v_name` varchar(25) NOT NULL,
  `v_address1` varchar(255) NOT NULL,
  `v_address2` varchar(255) NOT NULL,
  `v_address3` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `v_city` varchar(25) NOT NULL,
  `v_pincode` smallint(6) NOT NULL,
  `v_country` varchar(25) NOT NULL,
  `v_mobile` bigint(20) NOT NULL,
  `v_alt` bigint(20) NOT NULL,
  `v_gst` varchar(25) NOT NULL,
  `v_pan` varchar(25) NOT NULL,
  `v_email` varchar(25) NOT NULL,
  `v_status` tinyint(2) NOT NULL,
  `v_createdDate` datetime(5) NOT NULL,
  `v_modifiedDate` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`v_id`, `v_name`, `v_address1`, `v_address2`, `v_address3`, `state_id`, `v_city`, `v_pincode`, `v_country`, `v_mobile`, `v_alt`, `v_gst`, `v_pan`, `v_email`, `v_status`, `v_createdDate`, `v_modifiedDate`) VALUES
(1, 'Raju', 'raghulila', 'Near sivaji maidan kandivali east', 'abg', 13, 'Mumbai', 32767, 'india', 9082131155, 9082131155, 'hasa', 'msfbdsfbj', '', 1, '2020-12-08 02:21:33.00000', '2021-01-11 10:16:21.00000');

-- --------------------------------------------------------

--
-- Table structure for table `vendorcontact`
--

CREATE TABLE `vendorcontact` (
  `vc_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `vc_name` varchar(255) NOT NULL,
  `vc_mobile` bigint(25) NOT NULL,
  `vc_designation` varchar(255) NOT NULL,
  `vc_email` varchar(255) NOT NULL,
  `vc_status` tinyint(2) NOT NULL,
  `vc_createdDate` datetime(5) NOT NULL,
  `vc_modifiedDate` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendorcontact`
--

INSERT INTO `vendorcontact` (`vc_id`, `v_id`, `vc_name`, `vc_mobile`, `vc_designation`, `vc_email`, `vc_status`, `vc_createdDate`, `vc_modifiedDate`) VALUES
(1, 1, 'Sameer Jha', 908131155, 'sr. exc', 'sameerjha18@gmail.com', 1, '2021-01-11 10:16:40.00000', '2021-01-11 10:16:40.00000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminmaster`
--
ALTER TABLE `adminmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `clientcontact`
--
ALTER TABLE `clientcontact`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `expensetype`
--
ALTER TABLE `expensetype`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `industrytype`
--
ALTER TABLE `industrytype`
  ADD PRIMARY KEY (`it_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inq_id`);

--
-- Indexes for table `inquiry_detail`
--
ALTER TABLE `inquiry_detail`
  ADD PRIMARY KEY (`inqd_id`);

--
-- Indexes for table `inquiry_fr`
--
ALTER TABLE `inquiry_fr`
  ADD PRIMARY KEY (`ifr_id`);

--
-- Indexes for table `inq_investigation_imgs`
--
ALTER TABLE `inq_investigation_imgs`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `leadstatus`
--
ALTER TABLE `leadstatus`
  ADD PRIMARY KEY (`ls_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `p_specialized`
--
ALTER TABLE `p_specialized`
  ADD PRIMARY KEY (`psp_id`);

--
-- Indexes for table `p_supplier`
--
ALTER TABLE `p_supplier`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `quotationdetails`
--
ALTER TABLE `quotationdetails`
  ADD PRIMARY KEY (`qd_id`);

--
-- Indexes for table `referencetype`
--
ALTER TABLE `referencetype`
  ADD PRIMARY KEY (`rt_id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `site_report`
--
ALTER TABLE `site_report`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `suppliercontact`
--
ALTER TABLE `suppliercontact`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `vendorcontact`
--
ALTER TABLE `vendorcontact`
  ADD PRIMARY KEY (`vc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clientcontact`
--
ALTER TABLE `clientcontact`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expensetype`
--
ALTER TABLE `expensetype`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `industrytype`
--
ALTER TABLE `industrytype`
  MODIFY `it_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquiry_detail`
--
ALTER TABLE `inquiry_detail`
  MODIFY `inqd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inquiry_fr`
--
ALTER TABLE `inquiry_fr`
  MODIFY `ifr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inq_investigation_imgs`
--
ALTER TABLE `inq_investigation_imgs`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leadstatus`
--
ALTER TABLE `leadstatus`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `p_specialized`
--
ALTER TABLE `p_specialized`
  MODIFY `psp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `p_supplier`
--
ALTER TABLE `p_supplier`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quotationdetails`
--
ALTER TABLE `quotationdetails`
  MODIFY `qd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `referencetype`
--
ALTER TABLE `referencetype`
  MODIFY `rt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_report`
--
ALTER TABLE `site_report`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliercontact`
--
ALTER TABLE `suppliercontact`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendorcontact`
--
ALTER TABLE `vendorcontact`
  MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
