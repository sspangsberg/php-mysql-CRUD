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


INSERT INTO Review (FullName, Contents) VALUES ('Søren Spangsberg Jørgensen','Very niiice pizzzaaaaa mucho good!');
INSERT INTO Review (FullName, Contents) VALUES ('Taco Bell','Good food');


-- Create user and grant access to this specific database
DROP USER 'dbuser'@'localhost';
CREATE USER 'dbuser'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON ReviewDB.* To 'dbuser'@'localhost' IDENTIFIED BY '1234'; FLUSH PRIVILEGES;

