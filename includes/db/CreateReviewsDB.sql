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

-- Insert test data
INSERT INTO Review (FullName, Contents) VALUES ('Derwin Dymond','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus ipsum at sagittis varius. Nullam non velit elit. Quisque finibus tortor mattis sapien condimentum feugiat. Sed placerat felis ullamcorper lectus porttitor, a hendrerit odio lacinia. Morbi et turpis enim. Proin ac viverra tortor. Sed vulputate bibendum arcu, et sodales libero pretium id. Nullam rhoncus magna a lacus tempus finibus. Proin vel risus quis sapien posuere eleifend consequat vitae lacus. Nam interdum egestas sapien a tempor.

');
INSERT INTO Review (FullName, Contents) VALUES ('Sigfried Faircliffe','Nulla non porttitor ex. Phasellus venenatis dui vel magna bibendum feugiat. Sed sit amet arcu sit amet ex consectetur congue a nec enim. Sed cursus ligula ante. In in augue augue. Curabitur at orci a turpis dignissim ornare id quis purus. Sed sodales ipsum eget scelerisque pretium. Aliquam nec iaculis nulla. Etiam rutrum enim at lectus maximus porttitor. Aenean mattis scelerisque mattis. Mauris posuere sem euismod enim rhoncus, vitae consectetur mauris porttitor.');

INSERT INTO Review (FullName, Contents) VALUES ('Eloise Tallach','Vivamus pulvinar posuere eleifend. Aenean et gravida nulla. Fusce tempor mi ac mi porta pharetra. Donec sed felis sed eros lobortis scelerisque sit amet sed metus. Sed accumsan dignissim dui, eget finibus risus. Nullam laoreet sem id leo varius sodales. Donec porta massa massa, sit amet dignissim diam scelerisque convallis. Aliquam erat volutpat. Suspendisse ultrices imperdiet magna. Etiam vehicula sed felis maximus maximus.');


-- Create user and grant access to this specific database 
DROP USER IF EXISTS 'dbuser'@'localhost';
CREATE USER 'dbuser'@'localhost' IDENTIFIED BY '1234'; 
GRANT SELECT, INSERT, UPDATE, DELETE ON ReviewDB.* To 'dbuser'@'localhost' IDENTIFIED BY '1234'; FLUSH PRIVILEGES;



