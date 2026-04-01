CREATE DATABASE IF NOT EXISTS `cek_etika_db`;
USE `cek_etika_db`;

CREATE TABLE IF NOT EXISTS `hasil_cek` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `teks_tugas` TEXT NOT NULL,
    `q1` VARCHAR(10) NOT NULL,
    `q2` VARCHAR(10) NOT NULL,
    `q3` VARCHAR(10) NOT NULL,
    `q4` VARCHAR(10) NOT NULL,
    `status` VARCHAR(20) NOT NULL,
    `pesan` TEXT NOT NULL,
    `teks_parafrase` TEXT DEFAULT NULL,
    `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
