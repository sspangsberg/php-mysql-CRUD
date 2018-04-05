DROP DATABASE IF EXISTS ReviewDB;
CREATE DATABASE ReviewDB;
USE ReviewDB;

--
CREATE TABLE Review
(
  ReviewID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  FullName varchar(200),
  Contents varchar(30000)
);


INSERT INTO Review (FullName, Contents) VALUES ('Reviewer','Very niiice pizzzaaaaa mucho good!');
INSERT INTO Review (FullName, Contents) VALUES ('Restro','Good food');


-- Create user and grant access to this specific database
DROP USER 'dbuser'@'localhost';
CREATE USER 'dbuser'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON ReviewDB.* To 'dbuser'@'localhost' IDENTIFIED BY '1234'; FLUSH PRIVILEGES;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_all_reviews`()
  BEGIN
    SELECT * From review;
  END$$
DELIMITER ;


DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_create_review`(
  IN input_fullName VARCHAR(200), IN input_contents VARCHAR(30000))
  
  BEGIN
    INSERT INTO Review (FullName, Contents) VALUES (input_fullName, input_contents);
  END$$

DELIMITER ;




