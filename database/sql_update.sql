-- phongct: 28/08/2016

ALTER TABLE `phieunhapkho`
CHANGE COLUMN `donvi_id` `donvinhap_id`  int(10) UNSIGNED NOT NULL AFTER `lydonhapkho_id`,
ADD COLUMN `donvixuat_id`  int(10) NOT NULL AFTER `lydonhapkho_id`;


ALTER TABLE `pnk_chitiet`
ADD COLUMN `thuclucvukhi_chitiet_id`  int(11) NOT NULL DEFAULT 0 AFTER `phancap_id`;

ALTER TABLE `phieuxuatkho`
CHANGE COLUMN `donvinhap_id` `donvinhap_name`  varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'nhập tay' AFTER `donvixuat_id`;

-- Số tồn có thể âm
ALTER TABLE `thuclucvukhi`
MODIFY COLUMN `soluong`  int(10) NOT NULL AFTER `donvitinh_id`;

-- 
CREATE TABLE `sophieu` (
  `sophieu_key` int(11) NOT NULL DEFAULT '0' COMMENT 'year + 1: phieu nhap | year + 2: phieu xuat',
  `sophieu_year` year(4) NOT NULL,
  `sophieu_stt` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`sophieu_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

