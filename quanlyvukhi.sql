/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : quanlyvukhi

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-09-08 08:19:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cancunhapkho
-- ----------------------------
DROP TABLE IF EXISTS `cancunhapkho`;
CREATE TABLE `cancunhapkho` (
  `cancunhapkho_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `cancunhapkho_code` int(4) unsigned NOT NULL,
  `cancunhapkho_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancunhapkho_date` date DEFAULT NULL,
  `cancunhapkho_coquan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'cơ quan ra lệnh nhập kho',
  `cancunhapkho_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cancunhapkho_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancunhapkho_active` tinyint(2) NOT NULL DEFAULT '1',
  `cancunhapkho_type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '0: nhập | 1:chuyển | 2: nhập tăng',
  PRIMARY KEY (`cancunhapkho_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cancunhapkho
-- ----------------------------

-- ----------------------------
-- Table structure for cancuxuatkho
-- ----------------------------
DROP TABLE IF EXISTS `cancuxuatkho`;
CREATE TABLE `cancuxuatkho` (
  `cancuxuatkho_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `cancuxuatkho_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cancuxuatkho_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancuxuatkho_date` date DEFAULT NULL,
  `cancuxuatkho_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancuxuatkho_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancuxuatkho_active` tinyint(2) NOT NULL DEFAULT '1',
  `cancuxuatkho_type` tinyint(2) DEFAULT '0' COMMENT '0: xuất | 1:chuyển | 2: nhập giảm',
  `cancuxuatkho_cqralenh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Cơ quan ra lệnh',
  PRIMARY KEY (`cancuxuatkho_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cancuxuatkho
-- ----------------------------
INSERT INTO `cancuxuatkho` VALUES ('1', 'VP-1/XK-2016', '1/XK-2016', '2016-08-01', 'Vĩnh phúc', null, '1', '1', null);
INSERT INTO `cancuxuatkho` VALUES ('3', 'VP-1/XK-2016', '1/XK-2016', '2016-08-04', 'Tổng cục 2', 'Tổng cục 2', '1', '0', 'Tổng cục 2');
INSERT INTO `cancuxuatkho` VALUES ('31', 'VP-1/XK-2016', '1/XK-2016', '2016-08-14', 'Căn cứ xuất kho Vĩnh phúc 14/8', 'Xuất kho', '1', '0', 'Cục quân khí');
INSERT INTO `cancuxuatkho` VALUES ('32', 'VP-1/XK-2016', 'VP-1/XK-2016', '2016-08-26', 'Căn cứ xuất kho quân khu 2', 'Mô tả', '1', '0', 'Quân khu 2');

-- ----------------------------
-- Table structure for covukhi
-- ----------------------------
DROP TABLE IF EXISTS `covukhi`;
CREATE TABLE `covukhi` (
  `nhomvukhi_id` tinyint(2) unsigned NOT NULL,
  `covukhi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `covukhi_code` int(11) DEFAULT NULL,
  `covukhi_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `covukhi_active` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`covukhi_id`),
  KEY `nhomvukhi_id` (`nhomvukhi_id`),
  CONSTRAINT `covukhi_ibfk_1` FOREIGN KEY (`nhomvukhi_id`) REFERENCES `nhomvukhi` (`nhomvukhi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of covukhi
-- ----------------------------
INSERT INTO `covukhi` VALUES ('1', '1', '1', 'Pháo mặt đất 152mm', '1');
INSERT INTO `covukhi` VALUES ('1', '2', '2', 'Pháo mặt đất 130mm', '1');
INSERT INTO `covukhi` VALUES ('1', '3', '3', 'Pháo mặt đất 122mm', '1');
INSERT INTO `covukhi` VALUES ('1', '4', '4', 'Pháo mặt đất 105mm', '1');
INSERT INTO `covukhi` VALUES ('1', '5', '5', 'Pháo mặt đất 100mm', '1');
INSERT INTO `covukhi` VALUES ('2', '8', '1', 'Pháo chống tăng 100mm', '1');
INSERT INTO `covukhi` VALUES ('2', '9', '2', 'Pháo chống tăng 85mm', '1');
INSERT INTO `covukhi` VALUES ('2', '10', '3', 'Pháo chống tăng 76mm', '1');
INSERT INTO `covukhi` VALUES ('2', '11', '4', 'Pháo chống tăng 57mm', '1');
INSERT INTO `covukhi` VALUES ('3', '12', '1', 'Súng ĐKZ 82mm', '1');
INSERT INTO `covukhi` VALUES ('3', '13', '2', 'Súng ĐKZ 73mm', '1');
INSERT INTO `covukhi` VALUES ('3', '14', '3', 'Súng ĐKZ 57mm', '1');
INSERT INTO `covukhi` VALUES ('4', '15', '1', 'Tên lửa chống tăng FAGOT 9K11', '1');
INSERT INTO `covukhi` VALUES ('4', '16', '2', 'Tên lửa chống tăng MULUTKA (B72)', '1');
INSERT INTO `covukhi` VALUES ('5', '17', '1', 'Súng cối 160mm', '1');
INSERT INTO `covukhi` VALUES ('5', '18', '2', 'Súng cối 120mm', '1');
INSERT INTO `covukhi` VALUES ('5', '19', '3', 'Súng cối 100mm', '1');
INSERT INTO `covukhi` VALUES ('5', '20', '4', 'Súng cối 60mm', '1');
INSERT INTO `covukhi` VALUES ('6', '21', '1', 'Pháo phản lực 140mm', '1');
INSERT INTO `covukhi` VALUES ('6', '22', '2', 'Pháo phản lực 132mm', '1');
INSERT INTO `covukhi` VALUES ('6', '23', '3', 'Pháo phản lực 122mm', '1');
INSERT INTO `covukhi` VALUES ('6', '24', '4', 'Pháo phản lực 107mm', '1');
INSERT INTO `covukhi` VALUES ('6', '25', '5', 'Pháo phản lực khác', '1');
INSERT INTO `covukhi` VALUES ('7', '26', '1', 'Tên Lửa', '1');
INSERT INTO `covukhi` VALUES ('7', '28', '2', 'Thiết bị phóng', '1');
INSERT INTO `covukhi` VALUES ('7', '29', '3', 'Thiết bị đồng bộ', '1');
INSERT INTO `covukhi` VALUES ('8', '30', '1', 'Ra đa chinh sát', '1');
INSERT INTO `covukhi` VALUES ('8', '31', '2', 'Ra đa khí tượng', '1');
INSERT INTO `covukhi` VALUES ('9', '32', '1', 'Máy tính phần tử bắn', '1');
INSERT INTO `covukhi` VALUES ('9', '33', '2', 'Khí tài đồ giải', '1');
INSERT INTO `covukhi` VALUES ('10', '34', '1', 'Tên lửa PK tầm thấp A87', '1');
INSERT INTO `covukhi` VALUES ('10', '35', '2', 'Tên lửa PK tầm thấp A72', '1');
INSERT INTO `covukhi` VALUES ('11', '36', '1', 'Pháo cao xạ 100mm', '1');
INSERT INTO `covukhi` VALUES ('11', '37', '2', 'Pháo cao xạ 85mm', '1');
INSERT INTO `covukhi` VALUES ('11', '38', '3', 'Pháo cao xạ 57mm', '1');
INSERT INTO `covukhi` VALUES ('11', '39', '4', 'Pháo cao xạ 37mm', '1');
INSERT INTO `covukhi` VALUES ('11', '40', '5', 'Pháo cao xạ 23mm', '1');
INSERT INTO `covukhi` VALUES ('11', '41', '6', 'Pháo cao xạ 20mm', '1');
INSERT INTO `covukhi` VALUES ('12', '42', '1', 'Súng cao xạ 14,5mm', '1');
INSERT INTO `covukhi` VALUES ('12', '43', '2', 'Súng cao xạ 12,7mm', '1');
INSERT INTO `covukhi` VALUES ('13', '44', '1', 'Ra đa pháo cao xạ', '1');
INSERT INTO `covukhi` VALUES ('14', '45', '1', 'Máy chỉ huy', '1');
INSERT INTO `covukhi` VALUES ('15', '48', '1', 'Thiết bị đánh đêm', '1');
INSERT INTO `covukhi` VALUES ('16', '49', '1', 'Súng ngắn', '1');
INSERT INTO `covukhi` VALUES ('16', '50', '2', 'Súng trường', '1');
INSERT INTO `covukhi` VALUES ('16', '52', '3', 'Súng tiểu liên', '1');
INSERT INTO `covukhi` VALUES ('16', '53', '4', 'Súng trung liên', '1');
INSERT INTO `covukhi` VALUES ('16', '54', '5', 'Súng đại liên', '1');
INSERT INTO `covukhi` VALUES ('16', '55', '6', 'Súng chống tăng', '1');
INSERT INTO `covukhi` VALUES ('16', '56', '7', 'Súng phóng lựu', '1');
INSERT INTO `covukhi` VALUES ('16', '57', '8', 'Súng rốc két', '1');
INSERT INTO `covukhi` VALUES ('16', '58', '9', 'Súng phun lửa', '1');
INSERT INTO `covukhi` VALUES ('16', '59', '10', 'Dàn phóng lựu, bệ phóng', '1');
INSERT INTO `covukhi` VALUES ('16', '60', '11', 'Công cụ hỗ trợ', '1');
INSERT INTO `covukhi` VALUES ('17', '61', '1', 'Xe đo đạc', '1');
INSERT INTO `covukhi` VALUES ('17', '62', '2', 'Máy định vị vệ tinh', '1');
INSERT INTO `covukhi` VALUES ('17', '63', '3', 'Ống nhòm', '1');
INSERT INTO `covukhi` VALUES ('17', '64', '4', 'Kính chỉ huy', '1');
INSERT INTO `covukhi` VALUES ('17', '65', '5', 'Kính tiềm vọng', '1');
INSERT INTO `covukhi` VALUES ('17', '66', '6', 'Kính nhìn đêm', '1');
INSERT INTO `covukhi` VALUES ('17', '67', '7', 'Phương hướng bàn', '1');
INSERT INTO `covukhi` VALUES ('17', '68', '8', 'Pháo đối kính', '1');
INSERT INTO `covukhi` VALUES ('17', '69', '9', 'Kính kinh vĩ', '1');
INSERT INTO `covukhi` VALUES ('17', '70', '10', 'Máy đo xa', '1');
INSERT INTO `covukhi` VALUES ('17', '71', '11', 'Máy đo cao', '1');
INSERT INTO `covukhi` VALUES ('17', '72', '12', 'Địa bàn', '1');
INSERT INTO `covukhi` VALUES ('17', '73', '13', 'Đồng hồ', '1');
INSERT INTO `covukhi` VALUES ('17', '74', '14', 'Máy thủy chuẩn', '1');
INSERT INTO `covukhi` VALUES ('17', '75', '15', 'Máy đo chuyên ngành', '1');
INSERT INTO `covukhi` VALUES ('18', '76', '1', 'Pháo nòng ngắn 155mm', '1');
INSERT INTO `covukhi` VALUES ('18', '77', '2', 'Pháo mặt đất 105mm', '1');
INSERT INTO `covukhi` VALUES ('20', '78', '1', 'Súng ĐKZ 106mm', '1');
INSERT INTO `covukhi` VALUES ('20', '79', '2', 'Súng ĐKZ 90mm', '1');
INSERT INTO `covukhi` VALUES ('20', '80', '3', 'Súng ĐKZ 75mm', '1');
INSERT INTO `covukhi` VALUES ('20', '81', '4', 'Súng ĐKZ 57mm', '1');
INSERT INTO `covukhi` VALUES ('22', '82', '1', 'Súng cối 106,7mm', '1');
INSERT INTO `covukhi` VALUES ('22', '83', '2', 'Súng cối 81mm', '1');
INSERT INTO `covukhi` VALUES ('28', '84', '1', 'Pháo cao xạ 40mm', '1');
INSERT INTO `covukhi` VALUES ('29', '85', '1', 'Súng cao xạ 12,7mm', '1');
INSERT INTO `covukhi` VALUES ('32', '93', '1', 'Thiết bị đánh đêm', '1');
INSERT INTO `covukhi` VALUES ('33', '94', '1', 'Súng ngắn 6,53mm', '1');
INSERT INTO `covukhi` VALUES ('33', '95', '2', 'Súng ngắn 7,65mm', '1');
INSERT INTO `covukhi` VALUES ('33', '96', '3', 'Súng ngắn 9mm', '1');
INSERT INTO `covukhi` VALUES ('33', '97', '4', 'Súng ngắn 9,65', '1');
INSERT INTO `covukhi` VALUES ('33', '98', '5', 'Súng ngắn 11,43mm', '1');
INSERT INTO `covukhi` VALUES ('33', '99', '6', 'Súng ngắn loại khác', '1');
INSERT INTO `covukhi` VALUES ('33', '100', '7', 'Súng ngắn pháo hiệu', '1');
INSERT INTO `covukhi` VALUES ('33', '101', '8', 'Súng trường các loại khác', '1');
INSERT INTO `covukhi` VALUES ('33', '102', '9', 'Súng tiểu liên 9mm', '1');
INSERT INTO `covukhi` VALUES ('33', '103', '10', 'Súng tiểu liên 5,56mm', '1');
INSERT INTO `covukhi` VALUES ('33', '104', '11', 'Súng tiểu liên 11,43mm', '1');
INSERT INTO `covukhi` VALUES ('33', '105', '12', 'Súng tiểu liên các loại khác', '1');
INSERT INTO `covukhi` VALUES ('33', '106', '13', 'Súng trung liên 7,5mm', '1');
INSERT INTO `covukhi` VALUES ('33', '107', '14', 'Súng trung liên 9,2mm', '1');
INSERT INTO `covukhi` VALUES ('33', '108', '15', 'Súng đại liên', '1');
INSERT INTO `covukhi` VALUES ('33', '109', '16', 'Súng phóng lựu 40mm', '1');
INSERT INTO `covukhi` VALUES ('33', '110', '17', 'Súng phóng lựu 30mm', '1');
INSERT INTO `covukhi` VALUES ('33', '111', '18', 'Súng rốc két 66mm', '1');
INSERT INTO `covukhi` VALUES ('33', '112', '19', 'Dàn phóng lựu, bệ phóng', '1');
INSERT INTO `covukhi` VALUES ('33', '113', '20', 'Súng bắn đạn cao su', '1');
INSERT INTO `covukhi` VALUES ('33', '114', '21', 'Súng bắn đạn cay, phóng dây', '1');
INSERT INTO `covukhi` VALUES ('33', '115', '22', 'Súng phóng điện', '1');
INSERT INTO `covukhi` VALUES ('33', '116', '23', 'Áo giáp chống đạn', '1');
INSERT INTO `covukhi` VALUES ('33', '117', '24', 'Dao găm chuyên dùng', '1');
INSERT INTO `covukhi` VALUES ('33', '118', '25', 'Công sự', '1');
INSERT INTO `covukhi` VALUES ('34', '119', '1', 'Xe đo đạc', '1');
INSERT INTO `covukhi` VALUES ('34', '120', '2', 'Máy định vị vệ tinh', '1');
INSERT INTO `covukhi` VALUES ('34', '121', '3', 'Ống nhòm', '1');
INSERT INTO `covukhi` VALUES ('34', '122', '4', 'Kính chỉ huy', '1');
INSERT INTO `covukhi` VALUES ('34', '123', '5', 'Kính tiềm vọng', '1');
INSERT INTO `covukhi` VALUES ('34', '124', '6', 'Kính nhìn đêm', '1');
INSERT INTO `covukhi` VALUES ('34', '125', '7', 'Phương hướng bàn', '1');
INSERT INTO `covukhi` VALUES ('34', '126', '8', 'Pháo đối kính', '1');
INSERT INTO `covukhi` VALUES ('34', '128', '9', 'Kính kinh vĩ', '1');
INSERT INTO `covukhi` VALUES ('34', '129', '10', 'Máy đo xa', '1');
INSERT INTO `covukhi` VALUES ('34', '130', '11', 'Máy đo cao', '1');
INSERT INTO `covukhi` VALUES ('34', '131', '12', 'Địa bàn', '1');
INSERT INTO `covukhi` VALUES ('34', '132', '13', 'Đồng hồ', '1');
INSERT INTO `covukhi` VALUES ('34', '133', '14', 'Máy thủy chuẩn', '1');
INSERT INTO `covukhi` VALUES ('34', '134', '15', 'Máy đo chuyên ngành', '1');

-- ----------------------------
-- Table structure for danhmucdongbo
-- ----------------------------
DROP TABLE IF EXISTS `danhmucdongbo`;
CREATE TABLE `danhmucdongbo` (
  `danhmucdongbo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nhomvukhi_id` tinyint(2) unsigned NOT NULL,
  `vukhi_id` int(10) unsigned NOT NULL,
  `danhmucdongbo_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `danhmucdongbo_sltc` tinyint(2) DEFAULT '1',
  `danhmucdongbo_active` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`danhmucdongbo_id`),
  KEY `nhomvukhi_id` (`nhomvukhi_id`),
  KEY `vukhi_id` (`vukhi_id`),
  CONSTRAINT `danhmucdongbo_ibfk_1` FOREIGN KEY (`nhomvukhi_id`) REFERENCES `nhomvukhi` (`nhomvukhi_id`),
  CONSTRAINT `danhmucdongbo_ibfk_2` FOREIGN KEY (`vukhi_id`) REFERENCES `vukhi` (`vukhi_id`),
  CONSTRAINT `danhmucdongbo_ibfk_3` FOREIGN KEY (`danhmucdongbo_id`) REFERENCES `thuclucdongbo` (`thuclucdongbo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of danhmucdongbo
-- ----------------------------

-- ----------------------------
-- Table structure for donvi
-- ----------------------------
DROP TABLE IF EXISTS `donvi`;
CREATE TABLE `donvi` (
  `donvi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `donvi_parent` int(10) unsigned NOT NULL,
  `donvi_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `donvi_level` tinyint(2) unsigned NOT NULL,
  `donvi_short_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`donvi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of donvi
-- ----------------------------
INSERT INTO `donvi` VALUES ('1', '0', 'QK2', '0', null);
INSERT INTO `donvi` VALUES ('2', '0', 'DVN', '0', null);
INSERT INTO `donvi` VALUES ('3', '1', 'Sư đoàn 316', '0', 'F316');
INSERT INTO `donvi` VALUES ('4', '1', 'Lữ đoàn 297', '0', 'L297');
INSERT INTO `donvi` VALUES ('5', '2', 'Kho K79', '0', 'K79');
INSERT INTO `donvi` VALUES ('6', '2', 'Kho K28', '0', 'K28');
INSERT INTO `donvi` VALUES ('11', '1', 'Vĩnh Phúc', '0', 'VP');
INSERT INTO `donvi` VALUES ('12', '1', 'Phú Thọ', '0', 'PT');

-- ----------------------------
-- Table structure for donvitinh
-- ----------------------------
DROP TABLE IF EXISTS `donvitinh`;
CREATE TABLE `donvitinh` (
  `donvitinh_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `donvitinh_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `donvitinh_active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`donvitinh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of donvitinh
-- ----------------------------
INSERT INTO `donvitinh` VALUES ('1', 'Khẩu', '1');
INSERT INTO `donvitinh` VALUES ('2', 'Cái', '1');
INSERT INTO `donvitinh` VALUES ('3', 'Chiếc', '1');
INSERT INTO `donvitinh` VALUES ('4', 'Bộ', '1');
INSERT INTO `donvitinh` VALUES ('5', 'Bệ', '1');
INSERT INTO `donvitinh` VALUES ('6', 'Dàn', '1');
INSERT INTO `donvitinh` VALUES ('7', 'Thân', '1');
INSERT INTO `donvitinh` VALUES ('8', 'Đầu', '1');
INSERT INTO `donvitinh` VALUES ('9', 'Trạm', '1');
INSERT INTO `donvitinh` VALUES ('10', 'Vọng', '1');
INSERT INTO `donvitinh` VALUES ('11', 'kg', '1');
INSERT INTO `donvitinh` VALUES ('12', 'mét', '1');

-- ----------------------------
-- Table structure for hevukhi
-- ----------------------------
DROP TABLE IF EXISTS `hevukhi`;
CREATE TABLE `hevukhi` (
  `hevukhi_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `hevukhi_code` tinyint(2) DEFAULT NULL,
  `hevukhi_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hevukhi_active` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hevukhi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of hevukhi
-- ----------------------------
INSERT INTO `hevukhi` VALUES ('1', '1', 'XHCN', '1');
INSERT INTO `hevukhi` VALUES ('2', '2', 'TBCN', '1');

-- ----------------------------
-- Table structure for lydonhapkho
-- ----------------------------
DROP TABLE IF EXISTS `lydonhapkho`;
CREATE TABLE `lydonhapkho` (
  `lydonhapkho_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `lydonhapkho_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lydonhapkho_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lydonhapkho_active` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lydonhapkho_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lydonhapkho
-- ----------------------------
INSERT INTO `lydonhapkho` VALUES ('1', 'Trên cấp', '', '1');
INSERT INTO `lydonhapkho` VALUES ('2', 'Nhập ĐV', null, '1');
INSERT INTO `lydonhapkho` VALUES ('3', 'KK Thừa', 'Kiểm kê thừa', '1');
INSERT INTO `lydonhapkho` VALUES ('4', 'Chuyển Cấp', null, '1');
INSERT INTO `lydonhapkho` VALUES ('5', '', '', '1');
INSERT INTO `lydonhapkho` VALUES ('6', '', '', '1');

-- ----------------------------
-- Table structure for lydoxuatkho
-- ----------------------------
DROP TABLE IF EXISTS `lydoxuatkho`;
CREATE TABLE `lydoxuatkho` (
  `lydoxuatkho_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `lydoxuatkho_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lydoxuatkho_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lydoxuatkho_active` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`lydoxuatkho_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lydoxuatkho
-- ----------------------------
INSERT INTO `lydoxuatkho` VALUES ('1', 'Xuất ĐV', '', '1');
INSERT INTO `lydoxuatkho` VALUES ('2', 'Hủy', '', '1');
INSERT INTO `lydoxuatkho` VALUES ('3', 'KK Thiếu', '', '1');
INSERT INTO `lydoxuatkho` VALUES ('4', 'Chuyển cấp', '', '1');
INSERT INTO `lydoxuatkho` VALUES ('5', 'Thu hồi', '', '1');

-- ----------------------------
-- Table structure for lydoxuatkhos
-- ----------------------------
DROP TABLE IF EXISTS `lydoxuatkhos`;
CREATE TABLE `lydoxuatkhos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lydoxuatkhos
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2016_07_05_131808_create_lydoxuatkhos_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_20_111230_rename_hevukhi_code_field_in_nhomvukhi_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_21_154511_rename_covukhi_code_field_on_covukhi_table', '1');

-- ----------------------------
-- Table structure for nhomvukhi
-- ----------------------------
DROP TABLE IF EXISTS `nhomvukhi`;
CREATE TABLE `nhomvukhi` (
  `hevukhi_id` tinyint(2) unsigned NOT NULL,
  `nhomvukhi_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `nhomvukhi_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nhomvukhi_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nhomvukhi_active` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`nhomvukhi_id`),
  KEY `hevukhi_id` (`hevukhi_id`),
  CONSTRAINT `nhomvukhi_ibfk_1` FOREIGN KEY (`hevukhi_id`) REFERENCES `hevukhi` (`hevukhi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of nhomvukhi
-- ----------------------------
INSERT INTO `nhomvukhi` VALUES ('1', '1', '1', 'Pháo mặt đất', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '2', '2', 'Pháo chống tăng', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '3', '3', 'Súng, Pháo ĐKZ', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '4', '4', 'Tên lửa chống tăng', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '5', '5', 'Súng cối', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '6', '6', 'Pháo phản lực', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '7', '7', 'Tổ hợp tên lửa Đất - Đất P17E', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '8', '8', 'Ra đa trinh sát PB', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '9', '9', 'Khí tài tính toán - đồ giải', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '10', '10', 'Tên lửa PK tầm thấp', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '11', '11', 'Pháo cao xạ', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '12', '12', 'Súng cao xạ', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '13', '13', 'Ra đa pháo cao xạ', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '14', '14', 'Máy chỉ huy', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '15', '15', 'Thiết bị đánh đêm', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '16', '16', 'Súng bộ binh', '1');
INSERT INTO `nhomvukhi` VALUES ('1', '17', '17', 'Khí tài quang học', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '18', '1', 'Pháo mặt đất 1', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '19', '2', 'Pháo chống tăng', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '20', '3', 'Súng, Pháo ĐKZ', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '21', '4', 'Tên lửa chống tăng', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '22', '5', 'Súng cối', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '23', '6', 'Pháo phản lực', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '24', '7', 'Tổ hợp tên lửa Đất - Đất P17E', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '25', '8', 'Ra đa trinh sát PB', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '26', '9', 'Khí tài tính toán - đồ giải', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '27', '10', 'Tên lửa PK tầm thấp', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '28', '11', 'Pháo cao xạ', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '29', '12', 'Súng cao xạ', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '30', '13', 'Ra đa pháo cao xạ', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '31', '14', 'Máy chỉ huy', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '32', '15', 'Thiết bị đánh đêm', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '33', '16', 'Súng bộ binh', '1');
INSERT INTO `nhomvukhi` VALUES ('2', '34', '17', 'Khí tài quang học', '1');

-- ----------------------------
-- Table structure for nuocsanxuat
-- ----------------------------
DROP TABLE IF EXISTS `nuocsanxuat`;
CREATE TABLE `nuocsanxuat` (
  `nuocsanxuat_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `hevukhi_id` tinyint(2) unsigned NOT NULL,
  `nuocsanxuat_name` varchar(255) NOT NULL,
  `nuocsanxuat_active` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`nuocsanxuat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nuocsanxuat
-- ----------------------------
INSERT INTO `nuocsanxuat` VALUES ('1', '1', 'L.Xô', '1');
INSERT INTO `nuocsanxuat` VALUES ('2', '1', 'T.Quốc', '1');
INSERT INTO `nuocsanxuat` VALUES ('3', '1', 'V.Nam', '1');
INSERT INTO `nuocsanxuat` VALUES ('4', '1', 'B.Lan', '1');
INSERT INTO `nuocsanxuat` VALUES ('5', '1', 'Tr.Tiên', '1');
INSERT INTO `nuocsanxuat` VALUES ('6', '1', 'Hunggari', '1');
INSERT INTO `nuocsanxuat` VALUES ('7', '1', 'Tiệp', '1');
INSERT INTO `nuocsanxuat` VALUES ('8', '1', 'Tưởng.GT', '1');
INSERT INTO `nuocsanxuat` VALUES ('9', '1', 'Rumani', '1');
INSERT INTO `nuocsanxuat` VALUES ('10', '1', 'Nga', '1');
INSERT INTO `nuocsanxuat` VALUES ('11', '2', 'Mỹ', '1');
INSERT INTO `nuocsanxuat` VALUES ('12', '2', 'Anh', '1');
INSERT INTO `nuocsanxuat` VALUES ('13', '2', 'Pháp', '1');
INSERT INTO `nuocsanxuat` VALUES ('14', '2', 'Đức', '1');
INSERT INTO `nuocsanxuat` VALUES ('15', '2', 'Thụy sĩ', '1');
INSERT INTO `nuocsanxuat` VALUES ('16', '2', 'Nhật', '1');
INSERT INTO `nuocsanxuat` VALUES ('17', '2', 'Italya', '1');
INSERT INTO `nuocsanxuat` VALUES ('18', '2', 'Bỉ', '1');
INSERT INTO `nuocsanxuat` VALUES ('19', '2', 'Đài Loan', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for phancap
-- ----------------------------
DROP TABLE IF EXISTS `phancap`;
CREATE TABLE `phancap` (
  `phancap_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `phancap_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phancap_active` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`phancap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of phancap
-- ----------------------------
INSERT INTO `phancap` VALUES ('1', 'Cấp 1', '1');
INSERT INTO `phancap` VALUES ('2', 'Cấp 2', '1');
INSERT INTO `phancap` VALUES ('3', 'Cấp 3', '1');
INSERT INTO `phancap` VALUES ('4', 'Cấp 4', '1');
INSERT INTO `phancap` VALUES ('5', 'Cấp 5', '1');

-- ----------------------------
-- Table structure for phieunhapkho
-- ----------------------------
DROP TABLE IF EXISTS `phieunhapkho`;
CREATE TABLE `phieunhapkho` (
  `pnk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pnk_type` tinyint(2) unsigned NOT NULL COMMENT '0: Nhập | 1:chuyển | 2: Nhập tăng',
  `pnk_nguoi_tao` int(10) unsigned NOT NULL,
  `pnk_ngay_tao` date NOT NULL,
  `pnk_ngay_thuchien` date NOT NULL,
  `pnk_ngay_hethan` date NOT NULL,
  `pnk_status` tinyint(3) NOT NULL,
  `cancunhapkho_id` int(4) unsigned NOT NULL,
  `lydonhapkho_id` tinyint(2) unsigned NOT NULL,
  `donvi_id` int(10) unsigned NOT NULL,
  `donvixuat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pnk_nguoinhanphieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pxn_nguoinhanhang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pnk_nguoiralenh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pnk_donvivanchuyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pnk_phuongtienvanchuyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pnk_sophieu` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pnk_id`),
  KEY `cancunhapkho_id` (`cancunhapkho_id`),
  KEY `lydonhapkho_id` (`lydonhapkho_id`),
  KEY `donvixuat_id` (`donvixuat_name`),
  KEY `donvi_id` (`donvi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of phieunhapkho
-- ----------------------------

-- ----------------------------
-- Table structure for phieuxuatkho
-- ----------------------------
DROP TABLE IF EXISTS `phieuxuatkho`;
CREATE TABLE `phieuxuatkho` (
  `pxk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pxk_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0: xuất | 1:chuyển | 2: Xuất Giảm',
  `pxk_nguoi_tao` int(10) unsigned NOT NULL DEFAULT '0',
  `pxk_ngay_tao` date NOT NULL,
  `pxk_ngay_thuchien` date DEFAULT NULL,
  `pxk_ngay_hethan` date DEFAULT NULL,
  `pxk_status` tinyint(3) NOT NULL COMMENT '0: mới tạo|1: đã thực hiện',
  `cancuxuatkho_id` int(4) unsigned NOT NULL COMMENT 'căn cứ xuất kho (phiếu xuất của trên)',
  `lydoxuatkho_id` tinyint(2) unsigned DEFAULT NULL COMMENT 'về việc: :Lý do xuất kho',
  `donvixuat_id` int(10) DEFAULT NULL COMMENT 'ref donvi_id of donvi',
  `donvinhap_name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'nhập tay',
  `pxk_nguoinhan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'người nhận',
  `pxk_nguoiralenh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'thủ trưởng ra lệnh',
  `pxk_donvivanchuyen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pxk_phuongtienvanchuyen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pxk_sophieu` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'stt/xk-năm',
  `pxk_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'dv-stt/xk-nam',
  `pxk_nguoinhanphieu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pxk_id`),
  KEY `donvinhap_id` (`donvinhap_name`),
  KEY `cancuxuatkho_id` (`cancuxuatkho_id`),
  KEY `lydoxuatkho_id` (`lydoxuatkho_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of phieuxuatkho
-- ----------------------------
INSERT INTO `phieuxuatkho` VALUES ('1', '1', '1', '2016-08-01', '2016-08-01', '2016-08-15', '1', '1', '1', '5', '11', '3', 'Nguyễn Văn Thanh', 'Cục hậu cần', 'Ô tô', '01/XK-2016', 'VP-01/XK-2016', 'Thái');
INSERT INTO `phieuxuatkho` VALUES ('2', '1', '1', '2016-08-01', '2016-08-01', '2016-08-15', '1', '1', '1', '5', '11', '3', 'Trần Vân Anh', 'Cục hậu cần', 'Ô tô', '02/XK-2016', 'VN-02/XK-2016', 'Thái');
INSERT INTO `phieuxuatkho` VALUES ('3', '1', '1', '2016-08-01', '2016-08-01', '2016-08-15', '1', '1', '1', '5', '11', '3', 'Nguyễn Văn Tiến', 'Cục hậu cần', 'Ô tô', '03/XK-2016', 'VP-03/XK-2016', 'Thái');
INSERT INTO `phieuxuatkho` VALUES ('4', '4', '4', '2016-08-01', '2016-08-01', '2016-08-27', '1', '1', '4', '5', '11', '4', 'Trần Văn Anh', 'Cục hậu cần', 'Xe máy', '04/XK-2016', 'VP-04/XK-2016', 'Thái');
INSERT INTO `phieuxuatkho` VALUES ('5', '5', '5', '2016-08-01', '2016-08-01', '2016-08-28', '1', '1', '5', '5', '11', '5', 'Phạn Văn Thái', 'Cục hậu cần', 'Máy bay', '05/XK-2016', 'VP-05/XK-2016', 'Thái');
INSERT INTO `phieuxuatkho` VALUES ('6', '6', '6', '2016-08-01', '2016-08-01', '2016-08-27', '1', '1', '6', '6', '11', '6', 'Trần Vân Anh', 'Cục hậu cần', 'Ô tô', '06/XK-2016', 'VP-06/XK-2016', 'Thái');
INSERT INTO `phieuxuatkho` VALUES ('7', '7', '7', '2016-08-01', '2016-08-01', '2016-08-27', '0', '3', '7', '6', '11', '7', 'Phạm Ngọc Thạch', 'Cục hậu cần', 'Ô tô', '07/XK-2016', 'VP-07/XK-2016', 'Thái');
INSERT INTO `phieuxuatkho` VALUES ('15', '0', '0', '2016-08-01', '2016-08-01', '2016-08-15', '0', '3', '1', '6', '11', 'abcd', 'Lê Trọng Tấn', 'Cục hậu cần', 'Ô tô', '09/XK-2016', 'VP-09/XK-2016', 'Thái');
INSERT INTO `phieuxuatkho` VALUES ('16', '0', '0', '2016-08-31', null, '2016-08-31', '1', '1', '1', '5', '3', 'Người nhận hàng', 'Thủ trưởng ra lệnh', 'Đơn vị vận chuyển', 'Phương tiện vận chuyển', '', '', ' Người nhận phiếu Thủ trưởng ra lệnh');
INSERT INTO `phieuxuatkho` VALUES ('17', '0', '0', '2016-09-02', null, '2016-09-03', '2', '1', '1', '5', '4', 'Nguyen Van A', 'Nguyen Van C', 'don vi A', 'Xe O To', '', '', 'Nguyen Van B');
INSERT INTO `phieuxuatkho` VALUES ('18', '0', '0', '2016-09-06', null, '2016-09-06', '2', '32', '1', '6', '    fdas f', 'f dá fdsa                                                                                ', 'sa fdas fdas fds                                                                                ', 'f afdas fd                                                                                ', ' fdas fd                                                                                ', '', '', ' fdas fdsa fd                                                                                ');
INSERT INTO `phieuxuatkho` VALUES ('19', '0', '0', '2016-09-06', null, '2016-09-06', '2', '32', '1', '6', 'fasdfds', 'f dá fdsa', 'sa fdas fdas fds                                                                                ', 'f afdas fd                                                                                ', ' fdas fd                                                                                ', '', '', ' fdas fdsa fd                                                                                ');
INSERT INTO `phieuxuatkho` VALUES ('20', '0', '0', '2016-09-06', null, '2016-09-06', '2', '32', '1', '5', 'Đơn vị nhậ', 'Người nhận hàng', 'Thủ trưởng ra lệnh  ', 'Đơn vị vận chuyển  ', 'Phương tiện vận chuyển  ', '', '', 'Người nhận phiếu  ');
INSERT INTO `phieuxuatkho` VALUES ('21', '0', '0', '2016-09-07', null, '2016-09-08', '2', '32', '1', '5', 'fdaf dá fd', 'dsa fdsa f', ' fdas fdas fsda f ', 'fdsa fdsa ', ' fdas fdas f ', '9/XK-2016', 'K79-9/XK-2016', 'ds afd àdas ');

-- ----------------------------
-- Table structure for pnk_chitiet
-- ----------------------------
DROP TABLE IF EXISTS `pnk_chitiet`;
CREATE TABLE `pnk_chitiet` (
  `pnk_chitiet_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pnk_id` int(10) unsigned NOT NULL,
  `vukhi_id` float unsigned NOT NULL,
  `nuocsanxuat_id` tinyint(2) unsigned NOT NULL,
  `donvitinh_id` tinyint(2) unsigned NOT NULL,
  `phancap_id` tinyint(2) unsigned NOT NULL,
  `soluong_kehoach` int(10) unsigned NOT NULL,
  `soluong_thucnhap` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pnk_chitiet_id`),
  KEY `pnk_id` (`pnk_id`),
  CONSTRAINT `pnk_chitiet_ibfk_1` FOREIGN KEY (`pnk_id`) REFERENCES `phieunhapkho` (`pnk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pnk_chitiet
-- ----------------------------

-- ----------------------------
-- Table structure for pnk_sohieu
-- ----------------------------
DROP TABLE IF EXISTS `pnk_sohieu`;
CREATE TABLE `pnk_sohieu` (
  `pnk_sohieu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pnk_chitiet_id` int(10) unsigned NOT NULL,
  `sohieuvukhi_id` int(10) unsigned NOT NULL,
  `sohieuvukhi_name` int(10) NOT NULL,
  PRIMARY KEY (`pnk_sohieu_id`),
  KEY `pnk_chitiet_id` (`pnk_chitiet_id`),
  CONSTRAINT `pnk_sohieu_ibfk_1` FOREIGN KEY (`pnk_chitiet_id`) REFERENCES `pnk_chitiet` (`pnk_chitiet_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pnk_sohieu
-- ----------------------------

-- ----------------------------
-- Table structure for pxk_chitiet
-- ----------------------------
DROP TABLE IF EXISTS `pxk_chitiet`;
CREATE TABLE `pxk_chitiet` (
  `pxk_chitiet_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pxk_id` int(11) unsigned NOT NULL,
  `thuclucvukhi_chitiet_id` int(11) unsigned NOT NULL,
  `soluong_kehoach` int(11) DEFAULT '0',
  `soluong_thucxuat` int(11) DEFAULT '0',
  PRIMARY KEY (`pxk_chitiet_id`),
  KEY `pxk_id` (`pxk_id`),
  KEY `thuclucvukhi_chitiet_id` (`thuclucvukhi_chitiet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pxk_chitiet
-- ----------------------------
INSERT INTO `pxk_chitiet` VALUES ('1', '1', '1', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('2', '1', '2', '3', '0');
INSERT INTO `pxk_chitiet` VALUES ('3', '1', '3', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('7', '1', '4', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('8', '1', '5', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('9', '1', '6', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('10', '1', '7', '15', '0');
INSERT INTO `pxk_chitiet` VALUES ('11', '1', '8', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('12', '1', '9', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('13', '1', '10', '5', '0');
INSERT INTO `pxk_chitiet` VALUES ('14', '1', '11', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('15', '2', '12', '2', '0');
INSERT INTO `pxk_chitiet` VALUES ('16', '2', '13', '9', '0');
INSERT INTO `pxk_chitiet` VALUES ('17', '2', '14', '6', '0');
INSERT INTO `pxk_chitiet` VALUES ('18', '2', '15', '58', '0');
INSERT INTO `pxk_chitiet` VALUES ('19', '2', '16', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('20', '2', '17', '200', '0');
INSERT INTO `pxk_chitiet` VALUES ('21', '2', '18', '37', '0');
INSERT INTO `pxk_chitiet` VALUES ('22', '2', '19', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('23', '2', '20', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('24', '2', '21', '3', '0');
INSERT INTO `pxk_chitiet` VALUES ('25', '2', '22', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('26', '2', '23', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('27', '2', '24', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('28', '2', '25', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('29', '2', '26', '15', '0');
INSERT INTO `pxk_chitiet` VALUES ('30', '2', '27', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('31', '2', '28', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('32', '2', '29', '5', '0');
INSERT INTO `pxk_chitiet` VALUES ('33', '2', '30', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('34', '2', '31', '8', '0');
INSERT INTO `pxk_chitiet` VALUES ('35', '2', '32', '9', '0');
INSERT INTO `pxk_chitiet` VALUES ('36', '2', '33', '6', '0');
INSERT INTO `pxk_chitiet` VALUES ('37', '2', '34', '58', '0');
INSERT INTO `pxk_chitiet` VALUES ('38', '4', '35', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('39', '4', '36', '200', '0');
INSERT INTO `pxk_chitiet` VALUES ('40', '4', '37', '37', '0');
INSERT INTO `pxk_chitiet` VALUES ('41', '4', '1', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('42', '4', '2', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('43', '4', '3', '3', '0');
INSERT INTO `pxk_chitiet` VALUES ('44', '4', '4', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('45', '4', '5', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('46', '4', '6', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('47', '4', '7', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('48', '4', '8', '15', '0');
INSERT INTO `pxk_chitiet` VALUES ('49', '4', '9', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('50', '4', '10', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('51', '4', '11', '5', '0');
INSERT INTO `pxk_chitiet` VALUES ('52', '4', '12', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('53', '4', '13', '8', '0');
INSERT INTO `pxk_chitiet` VALUES ('54', '4', '14', '9', '0');
INSERT INTO `pxk_chitiet` VALUES ('55', '4', '15', '6', '0');
INSERT INTO `pxk_chitiet` VALUES ('56', '4', '16', '58', '0');
INSERT INTO `pxk_chitiet` VALUES ('57', '4', '17', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('58', '4', '18', '200', '0');
INSERT INTO `pxk_chitiet` VALUES ('59', '4', '19', '37', '0');
INSERT INTO `pxk_chitiet` VALUES ('60', '4', '20', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('61', '4', '21', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('62', '4', '22', '3', '0');
INSERT INTO `pxk_chitiet` VALUES ('63', '4', '23', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('64', '4', '24', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('65', '4', '25', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('66', '5', '26', '15', '0');
INSERT INTO `pxk_chitiet` VALUES ('67', '5', '27', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('68', '5', '28', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('69', '5', '1', '5', '0');
INSERT INTO `pxk_chitiet` VALUES ('70', '5', '2', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('71', '5', '3', '8', '0');
INSERT INTO `pxk_chitiet` VALUES ('72', '5', '4', '9', '0');
INSERT INTO `pxk_chitiet` VALUES ('73', '5', '5', '6', '0');
INSERT INTO `pxk_chitiet` VALUES ('74', '5', '6', '58', '0');
INSERT INTO `pxk_chitiet` VALUES ('75', '5', '7', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('76', '5', '8', '200', '0');
INSERT INTO `pxk_chitiet` VALUES ('77', '5', '9', '37', '0');
INSERT INTO `pxk_chitiet` VALUES ('78', '5', '10', '20', '0');
INSERT INTO `pxk_chitiet` VALUES ('79', '5', '11', '2', '0');
INSERT INTO `pxk_chitiet` VALUES ('80', '5', '12', '4', '0');
INSERT INTO `pxk_chitiet` VALUES ('81', '5', '13', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('82', '6', '14', '4', '0');
INSERT INTO `pxk_chitiet` VALUES ('83', '6', '15', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('84', '6', '16', '5', '0');
INSERT INTO `pxk_chitiet` VALUES ('85', '6', '17', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('86', '6', '18', '3', '0');
INSERT INTO `pxk_chitiet` VALUES ('87', '6', '19', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('88', '6', '20', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('89', '6', '21', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('90', '6', '22', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('91', '6', '23', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('92', '6', '24', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('93', '6', '25', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('94', '6', '26', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('95', '6', '27', '5', '0');
INSERT INTO `pxk_chitiet` VALUES ('96', '6', '28', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('97', '6', '29', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('98', '6', '30', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('99', '6', '31', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('100', '6', '32', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('101', '7', '33', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('102', '7', '35', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('103', '7', '10', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('104', '7', '12', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('105', '7', '13', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('106', '7', '15', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('107', '7', '1', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('108', '7', '2', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('109', '7', '3', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('110', '7', '4', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('111', '7', '5', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('112', '7', '6', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('113', '7', '7', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('114', '7', '45', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('115', '7', '9', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('116', '7', '10', '5', '0');
INSERT INTO `pxk_chitiet` VALUES ('117', '7', '1', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('118', '8', '1', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('119', '8', '2', '0', '0');
INSERT INTO `pxk_chitiet` VALUES ('120', '8', '4', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('121', '8', '8', '3', '0');
INSERT INTO `pxk_chitiet` VALUES ('122', '8', '1', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('123', '8', '5', '3', '0');
INSERT INTO `pxk_chitiet` VALUES ('124', '8', '4', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('125', '8', '2', '2', '0');
INSERT INTO `pxk_chitiet` VALUES ('126', '8', '5', '3', '0');
INSERT INTO `pxk_chitiet` VALUES ('127', '8', '3', '4', '0');
INSERT INTO `pxk_chitiet` VALUES ('128', '8', '162', '5', '0');
INSERT INTO `pxk_chitiet` VALUES ('129', '16', '1', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('130', '16', '2', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('131', '16', '3', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('132', '16', '4', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('133', '16', '5', '10', '0');
INSERT INTO `pxk_chitiet` VALUES ('134', '17', '1', '1', '5');
INSERT INTO `pxk_chitiet` VALUES ('135', '17', '2', '2', '1');
INSERT INTO `pxk_chitiet` VALUES ('136', '17', '3', '1', '1');
INSERT INTO `pxk_chitiet` VALUES ('137', '17', '4', '1', '1');
INSERT INTO `pxk_chitiet` VALUES ('138', '17', '5', '1', '1');
INSERT INTO `pxk_chitiet` VALUES ('139', '17', '111', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('140', '17', '112', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('141', '17', '113', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('142', '17', '114', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('143', '17', '115', '1', '1');
INSERT INTO `pxk_chitiet` VALUES ('144', '18', '36', '99', '3');
INSERT INTO `pxk_chitiet` VALUES ('145', '18', '38', '30', '2');
INSERT INTO `pxk_chitiet` VALUES ('146', '18', '39', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('147', '18', '40', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('148', '19', '36', '50', '0');
INSERT INTO `pxk_chitiet` VALUES ('149', '19', '38', '2', '0');
INSERT INTO `pxk_chitiet` VALUES ('150', '19', '40', '5', '2');
INSERT INTO `pxk_chitiet` VALUES ('151', '20', '1', '1', '0');
INSERT INTO `pxk_chitiet` VALUES ('152', '20', '2', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('153', '20', '3', '1', '1');
INSERT INTO `pxk_chitiet` VALUES ('154', '20', '4', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('155', '20', '5', '2', '1');
INSERT INTO `pxk_chitiet` VALUES ('156', '20', '27', '2', '2');
INSERT INTO `pxk_chitiet` VALUES ('157', '20', '28', '3', '1');
INSERT INTO `pxk_chitiet` VALUES ('158', '20', '29', '3', '1');
INSERT INTO `pxk_chitiet` VALUES ('159', '20', '30', '3', '1');
INSERT INTO `pxk_chitiet` VALUES ('160', '21', '2', '3', '2');
INSERT INTO `pxk_chitiet` VALUES ('161', '21', '3', '1', '1');

-- ----------------------------
-- Table structure for pxk_sohieu
-- ----------------------------
DROP TABLE IF EXISTS `pxk_sohieu`;
CREATE TABLE `pxk_sohieu` (
  `pxk_sohieu_id` int(11) unsigned NOT NULL,
  `pxk_chitiet_id` int(11) unsigned NOT NULL,
  `sohieuvukhi_id` int(10) unsigned NOT NULL,
  `sohieuvukhi_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pxk_sohieu_id`),
  KEY `pxk_chitiet_id` (`pxk_chitiet_id`),
  KEY `sohieuvukhi_id` (`sohieuvukhi_name`),
  CONSTRAINT `pxk_sohieu_ibfk_1` FOREIGN KEY (`pxk_chitiet_id`) REFERENCES `pxk_chitiet` (`pxk_chitiet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pxk_sohieu
-- ----------------------------

-- ----------------------------
-- Table structure for sohieuvukhi
-- ----------------------------
DROP TABLE IF EXISTS `sohieuvukhi`;
CREATE TABLE `sohieuvukhi` (
  `sohieuvukhi_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `thuclucvukhi_chitiet_id` int(10) unsigned NOT NULL,
  `sohieuvukhi_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sohieuvukhi_nhakho` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sohieuvukhi_gia` tinyint(2) unsigned DEFAULT NULL,
  `sohieuvukhi_tang` tinyint(2) unsigned DEFAULT NULL,
  `sohieuvukhi_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1: Mờ số hiệu; 0: không mờ số hiệu',
  `sohieuvukhi_active` tinyint(2) NOT NULL DEFAULT '1' COMMENT 'chưa dùng để làm gì',
  `hevukhi_id` tinyint(2) NOT NULL,
  `nhomvukhi_id` tinyint(2) NOT NULL,
  `covukhi_id` int(10) NOT NULL,
  `vukhi_id` int(10) NOT NULL,
  `nuocsanxuat_id` tinyint(2) NOT NULL,
  `donvitinh_id` tinyint(2) NOT NULL,
  `phancap_id` tinyint(2) NOT NULL,
  `soluong` int(10) NOT NULL DEFAULT '1',
  `donvi_id` int(10) NOT NULL,
  PRIMARY KEY (`sohieuvukhi_id`),
  KEY `thuclucvukhi_chitiet_id` (`thuclucvukhi_chitiet_id`),
  CONSTRAINT `sohieuvukhi_ibfk_1` FOREIGN KEY (`sohieuvukhi_id`) REFERENCES `pxk_sohieu` (`pxk_sohieu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sohieuvukhi
-- ----------------------------

-- ----------------------------
-- Table structure for sophieu
-- ----------------------------
DROP TABLE IF EXISTS `sophieu`;
CREATE TABLE `sophieu` (
  `sophieu_key` int(11) NOT NULL DEFAULT '0' COMMENT 'year + 1: phieu nhap | year + 2: phieu xuat',
  `sophieu_year` year(4) NOT NULL,
  `sophieu_stt` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`sophieu_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sophieu
-- ----------------------------
INSERT INTO `sophieu` VALUES ('20162', '2016', '9');

-- ----------------------------
-- Table structure for thuclucdongbo
-- ----------------------------
DROP TABLE IF EXISTS `thuclucdongbo`;
CREATE TABLE `thuclucdongbo` (
  `thuclucdongbo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nhomvukhi_id` tinyint(2) unsigned NOT NULL,
  `vukhi_id` int(10) unsigned NOT NULL,
  `danhmucdongbo_id` int(10) unsigned NOT NULL,
  `nuocsanxuat_id` tinyint(2) unsigned DEFAULT NULL,
  `donvitinh_id` tinyint(2) unsigned DEFAULT NULL,
  `phancap_id` tinyint(2) unsigned NOT NULL,
  `soluong` int(10) unsigned NOT NULL,
  `dinvi_id` int(10) unsigned NOT NULL,
  `thuclucdongbo_active` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`thuclucdongbo_id`),
  KEY `danhmucdongbo_id` (`danhmucdongbo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of thuclucdongbo
-- ----------------------------

-- ----------------------------
-- Table structure for thuclucvukhi
-- ----------------------------
DROP TABLE IF EXISTS `thuclucvukhi`;
CREATE TABLE `thuclucvukhi` (
  `thuclucvukhi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hevukhi_id` tinyint(2) unsigned NOT NULL,
  `nhomvukhi_id` tinyint(2) unsigned NOT NULL,
  `covukhi_id` int(10) unsigned NOT NULL,
  `vukhi_id` int(10) unsigned NOT NULL,
  `nuocsanxuat_id` tinyint(2) unsigned NOT NULL,
  `donvitinh_id` tinyint(2) unsigned NOT NULL,
  `soluong` int(10) NOT NULL,
  `cohom` int(10) DEFAULT NULL,
  `trengia` int(10) DEFAULT NULL,
  `kekich` int(10) DEFAULT NULL,
  `Chiendau` int(10) DEFAULT NULL COMMENT 'Sử dụng chiến đấu',
  `hlnt` int(10) DEFAULT NULL COMMENT 'Sử dụng HL&NT',
  `Kho` int(10) DEFAULT NULL COMMENT 'Cất giữ trong kho',
  `donvi_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`thuclucvukhi_id`),
  UNIQUE KEY `unique_tlvk` (`hevukhi_id`,`nhomvukhi_id`,`covukhi_id`,`vukhi_id`,`nuocsanxuat_id`,`donvitinh_id`,`donvi_id`) USING BTREE,
  KEY `hevukhi_id` (`hevukhi_id`),
  KEY `nhomvukhi_id` (`nhomvukhi_id`),
  KEY `covukhi_id` (`covukhi_id`),
  KEY `donvi_id` (`donvi_id`),
  KEY `nuocsanxuat_id` (`nuocsanxuat_id`),
  KEY `donvitinh_id` (`donvitinh_id`),
  KEY `vukhi_id` (`vukhi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of thuclucvukhi
-- ----------------------------
INSERT INTO `thuclucvukhi` VALUES ('1', '1', '1', '1', '1', '1', '1', '108', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi` VALUES ('6', '1', '1', '2', '9', '1', '5', '260', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi` VALUES ('8', '1', '1', '1', '1', '2', '1', '218', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi` VALUES ('11', '1', '2', '9', '22', '3', '2', '180', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi` VALUES ('12', '1', '1', '2', '9', '1', '5', '340', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi` VALUES ('14', '1', '1', '1', '1', '1', '4', '150', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi` VALUES ('21', '1', '1', '1', '1', '1', '1', '150', null, null, null, null, null, null, '2');
INSERT INTO `thuclucvukhi` VALUES ('22', '1', '1', '2', '8', '3', '1', '151', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi` VALUES ('23', '1', '1', '2', '8', '2', '1', '350', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi` VALUES ('24', '1', '1', '1', '1', '2', '1', '30', null, null, null, null, null, null, '5');

-- ----------------------------
-- Table structure for thuclucvukhi_chitiet
-- ----------------------------
DROP TABLE IF EXISTS `thuclucvukhi_chitiet`;
CREATE TABLE `thuclucvukhi_chitiet` (
  `thuclucvukhi_chitiet_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thuclucvukhi_id` int(10) unsigned NOT NULL,
  `phancap_id` tinyint(2) unsigned NOT NULL,
  `soluong` int(10) NOT NULL DEFAULT '0',
  `hevukhi_id` tinyint(2) NOT NULL,
  `nhomvukhi_id` tinyint(2) NOT NULL,
  `covukhi_id` int(10) NOT NULL,
  `vukhi_id` int(10) NOT NULL,
  `nuocsanxuat_id` tinyint(2) DEFAULT NULL,
  `donvitinh_id` tinyint(2) DEFAULT NULL,
  `cohom` int(10) DEFAULT NULL,
  `trengia` int(10) DEFAULT NULL,
  `kekich` int(10) DEFAULT NULL,
  `chiendau` int(10) DEFAULT NULL,
  `hluyen_ntruong` int(10) DEFAULT NULL,
  `trongkho` int(10) DEFAULT NULL,
  `donvi_id` int(10) NOT NULL,
  PRIMARY KEY (`thuclucvukhi_chitiet_id`),
  UNIQUE KEY `unique_tldv` (`phancap_id`,`soluong`,`hevukhi_id`,`nhomvukhi_id`,`covukhi_id`,`vukhi_id`,`nuocsanxuat_id`,`donvitinh_id`,`donvi_id`),
  KEY `thuclucvukhi_id` (`thuclucvukhi_id`),
  KEY `phancap_id` (`phancap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of thuclucvukhi_chitiet
-- ----------------------------
INSERT INTO `thuclucvukhi_chitiet` VALUES ('1', '1', '1', '-4', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('2', '1', '2', '22', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('3', '1', '3', '28', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('4', '1', '4', '33', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('5', '1', '5', '19', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('26', '6', '1', '0', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('27', '6', '2', '48', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('28', '6', '3', '69', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('29', '6', '4', '89', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('30', '6', '5', '49', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('36', '8', '1', '97', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('37', '8', '2', '0', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('38', '8', '3', '28', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('39', '8', '4', '38', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('40', '8', '5', '46', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('51', '11', '1', '10', '1', '2', '9', '22', '3', '2', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('52', '11', '2', '20', '1', '2', '9', '22', '3', '2', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('53', '11', '3', '30', '1', '2', '9', '22', '3', '2', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('54', '11', '4', '50', '1', '2', '9', '22', '3', '2', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('55', '11', '5', '70', '1', '2', '9', '22', '3', '2', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('56', '12', '1', '30', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('57', '12', '2', '50', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('58', '12', '3', '70', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('59', '12', '4', '90', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('60', '12', '5', '100', '1', '1', '2', '9', '1', '5', null, null, null, null, null, null, '6');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('61', '14', '1', '10', '1', '1', '1', '1', '1', '4', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('62', '14', '2', '20', '1', '1', '1', '1', '1', '4', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('63', '14', '3', '30', '1', '1', '1', '1', '1', '4', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('64', '14', '4', '40', '1', '1', '1', '1', '1', '4', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('65', '14', '5', '50', '1', '1', '1', '1', '1', '4', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('96', '21', '1', '10', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '2');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('97', '21', '2', '20', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '2');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('98', '21', '3', '30', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '2');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('99', '21', '4', '40', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '2');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('100', '21', '5', '50', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '2');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('101', '22', '1', '40', '1', '1', '2', '8', '3', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('102', '22', '2', '30', '1', '1', '2', '8', '3', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('103', '22', '3', '20', '1', '1', '2', '8', '3', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('104', '22', '4', '10', '1', '1', '2', '8', '3', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('105', '22', '5', '51', '1', '1', '2', '8', '3', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('106', '23', '1', '80', '1', '1', '2', '8', '2', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('107', '23', '2', '90', '1', '1', '2', '8', '2', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('108', '23', '3', '70', '1', '1', '2', '8', '2', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('109', '23', '4', '60', '1', '1', '2', '8', '2', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('110', '23', '5', '50', '1', '1', '2', '8', '2', '1', null, null, null, null, null, null, '1');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('111', '24', '1', '6', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('112', '24', '2', '6', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('113', '24', '3', '6', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('114', '24', '4', '6', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '5');
INSERT INTO `thuclucvukhi_chitiet` VALUES ('115', '24', '5', '6', '1', '1', '1', '1', '2', '1', null, null, null, null, null, null, '5');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for vukhi
-- ----------------------------
DROP TABLE IF EXISTS `vukhi`;
CREATE TABLE `vukhi` (
  `covukhi_id` int(10) unsigned NOT NULL,
  `vukhi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vukhi_code` int(10) DEFAULT NULL,
  `vukhi_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vukhi_kyhieu` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vukhi_trongluong` float DEFAULT '0',
  `vukhi_dai` float DEFAULT NULL,
  `vukhi_rong` float DEFAULT NULL,
  `vukhi_cao` float DEFAULT NULL,
  `vukhi_active` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`vukhi_id`),
  KEY `covukhi_id` (`covukhi_id`),
  CONSTRAINT `vukhi_ibfk_1` FOREIGN KEY (`covukhi_id`) REFERENCES `covukhi` (`covukhi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of vukhi
-- ----------------------------
INSERT INTO `vukhi` VALUES ('1', '1', '1', 'Pháo nòng vừa 152mm D20', 'D20', '5650', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('1', '5', '2', 'Pháo tự hành 152mm AKASIA', '2S-3M', '27500', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('1', '6', '3', 'Pháo nòng vừa 152mm ML20', 'ML20', '8070', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('1', '7', '4', 'Pháo nòng dài 152mm M47', 'M47', '8450', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('2', '8', '1', 'Pháo nòng dài 130mm M46', 'M46', '8450', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('2', '9', '2', 'Pháo nòng dài 130mm K59', 'K59', '8450', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('2', '10', '3', 'Pháo nòng dài 130mm K59-1', 'K59-1', '8540', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '11', '1', 'Pháo nòng dài 122mm Đ74', 'Đ74', '5550', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '12', '2', 'Pháo nòng dài 122mm K60', 'K60', '5550', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '13', '3', 'Pháo nòng ngắn 122mm K38', 'K38', '2500', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '14', '4', 'Pháo nòng ngắn 122mm M30', 'M30', '2500', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '15', '5', 'Pháo nòng ngắn 122mm K54', 'K54', '2500', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '16', '6', 'Pháo nòng ngắn 122mm K54-1', 'K54-1', '2500', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '17', '7', 'Pháo nòng vừa 122mm Đ30', 'Đ30', '3290', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '18', '8', 'Pháo tự hành 122mm GVOZDIKA', '2S-1', '15500', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('3', '19', '9', 'Pháo nòng dài 122mm 1931/37', '1931/37', '8050', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('9', '20', '1', 'Pháo chống tăng 85mm Đ44', 'Đ44', '1750', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('9', '21', '2', 'Pháo chống tăng 85mm Đ48', 'Đ48', '1750', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('9', '22', '3', 'Pháo chống tăng 85mm K56', 'K56', '1750', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('10', '23', '1', 'Pháo chống tăng 76mm K54', 'K54', '1250', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('10', '24', '2', 'Pháo chống tăng 76mm K1943', 'K1943', '1250', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('10', '25', '3', 'Pháo chống tăng 76mm K1942', 'ZIS-3', '1250', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('38', '26', '1', 'Pháo cao xạ 57mm C-60', 'C-60', '5000', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('38', '27', '2', 'Pháo cao xạ 57mm K-59', 'K-59', '5000', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('39', '28', '1', 'Pháo cao xạ 37mm-2 K65', 'K65', '3200', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('39', '29', '2', 'Pháo cao xạ 37mm-1 K39', 'K39', '2500', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('39', '30', '3', 'Pháo cao xạ 37mm-1 K55', 'K55', '2500', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('49', '31', '1', 'Súng ngắn 6,53mm', null, '1', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('49', '32', '2', 'Súng ngắn 7,62mm K51', null, '1', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('49', '33', '3', 'Súng ngắn 7,62 K54', null, '1', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('49', '34', '4', 'Súng ngắn 7,62 TT-33', null, '1', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('49', '35', '5', 'Súng ngắn 7,62 VZ-52', null, '1', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('50', '36', '1', 'Súng trường 7,62mm CKC', null, '4', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('50', '37', '2', 'Súng trường 7,62mm K44', null, '4', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('52', '38', '1', 'Súng tiểu liên 7,62mm AK báng gỗ', null, '4', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('52', '39', '2', 'Súng tiểu liên 7,62mm AK báng gấp', null, '4', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('52', '40', '3', 'Súng tiểu liên 7,62mm VZ58 báng gỗ', null, '3', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('52', '44', '4', 'Súng tiểu liên 7,62mm VZ58 báng gấp', null, '3', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('76', '45', '1', 'Pháo nòng ngắn 155mm M1', null, '5700', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('76', '46', '2', 'Pháo nòng ngắn 155mm M2', null, '5700', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('77', '47', '1', 'Pháo nòng ngắn 105mm M101 (M2A1)', null, '2030', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('77', '48', '2', 'Pháo nòng ngắn 105mm M101 (M2A2)', null, '2260', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('77', '49', '3', 'Pháo nòng ngắn 105mm M102', null, '1427', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('77', '50', '4', 'Pháo nòng ngắn 105mm Dù', null, '1427', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('103', '51', '1', 'Súng tiểu liên 5,56mm AR-15', null, '3', null, null, null, '1');
INSERT INTO `vukhi` VALUES ('103', '52', '2', 'Súng tiểu liên 11,43mm THOMSON', null, '5', null, null, null, '1');

-- ----------------------------
-- Table structure for ____thuclucdonvi
-- ----------------------------
DROP TABLE IF EXISTS `____thuclucdonvi`;
CREATE TABLE `____thuclucdonvi` (
  `thuclucdonvi_id` int(10) unsigned NOT NULL,
  `hevukhi_id` tinyint(2) NOT NULL,
  `nhomvukhi_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `covukhi_id` int(10) NOT NULL,
  `vukhi_id` int(10) NOT NULL,
  `nuocsanxuat_id` tinyint(2) NOT NULL,
  `donvitinh_id` tinyint(2) NOT NULL,
  `phancap_id` tinyint(2) DEFAULT NULL,
  `soluong` int(10) DEFAULT NULL,
  `cohom` int(10) DEFAULT NULL,
  `trengia` int(10) DEFAULT NULL,
  `kekich` int(10) DEFAULT NULL,
  `chiendau` int(10) DEFAULT NULL COMMENT 'Sử dụng chiến đấu',
  `hlnt` int(10) DEFAULT NULL COMMENT 'Sử dụng HL&NT',
  `kho` int(10) DEFAULT NULL COMMENT 'Cất giữ trong kho',
  `donvi_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`thuclucdonvi_id`),
  KEY `hevukhi_id` (`hevukhi_id`),
  KEY `nhomvukhi_id` (`nhomvukhi_id`),
  KEY `covukhi_id` (`covukhi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ____thuclucdonvi
-- ----------------------------
