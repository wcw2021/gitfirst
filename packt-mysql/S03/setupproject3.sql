CREATE TABLE Friends (FriendID INT NOT NULL AUTO_INCREMENT
                     ,FNAME varchar(50) DEFAULT NULL
                     ,LNAME varchar(50) DEFAULT NULL
                     ,dob date DEFAULT NULL 
                     ,PRIMARY KEY (FriendID));   

INSERT INTO Friends (FNAME, LNAME,dob)
VALUES ('Mashrur', 'Hossain','1982-12-01')
      ,('Matt', 'Berstein','1980-08-05')
      ,('Anastasia', 'Ivanov','1989-04-01')
      ,('Mark', 'Futre','1989-07-04');

SELECT *
FROM Friends;