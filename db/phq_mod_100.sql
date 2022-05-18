-- --------------------------------------------------------

--
-- Table structure for table `phq_mod_100`
--

CREATE TABLE IF NOT EXISTS phq_mod_100 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    en_id INT NOT NULL,
    region VARCHAR(50) NOT NULL,
    zone VARCHAR(50) NOT NULL,
    district VARCHAR(50) NOT NULL,
    kebele VARCHAR(50) NOT NULL,
    in_psnp TINYINT(1) NOT NULL,
    agreed BOOLEAN NOT NULL,
    name_q0 VARCHAR(255) NOT NULL,
    m1_q1 BOOLEAN NOT NULL,
    m1_q2 TINYINT(2) NOT NULL,
    m1_q3 VARCHAR(100) DEFAULT NULL,
    m1_q4 VARCHAR(255) NOT NULL,
    m1_q5 BOOLEAN NOT NULL,
    m1_q6 TINYINT(3) UNSIGNED NOT NULL,
    m1_q7 TINYINT(1) NOT NULL,
    m1_q8 TINYINT(2) NOT NULL,
    m1_q9 TINYINT(2) NOT NULL,
    m1_q10 TINYINT(1) NOT NULL,
    m1_q11 TINYINT(1) NOT NULL,
    m1_q12_a1 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_a2 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_b1 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_b2 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_c1 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_c2 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_d1 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_d2 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_e1 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_e2 TINYINT(1) NOT NULL DEFAULT 0,
    m1_q12_tot TINYINT(1) NOT NULL,
    m1_q13 TINYINT(2) NOT NULL,
    m1_q14 TINYINT(2) NOT NULL,
    m1_q15 TINYINT(2) NOT NULL,
    m1_q16 TINYINT(1) NOT NULL,
    m1_q17 VARCHAR(100) NOT NULL,
    m1_q18 VARCHAR(255) DEFAULT NULL,
    m1_q19 DECIMAL NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_enumerator
    FOREIGN KEY (en_id)
    REFERENCES phq_enumerators(en_id)
        ON UPDATE RESTRICT ON DELETE CASCADE
) ENGINE=INNODB;

-- --------------------------------------------------------
ALTER TABLE `phq_mod_100` ADD `m1_q12_a0` TINYINT(2) NOT NULL AFTER `m1_q11`;
ALTER TABLE `phq_mod_100` ADD `m1_q12_b0` TINYINT(2) NOT NULL AFTER `m1_q12_a2`;
ALTER TABLE `phq_mod_100` ADD `m1_q12_c0` TINYINT(2) NOT NULL AFTER `m1_q12_b2`;
ALTER TABLE `phq_mod_100` ADD `m1_q12_d0` TINYINT(2) NOT NULL AFTER `m1_q12_c2`;
ALTER TABLE `phq_mod_100` ADD `m1_q12_e0` TINYINT(2) NOT NULL AFTER `m1_q12_d2`;