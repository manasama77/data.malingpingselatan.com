/*
 Navicat Premium Data Transfer

 Source Server         : MySql Local
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : u2774448_malingpingselatan

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 16/09/2022 01:49:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sk_penghasilan_orangtua
-- ----------------------------
DROP TABLE IF EXISTS `sk_penghasilan_orangtua`;
CREATE TABLE `sk_penghasilan_orangtua`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `orangtua_id` bigint UNSIGNED NULL DEFAULT NULL,
  `anak_id` bigint UNSIGNED NULL DEFAULT NULL,
  `penghasilan_orangtua` int NULL DEFAULT NULL,
  `keperluan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_pelaporan` date NULL DEFAULT NULL,
  `nama_kepala_desa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nrp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sk_penghasilan_orangtua
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
