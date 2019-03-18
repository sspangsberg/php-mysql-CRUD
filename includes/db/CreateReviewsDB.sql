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


