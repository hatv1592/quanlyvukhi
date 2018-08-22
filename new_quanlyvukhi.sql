/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100131
 Source Host           : localhost:3306
 Source Schema         : quanlyvukhi

 Target Server Type    : MySQL
 Target Server Version : 100131
 File Encoding         : 65001

 Date: 21/08/2018 23:34:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ____thuclucdonvi
-- ----------------------------
DROP TABLE IF EXISTS `____thuclucdonvi`;
CREATE TABLE `____thuclucdonvi`  (
  `thuclucdonvi_id` int(10) UNSIGNED NOT NULL,
  `hevukhi_id` tinyint(2) NOT NULL,
  `nhomvukhi_id` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `covukhi_id` int(10) NOT NULL,
  `vukhi_id` int(10) NOT NULL,
  `nuocsanxuat_id` tinyint(2) NOT NULL,
  `donvitinh_id` tinyint(2) NOT NULL,
  `phancap_id` tinyint(2) NULL DEFAULT NULL,
  `soluong` int(10) NULL DEFAULT NULL,
  `cohom` int(10) NULL DEFAULT NULL,
  `trengia` int(10) NULL DEFAULT NULL,
  `kekich` int(10) NULL DEFAULT NULL,
  `chiendau` int(10) NULL DEFAULT NULL COMMENT 'Sử dụng chiến đấu',
  `hlnt` int(10) NULL DEFAULT NULL COMMENT 'Sử dụng HL&NT',
  `kho` int(10) NULL DEFAULT NULL COMMENT 'Cất giữ trong kho',
  `donvi_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`thuclucdonvi_id`) USING BTREE,
  INDEX `hevukhi_id`(`hevukhi_id`) USING BTREE,
  INDEX `nhomvukhi_id`(`nhomvukhi_id`) USING BTREE,
  INDEX `covukhi_id`(`covukhi_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cancunhapkho
-- ----------------------------
DROP TABLE IF EXISTS `cancunhapkho`;
CREATE TABLE `cancunhapkho`  (
  `cancunhapkho_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cancunhapkho_code` int(4) UNSIGNED NOT NULL,
  `cancunhapkho_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cancunhapkho_date` date NULL DEFAULT NULL,
  `cancunhapkho_coquan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'cơ quan ra lệnh nhập kho',
  `cancunhapkho_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cancunhapkho_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cancunhapkho_active` tinyint(2) NOT NULL DEFAULT 1,
  `cancunhapkho_type` tinyint(2) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0: nhập | 1:chuyển | 2: nhập tăng',
  PRIMARY KEY (`cancunhapkho_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cancunhapkho
-- ----------------------------
INSERT INTO `cancunhapkho` VALUES (1, 0, 'găeg', '2018-01-06', 'ưe', 'abc', 'aba', 1, 1);

-- ----------------------------
-- Table structure for cancuxuatkho
-- ----------------------------
DROP TABLE IF EXISTS `cancuxuatkho`;
CREATE TABLE `cancuxuatkho`  (
  `cancuxuatkho_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cancuxuatkho_code` int(4) UNSIGNED NOT NULL,
  `cancuxuatkho_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cancuxuatkho_date` date NULL DEFAULT NULL,
  `cancuxuatkho_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cancuxuatkho_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cancuxuatkho_active` tinyint(2) NOT NULL DEFAULT 1,
  `cancuxuatkho_type` tinyint(2) NULL DEFAULT 0 COMMENT '0: xuất | 1:chuyển | 2: nhập giảm',
  PRIMARY KEY (`cancuxuatkho_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for covukhi
-- ----------------------------
DROP TABLE IF EXISTS `covukhi`;
CREATE TABLE `covukhi`  (
  `nhomvukhi_id` tinyint(2) UNSIGNED NOT NULL,
  `covukhi_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Covukhi_code` int(10) NULL DEFAULT NULL,
  `covukhi_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `covukhi_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`covukhi_id`) USING BTREE,
  INDEX `nhomvukhi_id`(`nhomvukhi_id`) USING BTREE,
  CONSTRAINT `covukhi_ibfk_1` FOREIGN KEY (`nhomvukhi_id`) REFERENCES `nhomvukhi` (`nhomvukhi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for danhmucdongbo
-- ----------------------------
DROP TABLE IF EXISTS `danhmucdongbo`;
CREATE TABLE `danhmucdongbo`  (
  `danhmucdongbo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nhomvukhi_id` tinyint(2) UNSIGNED NOT NULL,
  `vukhi_id` int(10) UNSIGNED NOT NULL,
  `danhmucdongbo_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `danhmucdongbo_sltc` tinyint(2) NULL DEFAULT 1,
  `danhmucdongbo_active` tinyint(2) NULL DEFAULT 1,
  PRIMARY KEY (`danhmucdongbo_id`) USING BTREE,
  INDEX `nhomvukhi_id`(`nhomvukhi_id`) USING BTREE,
  INDEX `vukhi_id`(`vukhi_id`) USING BTREE,
  CONSTRAINT `danhmucdongbo_ibfk_1` FOREIGN KEY (`nhomvukhi_id`) REFERENCES `nhomvukhi` (`nhomvukhi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `danhmucdongbo_ibfk_2` FOREIGN KEY (`vukhi_id`) REFERENCES `vukhi` (`vukhi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `danhmucdongbo_ibfk_3` FOREIGN KEY (`danhmucdongbo_id`) REFERENCES `thuclucdongbo` (`thuclucdongbo_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for donvi
-- ----------------------------
DROP TABLE IF EXISTS `donvi`;
CREATE TABLE `donvi`  (
  `donvi_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `donvi_cha` int(10) UNSIGNED NOT NULL,
  `donvi_ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `donvi_level` tinyint(2) UNSIGNED NOT NULL,
  PRIMARY KEY (`donvi_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for donvinhap
-- ----------------------------
DROP TABLE IF EXISTS `donvinhap`;
CREATE TABLE `donvinhap`  (
  `downvinhap_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `donvinap_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `donvinhap_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `donvinhap_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`downvinhap_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for donvitinh
-- ----------------------------
DROP TABLE IF EXISTS `donvitinh`;
CREATE TABLE `donvitinh`  (
  `donvitinh_id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `donvitinh_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `donvitinh_active` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`donvitinh_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for donvixuat
-- ----------------------------
DROP TABLE IF EXISTS `donvixuat`;
CREATE TABLE `donvixuat`  (
  `donvixuat_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `donvixuat_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `donvixuat_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `donvixuat_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`donvixuat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hevukhi
-- ----------------------------
DROP TABLE IF EXISTS `hevukhi`;
CREATE TABLE `hevukhi`  (
  `hevukhi_id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hevukhi_code` tinyint(2) NULL DEFAULT NULL,
  `hevukhi_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hevukhi_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`hevukhi_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for lydonhapkho
-- ----------------------------
DROP TABLE IF EXISTS `lydonhapkho`;
CREATE TABLE `lydonhapkho`  (
  `lydonhapkho_id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lydonhapkho_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lydonhapkho_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `lydonhapkho_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`lydonhapkho_id`) USING BTREE,
  CONSTRAINT `lydonhapkho_ibfk_1` FOREIGN KEY (`lydonhapkho_id`) REFERENCES `phieunhapkho` (`lydonhapkho_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for lydoxuatkho
-- ----------------------------
DROP TABLE IF EXISTS `lydoxuatkho`;
CREATE TABLE `lydoxuatkho`  (
  `lydoxuatkho_id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lydoxuatkho_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lydoxuatkho_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lydoxuatkho_active` tinyint(2) NULL DEFAULT 1,
  PRIMARY KEY (`lydoxuatkho_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of lydoxuatkho
-- ----------------------------
INSERT INTO `lydoxuatkho` VALUES (1, '', '', 1);

-- ----------------------------
-- Table structure for nhomvukhi
-- ----------------------------
DROP TABLE IF EXISTS `nhomvukhi`;
CREATE TABLE `nhomvukhi`  (
  `hevukhi_id` tinyint(2) UNSIGNED NOT NULL,
  `nhomvukhi_id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nhomvukhi_Code` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `nhomvukhi_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nhomvukhi_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`nhomvukhi_id`) USING BTREE,
  INDEX `hevukhi_id`(`hevukhi_id`) USING BTREE,
  CONSTRAINT `nhomvukhi_ibfk_1` FOREIGN KEY (`hevukhi_id`) REFERENCES `hevukhi` (`hevukhi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for nuocsanxuat
-- ----------------------------
DROP TABLE IF EXISTS `nuocsanxuat`;
CREATE TABLE `nuocsanxuat`  (
  `nuocsanxuat_id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hevukhi_id` tinyint(2) UNSIGNED NOT NULL,
  `nuocsanxuat_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nuocsanxuat_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`nuocsanxuat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for phancap
-- ----------------------------
DROP TABLE IF EXISTS `phancap`;
CREATE TABLE `phancap`  (
  `phancap_id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phancap_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phancap_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`phancap_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for phieunhapkho
-- ----------------------------
DROP TABLE IF EXISTS `phieunhapkho`;
CREATE TABLE `phieunhapkho`  (
  `pnk_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pnk_type` tinyint(2) UNSIGNED NOT NULL COMMENT '0: Nhập | 1:chuyển | 2: Nhập tăng',
  `pnk_nguoi_tao` int(10) UNSIGNED NOT NULL,
  `pnk_ngay_tao` date NOT NULL,
  `pnk_ngay_thuchien` date NOT NULL,
  `pnk_ngay_hethan` date NOT NULL,
  `pnk_status` tinyint(3) NOT NULL,
  `cancunhapkho_id` int(4) UNSIGNED NOT NULL,
  `lydonhapkho_id` tinyint(2) UNSIGNED NOT NULL,
  `donvi_id` int(10) UNSIGNED NOT NULL,
  `donvixuat_id` int(10) UNSIGNED NOT NULL,
  `pnk_nguoinhanphieu` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pxn_nguoinhanhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pnk_nguoiralenh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pnk_donvivanchuyen` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pnk_phuongtienvanchuyen` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pnk_sophieu` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pnk_id`) USING BTREE,
  INDEX `cancunhapkho_id`(`cancunhapkho_id`) USING BTREE,
  INDEX `lydonhapkho_id`(`lydonhapkho_id`) USING BTREE,
  INDEX `donvixuat_id`(`donvixuat_id`) USING BTREE,
  INDEX `donvi_id`(`donvi_id`) USING BTREE,
  CONSTRAINT `phieunhapkho_ibfk_1` FOREIGN KEY (`cancunhapkho_id`) REFERENCES `cancunhapkho` (`cancunhapkho_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `phieunhapkho_ibfk_3` FOREIGN KEY (`donvixuat_id`) REFERENCES `donvixuat` (`donvixuat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `phieunhapkho_ibfk_4` FOREIGN KEY (`donvi_id`) REFERENCES `donvi` (`donvi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for phieuxuatkho
-- ----------------------------
DROP TABLE IF EXISTS `phieuxuatkho`;
CREATE TABLE `phieuxuatkho`  (
  `pxk_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pxk_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0: xuất | 1:chuyển | 2: Xuất Giảm',
  `pxk_nguoi_tao` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pxk_ngay_tao` date NOT NULL,
  `pxk_ngay_thuchien` date NULL DEFAULT NULL,
  `pxk_ngay_hethan` date NULL DEFAULT NULL,
  `pxk_status` tinyint(3) NOT NULL COMMENT '0: mới tạo|1: đã thực hiện',
  `cancuxuatkho_id` int(4) UNSIGNED NOT NULL COMMENT 'căn cứ xuất kho (phiếu xuất của trên)',
  `lydoxuatkho_id` tinyint(2) UNSIGNED NULL DEFAULT NULL COMMENT 'về việc: :Lý do xuất kho',
  `donvi_id` int(10) NULL DEFAULT NULL COMMENT 'ref donvi_id of donvi',
  `donvinhap_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT 'nhập tay',
  `pxk_nguoinhan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'người nhận',
  `pxk_nguoiralenh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'thủ trưởng ra lệnh',
  `pxk_donvivanchuyen` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `pxk_phuongtienvanchuyen` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `pxk_sophieu` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'stt/xk-năm',
  `pxk_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pxk_id`) USING BTREE,
  INDEX `donvinhap_id`(`donvinhap_id`) USING BTREE,
  INDEX `cancuxuatkho_id`(`cancuxuatkho_id`) USING BTREE,
  INDEX `lydoxuatkho_id`(`lydoxuatkho_id`) USING BTREE,
  CONSTRAINT `phieuxuatkho_ibfk_1` FOREIGN KEY (`donvinhap_id`) REFERENCES `donvinhap` (`downvinhap_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `phieuxuatkho_ibfk_2` FOREIGN KEY (`cancuxuatkho_id`) REFERENCES `cancuxuatkho` (`cancuxuatkho_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `phieuxuatkho_ibfk_3` FOREIGN KEY (`lydoxuatkho_id`) REFERENCES `lydoxuatkho` (`lydoxuatkho_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for pnk_chitiet
-- ----------------------------
DROP TABLE IF EXISTS `pnk_chitiet`;
CREATE TABLE `pnk_chitiet`  (
  `pnk_chitiet_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pnk_id` int(10) UNSIGNED NOT NULL,
  `vukhi_id` float UNSIGNED NOT NULL,
  `nuocsanxuat_id` tinyint(2) UNSIGNED NOT NULL,
  `donvitinh_id` tinyint(2) UNSIGNED NOT NULL,
  `phancap_id` tinyint(2) UNSIGNED NOT NULL,
  `thuclucvukhi_chitiet_id` int(11) NOT NULL DEFAULT 0,
  `soluong_kehoach` int(10) UNSIGNED NOT NULL,
  `soluong_thucnhap` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`pnk_chitiet_id`) USING BTREE,
  INDEX `pnk_id`(`pnk_id`) USING BTREE,
  CONSTRAINT `pnk_chitiet_ibfk_1` FOREIGN KEY (`pnk_id`) REFERENCES `phieunhapkho` (`pnk_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for pnk_sohieu
-- ----------------------------
DROP TABLE IF EXISTS `pnk_sohieu`;
CREATE TABLE `pnk_sohieu`  (
  `pnk_sohieu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pnk_chitiet_id` int(10) UNSIGNED NOT NULL,
  `sohieuvukhi_id` int(10) UNSIGNED NOT NULL,
  `sohieuvukhi_name` int(10) NOT NULL,
  PRIMARY KEY (`pnk_sohieu_id`) USING BTREE,
  INDEX `pnk_chitiet_id`(`pnk_chitiet_id`) USING BTREE,
  CONSTRAINT `pnk_sohieu_ibfk_1` FOREIGN KEY (`pnk_chitiet_id`) REFERENCES `pnk_chitiet` (`pnk_chitiet_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for pxk_chitiet
-- ----------------------------
DROP TABLE IF EXISTS `pxk_chitiet`;
CREATE TABLE `pxk_chitiet`  (
  `pxk_chitiet_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pxk_id` int(11) UNSIGNED NOT NULL,
  `thuclucvukhi_chitiet_id` int(11) UNSIGNED NOT NULL,
  `soluong_kehoach` int(11) NULL DEFAULT 0,
  `soluong_thucxuat` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`pxk_chitiet_id`) USING BTREE,
  INDEX `pxk_id`(`pxk_id`) USING BTREE,
  INDEX `thuclucvukhi_chitiet_id`(`thuclucvukhi_chitiet_id`) USING BTREE,
  CONSTRAINT `pxk_chitiet_ibfk_1` FOREIGN KEY (`pxk_id`) REFERENCES `phieuxuatkho` (`pxk_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pxk_chitiet_ibfk_2` FOREIGN KEY (`thuclucvukhi_chitiet_id`) REFERENCES `thuclucvukhi_chitiet` (`thuclucvukhi_chitiet_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for pxk_sohieu
-- ----------------------------
DROP TABLE IF EXISTS `pxk_sohieu`;
CREATE TABLE `pxk_sohieu`  (
  `pxk_sohieu_id` int(11) UNSIGNED NOT NULL,
  `pxk_chitiet_id` int(11) UNSIGNED NOT NULL,
  `sohieuvukhi_id` int(10) UNSIGNED NOT NULL,
  `sohieuvukhi_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pxk_sohieu_id`) USING BTREE,
  INDEX `pxk_chitiet_id`(`pxk_chitiet_id`) USING BTREE,
  INDEX `sohieuvukhi_id`(`sohieuvukhi_name`) USING BTREE,
  CONSTRAINT `pxk_sohieu_ibfk_1` FOREIGN KEY (`pxk_chitiet_id`) REFERENCES `pxk_chitiet` (`pxk_chitiet_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'viewer', 'Xem', NULL);
INSERT INTO `roles` VALUES (5, 'tv', 'Sửa', NULL);
INSERT INTO `roles` VALUES (9, 'super', 'Full', NULL);

-- ----------------------------
-- Table structure for sohieuvukhi
-- ----------------------------
DROP TABLE IF EXISTS `sohieuvukhi`;
CREATE TABLE `sohieuvukhi`  (
  `sohieuvukhi_id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `thuclucvukhi_chitiet_id` int(10) UNSIGNED NOT NULL,
  `sohieuvukhi_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sohieuvukhi_nhakho` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `sohieuvukhi_gia` tinyint(2) UNSIGNED NULL DEFAULT NULL,
  `sohieuvukhi_tang` tinyint(2) UNSIGNED NULL DEFAULT NULL,
  `sohieuvukhi_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1: Mờ số hiệu; 0: không mờ số hiệu',
  `sohieuvukhi_active` tinyint(2) NOT NULL DEFAULT 1 COMMENT 'chưa dùng để làm gì',
  `hevukhi_id` tinyint(2) NOT NULL,
  `nhomvukhi_id` tinyint(2) NOT NULL,
  `covukhi_id` int(10) NOT NULL,
  `vukhi_id` int(10) NOT NULL,
  `nuocsanxuat_id` tinyint(2) NOT NULL,
  `donvitinh_id` tinyint(2) NOT NULL,
  `phancap_id` tinyint(2) NOT NULL,
  `soluong` int(10) NOT NULL DEFAULT 1,
  `donvi_id` int(10) NOT NULL,
  PRIMARY KEY (`sohieuvukhi_id`) USING BTREE,
  INDEX `thuclucvukhi_chitiet_id`(`thuclucvukhi_chitiet_id`) USING BTREE,
  CONSTRAINT `sohieuvukhi_ibfk_1` FOREIGN KEY (`sohieuvukhi_id`) REFERENCES `pxk_sohieu` (`pxk_sohieu_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for thuclucdongbo
-- ----------------------------
DROP TABLE IF EXISTS `thuclucdongbo`;
CREATE TABLE `thuclucdongbo`  (
  `thuclucdongbo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nhomvukhi_id` tinyint(2) UNSIGNED NOT NULL,
  `vukhi_id` int(10) UNSIGNED NOT NULL,
  `danhmucdongbo_id` int(10) UNSIGNED NOT NULL,
  `nuocsanxuat_id` tinyint(2) UNSIGNED NULL DEFAULT NULL,
  `donvitinh_id` tinyint(2) UNSIGNED NULL DEFAULT NULL,
  `phancap_id` tinyint(2) UNSIGNED NOT NULL,
  `soluong` int(10) UNSIGNED NOT NULL,
  `dinvi_id` int(10) UNSIGNED NOT NULL,
  `thuclucdongbo_active` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`thuclucdongbo_id`) USING BTREE,
  INDEX `danhmucdongbo_id`(`danhmucdongbo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for thuclucvukhi
-- ----------------------------
DROP TABLE IF EXISTS `thuclucvukhi`;
CREATE TABLE `thuclucvukhi`  (
  `thuclucvukhi_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hevukhi_id` tinyint(2) UNSIGNED NOT NULL,
  `nhomvukhi_id` tinyint(2) UNSIGNED NOT NULL,
  `covukhi_id` int(10) UNSIGNED NOT NULL,
  `vukhi_id` int(10) UNSIGNED NOT NULL,
  `nuocsanxuat_id` tinyint(2) UNSIGNED NOT NULL,
  `donvitinh_id` tinyint(2) UNSIGNED NOT NULL,
  `soluong` int(10) UNSIGNED NOT NULL,
  `cohom` int(10) NULL DEFAULT NULL,
  `trengia` int(10) NULL DEFAULT NULL,
  `kekich` int(10) NULL DEFAULT NULL,
  `Chiendau` int(10) NULL DEFAULT NULL COMMENT 'Sử dụng chiến đấu',
  `hlnt` int(10) NULL DEFAULT NULL COMMENT 'Sử dụng HL&NT',
  `Kho` int(10) NULL DEFAULT NULL COMMENT 'Cất giữ trong kho',
  `donvi_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`thuclucvukhi_id`) USING BTREE,
  INDEX `hevukhi_id`(`hevukhi_id`) USING BTREE,
  INDEX `nhomvukhi_id`(`nhomvukhi_id`) USING BTREE,
  INDEX `covukhi_id`(`covukhi_id`) USING BTREE,
  INDEX `donvi_id`(`donvi_id`) USING BTREE,
  INDEX `nuocsanxuat_id`(`nuocsanxuat_id`) USING BTREE,
  INDEX `donvitinh_id`(`donvitinh_id`) USING BTREE,
  INDEX `vukhi_id`(`vukhi_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for thuclucvukhi_chitiet
-- ----------------------------
DROP TABLE IF EXISTS `thuclucvukhi_chitiet`;
CREATE TABLE `thuclucvukhi_chitiet`  (
  `thuclucvukhi_chitiet_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `thuclucvukhi_id` int(10) UNSIGNED NOT NULL,
  `phancap_id` tinyint(2) UNSIGNED NOT NULL,
  `soluong` int(10) NOT NULL DEFAULT 0,
  `hevukhi_id` tinyint(2) NOT NULL,
  `nhomvukhi_id` tinyint(2) NOT NULL,
  `covukhi_id` int(10) NOT NULL,
  `vukhi_id` int(10) NOT NULL,
  `nuocsanxuat_id` tinyint(2) NULL DEFAULT NULL,
  `donvitinh_id` tinyint(2) NULL DEFAULT NULL,
  `cohom` int(10) NULL DEFAULT NULL,
  `trengia` int(10) NULL DEFAULT NULL,
  `kekich` int(10) NULL DEFAULT NULL,
  `chiendau` int(10) NULL DEFAULT NULL,
  `hluyen_ntruong` int(10) NULL DEFAULT NULL,
  `trongkho` int(10) NULL DEFAULT NULL,
  `donvi_id` int(10) NOT NULL,
  PRIMARY KEY (`thuclucvukhi_chitiet_id`) USING BTREE,
  INDEX `thuclucvukhi_id`(`thuclucvukhi_id`) USING BTREE,
  INDEX `phancap_id`(`phancap_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `role` int(11) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `Unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', '$2y$10$xSugoyKv765TY8DsERJ2/.mPIOwLNdM5Iw1n3x1XNVymBlHNG4cX6', NULL, 9, 1);

-- ----------------------------
-- Table structure for vukhi
-- ----------------------------
DROP TABLE IF EXISTS `vukhi`;
CREATE TABLE `vukhi`  (
  `covukhi_id` int(10) UNSIGNED NOT NULL,
  `vukhi_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vukhi_code` int(10) NULL DEFAULT NULL,
  `vukhi_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vukhi_kyhieu` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `vukhi_trongluong` float NULL DEFAULT 0,
  `vukhi_dai` float NULL DEFAULT NULL,
  `vukhi_rong` float NULL DEFAULT NULL,
  `vukhi_cao` float NULL DEFAULT NULL,
  `vukhi_active` tinyint(2) NULL DEFAULT 1,
  PRIMARY KEY (`vukhi_id`) USING BTREE,
  INDEX `covukhi_id`(`covukhi_id`) USING BTREE,
  CONSTRAINT `vukhi_ibfk_1` FOREIGN KEY (`covukhi_id`) REFERENCES `covukhi` (`covukhi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
