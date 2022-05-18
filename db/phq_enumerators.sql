-- --------------------------------------------------------

--
-- Table structure for table `phq_enumerators`
--

CREATE TABLE IF NOT EXISTS phq_enumerators (
    en_id INT AUTO_INCREMENT PRIMARY KEY,
    tl_id INT NOT NULL,
    fullname VARCHAR(255) NOT NULL,
    sex TINYINT NOT NULL,
    phonenum VARCHAR(14) NOT NULL,
    username VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    password VARCHAR(12) NOT NULL,
    status TINYINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_team_leader
    FOREIGN KEY (tl_id)
    REFERENCES phq_team_leaders(tl_id)
        ON UPDATE RESTRICT ON DELETE CASCADE
) ENGINE=INNODB;
