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

 Date: 13/06/2022 09:08:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for surat_sequences
-- ----------------------------
DROP TABLE IF EXISTS `surat_sequences`;
CREATE TABLE `surat_sequences`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `sequence` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of surat_sequences
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
