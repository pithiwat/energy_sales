/*
Navicat MySQL Data Transfer

Source Server         : Pithiwat
Source Server Version : 100116
Source Host           : localhost:3306
Source Database       : testlv

Target Server Type    : MYSQL
Target Server Version : 100116
File Encoding         : 65001

Date: 2016-09-08 15:44:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for energy_sales
-- ----------------------------
DROP TABLE IF EXISTS `energy_sales`;
CREATE TABLE `energy_sales` (
  `Year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Month_Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Residential` decimal(13,2) DEFAULT NULL,
  `Small_General_Service` decimal(13,2) DEFAULT NULL,
  `Medium_General_Service` decimal(13,2) DEFAULT NULL,
  `Large_General_Service` decimal(13,2) DEFAULT NULL,
  `Specific_Busines_Service` decimal(13,2) DEFAULT NULL,
  `Government_Institutions_and_Non_Profit_Organizations` decimal(13,2) DEFAULT NULL,
  `Water_Pumping_for_Agricultural_Purposes` decimal(13,2) DEFAULT NULL,
  `Temporary_Tariff` decimal(13,2) DEFAULT NULL,
  `Public_Lightings` decimal(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of energy_sales
-- ----------------------------
INSERT INTO `energy_sales` VALUES ('2014', '01', 'Jan', '681.77', '491.02', '615.80', '1337.23', '132.37', '6.30', null, '29.24', '33.68');
INSERT INTO `energy_sales` VALUES ('2014', '02', 'Feb', '787.30', '535.84', '639.17', '1323.12', '138.51', '6.69', null, '30.31', '30.89');
INSERT INTO `energy_sales` VALUES ('2014', '03', 'Mar', '967.41', '621.49', '754.61', '1533.09', '174.76', '7.88', null, '34.02', '34.22');
INSERT INTO `energy_sales` VALUES ('2014', '04', 'Apr', '1122.78', '654.45', '690.34', '1389.97', '179.75', '8.19', null, '32.55', '33.19');
INSERT INTO `energy_sales` VALUES ('2014', '05', 'May', '1209.22', '712.29', '788.90', '1551.17', '189.83', '9.61', null, '37.21', '34.31');
INSERT INTO `energy_sales` VALUES ('2014', '06', 'Jun', '1127.63', '682.69', '767.21', '1516.10', '172.77', '8.74', null, '35.77', '33.69');
INSERT INTO `energy_sales` VALUES ('2014', '07', 'Jul', '1030.49', '645.11', '759.76', '1513.70', '175.35', '8.52', null, '35.87', '34.97');
INSERT INTO `energy_sales` VALUES ('2014', '08', 'Aug', '1003.59', '643.32', '746.12', '1510.29', '176.04', '8.47', null, '37.43', '35.03');
INSERT INTO `energy_sales` VALUES ('2014', '09', 'Sep', '986.90', '633.60', '752.22', '1505.16', '170.21', '7.99', null, '36.48', '34.17');
INSERT INTO `energy_sales` VALUES ('2014', '10', 'Oct', '965.01', '618.73', '740.31', '1511.56', '171.59', '8.16', null, '36.64', '35.49');
INSERT INTO `energy_sales` VALUES ('2014', '11', 'Nov', '971.29', '627.12', '742.06', '1471.36', '173.62', '8.21', null, '35.84', '34.47');
INSERT INTO `energy_sales` VALUES ('2014', '12', 'Dec', '841.36', '563.12', '672.46', '1376.17', '158.86', '7.37', null, '32.86', '35.70');
INSERT INTO `energy_sales` VALUES ('2015', '01', 'Jan', '745.82', '522.68', '646.22', '1368.14', '150.13', '6.79', null, '29.71', '30.20');
INSERT INTO `energy_sales` VALUES ('2015', '02', 'Feb', '853.60', '570.17', '673.85', '1351.87', '153.41', '7.25', null, '31.07', '27.53');
INSERT INTO `energy_sales` VALUES ('2015', '03', 'Mar', '1017.89', '639.37', '775.10', '1538.35', '188.05', '5.68', null, '34.69', '48.52');
INSERT INTO `energy_sales` VALUES ('2015', '04', 'Apr', '1100.93', '645.17', '702.60', '1382.69', '180.69', '11.79', null, '32.94', '36.67');
INSERT INTO `energy_sales` VALUES ('2015', '05', 'May', '1216.77', '713.30', '812.36', '1551.41', '200.08', '10.07', null, '36.62', '36.88');
INSERT INTO `energy_sales` VALUES ('2015', '06', 'Jun', '1178.44', '702.89', '784.33', '1519.24', '185.03', '9.42', null, '36.31', '35.80');
