/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100425 (10.4.25-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : u2774448_malingpingselatan

 Target Server Type    : MySQL
 Target Server Version : 100425 (10.4.25-MariaDB)
 File Encoding         : 65001

 Date: 20/04/2023 21:12:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sk_izin_tebang_item
-- ----------------------------
DROP TABLE IF EXISTS `sk_izin_tebang_item`;
CREATE TABLE `sk_izin_tebang_item`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sk_izin_tebang_id` bigint UNSIGNED NOT NULL,
  `jenis_kayu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah_batang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hasil_klem` decimal(10, 2) NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sk_izin_tebang_item
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
