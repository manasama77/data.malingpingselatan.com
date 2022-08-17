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

 Date: 18/08/2022 02:56:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sk_hilang
-- ----------------------------
DROP TABLE IF EXISTS `sk_hilang`;
CREATE TABLE `sk_hilang`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `warga_id` bigint UNSIGNED NULL DEFAULT NULL,
  `keterangan_kehilangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tanggal_pelaporan` date NULL DEFAULT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_kepala_desa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nrp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sk_hilang
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
