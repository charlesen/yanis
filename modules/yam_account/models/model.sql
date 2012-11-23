CREATE TABLE IF NOT EXISTS socialac_yac_users(id INT(12) NOT NULL auto_increment,
username VARCHAR(100) NOT NULL, password VARCHAR(250) NOT NULL,
email VARCHAR(70) NOT NULL, usertype VARCHAR(12), active TINYINT(1) default '0',
banned TINYINT(1),registerDate CURRENT_TIMESTAMP, lastVisitDate CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS socialac_yam_account(id INT(12), user_id INT,
PRIMARY KEY(id), INDEX(user_id),FOREIGN KEY (user_id) REFERENCES socialac_yac_users(id) 
ON UPDATE CASCADE ON DELETE CASCADE
);