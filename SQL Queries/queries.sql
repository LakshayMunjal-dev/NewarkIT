-- Queries for Table Creation:
Create table CUSTOMER (
CID INT (10) PRIMARY KEY AUTO_INCREMENT,
FName VARCHAR (30) NOT NULL,
LName VARCHAR (30) NOT NULL,
Email VARCHAR (30),
Address VARCHAR (50),
Phone INT (10),
Status VARCHAR (10));

Create table PRODUCT (
PID INT (10) PRIMARY KEY AUTO_INCREMENT,
PType VARCHAR (10) NOT NULL,
PName VARCHAR (30) NOT NULL,
PPrice INT (5),
Description VARCHAR (50),
PQuantity INT (5));

Create table CREDIT_CARD (
CCNumber VARCHAR (16) PRIMARY KEY,
SecNumber INT (3) NOT NULL,
OwnerName VARCHAR (20) NOT NULL,
CCType VARCHAR(10) NOT NULL,
CCAddress VARCHAR(50) NOT NULL,
ExpDate Date NOT NULL,
StoredCardCID INT(10),
FOREIGN KEY (StoredCardCID) REFERENCES CUSTOMER(CID));


Create table SILVER_AND_ABOVE (
CID INT(10) NOT NULL,
CreditLine DECIMAL NOT NULL,
PRIMARY KEY(CID),
FOREIGN KEY (CID) REFERENCES CUSTOMER(CID));


Create table SHIPPING_ADDRESS (
CID INT(10) NOT NULL,
SAName VARCHAR(20) NOT NULL,
RecepientName VARCHAR(20) NOT NULL,
Street VARCHAR(20) NOT NULL,
SNumber INT(5) NOT NULL,
City VARCHAR(20) NOT NULL,
Zip VARCHAR(5) NOT NULL,
State VARCHAR(20) NOT NULL,
Country VARCHAR(20) NOT NULL,
PRIMARY KEY(CID, SAName),
FOREIGN KEY (CID) REFERENCES CUSTOMER(CID));


Create table TRANSACTION (
BID INT(10) NOT NULL,
CID INT(10) NOT NULL,
SAName VARCHAR(20),
CCNumber VARCHAR (16),
TTag VARCHAR(15),
TDate Date,
PRIMARY KEY (BID,CCNumber,CID,SAName),
FOREIGN KEY (CCNumber) REFERENCES CREDIT_CARD(CCNumber),
FOREIGN KEY (BID) REFERENCES BASKET(BID),
FOREIGN KEY (CID,SAName) REFERENCES SHIPPING_ADDRESS(CID,SAName));


Create table OFFER_PRODUCT (
PID INT (10) PRIMARY KEY,
OfferPrice DECIMAL NOT NULL,
FOREIGN KEY (PID) REFERENCES PRODUCT(PID));


Create table APPEARS_IN (
BID INT(10) NOT NULL,
PID INT(10) NOT NULL,
Quantity INT(5) NOT NULL,
PriceSold DECIMAL NOT NULL,
PRIMARY KEY(PID, BID),
FOREIGN KEY (PID) REFERENCES PRODUCT(PID),
FOREIGN KEY (BID) REFERENCES BASKET(BID));


Create table COMPUTER (
PID INT (10) PRIMARY KEY,
CPUType VARCHAR(20) NOT NULL,
FOREIGN KEY (PID) REFERENCES PRODUCT(PID));

Create table LAPTOP (
PID INT (10) PRIMARY KEY,
BType VARCHAR(20) NOT NULL,
Weight DECIMAL NOT NULL,
FOREIGN KEY (PID) REFERENCES COMPUTER(PID));

Create table PRINTER (
PID INT (10) PRIMARY KEY,
PrinterType VARCHAR(20) NOT NULL,
Resolution VARCHAR(20) NOT NULL,
FOREIGN KEY (PID) REFERENCES PRODUCT(PID));

CREATE TABLE BASKET (
BID INT(10) NOT NULL AUTO_INCREMENT,
CID INT(10) NOT NULL,
PRIMARY KEY (BID),
FOREIGN KEY (CID) REFERENCES CUSTOMER(CID));


-- Queries for Table Population:
INSERT INTO `CUSTOMER` (`CID`, `FName`, `LName`, `Email`, `Address`, `Phone`, `Status`) VALUES ('1', 'Mohammad', 'Agha', 'ma@njit.edu', 'Clifton, NJ', '1111111111', 'Platinum');
INSERT INTO `CUSTOMER` (`CID`, `FName`, `LName`, `Email`, `Address`, `Phone`, `Status`) VALUES ('2', 'Lakshay', 'Munjal', 'lm@njit.edu', 'Portland, OR', '1111111110', 'Gold');
INSERT INTO `CUSTOMER` (`CID`, `FName`, `LName`, `Email`, `Address`, `Phone`, `Status`) VALUES ('3', 'Lalit', 'Rupani', 'lr@njit.edu', 'Miami, FL', '1111111112', 'Silver');
INSERT INTO `CUSTOMER` (`CID`, `FName`, `LName`, `Email`, `Address`, `Phone`, `Status`) VALUES ('4', 'Jane', 'Doe', 'jd@njit.edu', 'Newark, NJ', '1111111113', 'Regular');


INSERT INTO `SILVER_AND_ABOVE` (`CID`, `CreditLine`) VALUES ('1', '25'), ('2', '15'), ('3', '5');


INSERT INTO `CREDIT_CARD` (`CCNumber`, `SecNumber`, `OwnerName`, `CCType`, `CCAddress`, `ExpDate`, `StoredCardCID`) VALUES ('1234123412341234', '123', 'Mohammad Agha', 'Visa', 'Paterson, NJ', '2018-07-12', '1');
INSERT INTO `CREDIT_CARD` (`CCNumber`, `SecNumber`, `OwnerName`, `CCType`, `CCAddress`, `ExpDate`, `StoredCardCID`) VALUES ('1111111111111111', '111', 'Lakshay Munjal', 'Master', 'Portland, OR', '2019-09-12', '2');
INSERT INTO `CREDIT_CARD` (`CCNumber`, `SecNumber`, `OwnerName`, `CCType`, `CCAddress`, `ExpDate`, `StoredCardCID`) VALUES ('2222222222222222', '222', 'Lalit Rupani', 'AMEX', 'Miami FL', '2019-02-11', '3');
INSERT INTO `CREDIT_CARD` (`CCNumber`, `SecNumber`, `OwnerName`, `CCType`, `CCAddress`, `ExpDate`, `StoredCardCID`) VALUES ('3333333333333333', '333', 'Jane Doe', 'Discover', 'Seattle, WA', '2018-03-10', '4');


INSERT INTO `SHIPPING_ADDRESS` (`CID`, `SAName`, `RecepientName`, `Street`, `SNumber`, `City`, `Zip`, `State`, `Country`) VALUES ('1', 'Home', 'Mohammad', 'Main Ave', '1500', 'Clifton', '07011', 'NJ', 'USA');
INSERT INTO `SHIPPING_ADDRESS` (`CID`, `SAName`, `RecepientName`, `Street`, `SNumber`, `City`, `Zip`, `State`, `Country`) VALUES ('2', 'Apartment', 'Lakshay', 'Mattson St', '2345', 'Portland', '97205', 'OR', 'USA');
INSERT INTO `SHIPPING_ADDRESS` (`CID`, `SAName`, `RecepientName`, `Street`, `SNumber`, `City`, `Zip`, `State`, `Country`) VALUES ('3', 'Apartment', 'Lalit', 'Golden St', '4293', 'Miami', '33135', 'FL', 'USA');
INSERT INTO `SHIPPING_ADDRESS` (`CID`, `SAName`, `RecepientName`, `Street`, `SNumber`, `City`, `Zip`, `State`, `Country`) VALUES ('4', 'Home', 'Jane', 'Univeristy St', '2875', 'Seattle', '98133', 'WA', 'USA');


INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('1', 'Computer', 'Intel core i5', '800', 'Intel i5 computer 12th generation', '10');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('2', 'Computer', 'Dell i5', '750', 'Dell computer i5', '5');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('3', 'Computer', 'Pentium 4', '350', 'Pentium 4 Intel Inside', '10');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('4', 'Computer', 'Pentium 2', '150', 'IBM 2nd Gen', '5');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('5', 'Laptop', 'MacBook', '1200', 'MacBook Apple', '10');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('6', 'Laptop', 'Dell Inspiron', '500', 'Dell Laptop', '15');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('7', 'Laptop', 'HP Pro Book', '1500', 'HP 2018 Probook 5GHz', '10');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('8', 'Laptop', 'Sony SmartBook', '700', 'Sony SmartBook i5 3rd Gen', '5');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('10', 'Printer', 'Intel Smart Printer', '500', 'Smart Printer 20 colors', '5');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('11', 'Printer', 'IBM LaserJet', '300', 'LaserJet Technology IBM 60 Pager per minute', '10');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('12', 'Printer', 'Synthetic Printer', '600', 'Synthetic Printer with New Technology', '10');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('13', 'Printer', '3D Printer', '1800', '3D Printing with 100 different colors', '20');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('14', 'Printer', 'BWPrinter', '150', 'Black and White Printer with Ink', '15');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('15', 'Accessory', 'Charger', '100', 'Laptop Charger', '10');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('16', 'Accessory', 'Laptop Bag', '50', 'Laptop Bag REd Color', '5');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('17', 'Accessory', 'Screen Protector', '70', 'Screen protector for laptop and computer screens', '10');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('18', 'Accessory', 'RAM', '200', '512 GB RAM', '20');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('19', 'Accessory', 'Mouse', '75', 'Gaming Mouse', '15');
INSERT INTO `PRODUCT` (`PID`, `PType`, `PName`, `PPrice`, `Description`, `PQuantity`) VALUES ('20', 'Accessory', 'Keyboard', '100', 'Gaming Keyboard', '10');


INSERT INTO `COMPUTER` (`PID`, `CPUType`) VALUES ('1', 'i5');
INSERT INTO `COMPUTER` (`PID`, `CPUType`) VALUES ('2', 'i5');
INSERT INTO `COMPUTER` (`PID`, `CPUType`) VALUES ('3', 'p4');
INSERT INTO `COMPUTER` (`PID`, `CPUType`) VALUES ('4', 'p2');

INSERT INTO `LAPTOP` (`PID`, `BType`, `Weight`) VALUES ('1', '180', '2.0');
INSERT INTO `LAPTOP` (`PID`, `BType`, `Weight`) VALUES ('2', '140', '2.5');
INSERT INTO `LAPTOP` (`PID`, `BType`, `Weight`) VALUES ('3', '200', '3.0');
INSERT INTO `LAPTOP` (`PID`, `BType`, `Weight`) VALUES ('4', '100', '1.0');

INSERT INTO `PRINTER` (`PID`, `PrinterType`, `Resolution`) VALUES ('10', 'Inkjet', '1024x2048');
INSERT INTO `PRINTER` (`PID`, `PrinterType`, `Resolution`) VALUES ('11', 'LaserJet', '1024x1024');
INSERT INTO `PRINTER` (`PID`, `PrinterType`, `Resolution`) VALUES ('12', 'Plotter', '720x720');
INSERT INTO `PRINTER` (`PID`, `PrinterType`, `Resolution`) VALUES ('13', '3D', '2048x2048');
INSERT INTO `PRINTER` (`PID`, `PrinterType`, `Resolution`) VALUES ('14', 'Thermal', '1024x720');


INSERT INTO `offer_product` (`PID`, `OfferPrice`) VALUES ('3', '300');
INSERT INTO `offer_product` (`PID`, `OfferPrice`) VALUES ('4', '100');
INSERT INTO `offer_product` (`PID`, `OfferPrice`) VALUES ('5', '975');
INSERT INTO `offer_product` (`PID`, `OfferPrice`) VALUES ('6', '1150');
INSERT INTO `offer_product` (`PID`, `OfferPrice`) VALUES ('7', '425');

INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('1', '3', '1', '300');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('1', '19', '1', '75');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('1', '20', '1', '100');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('1', '18', '1', '200');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('1', '19', '1', '75');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('2', '5', '1', '975');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('2', '16', '1', '5');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('2', '19', '1', '75');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('3', '10', '1', '500');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('4', '15', '1', '10');
INSERT INTO `APPEARS_IN` (`BID`, `PID`, `Quantity`, `PriceSold`) VALUES ('4', '17', '1', '10');

INSERT INTO `BASKET` (`BID`, `CID`) VALUES ('1', '1');
INSERT INTO `BASKET` (`BID`, `CID`) VALUES ('2', '2');
INSERT INTO `BASKET` (`BID`, `CID`) VALUES ('3', '3');
INSERT INTO `BASKET` (`BID`, `CID`) VALUES ('4', '4');

INSERT INTO `TRANSACTION` (`BID`, `CCNumber`, `CID`, `SAName`, `TDATE`, `TTag`) VALUES ('1', '1234123412341234', '1', 'Home', '2018-07-10', 'D');
INSERT INTO `TRANSACTION` (`BID`, `CCNumber`, `CID`, `SAName`, `TDATE`, `TTag`) VALUES ('2', '1111111111111111', '2', 'Apartment', '2018-12-25', 'D');
INSERT INTO `TRANSACTION` (`BID`, `CCNumber`, `CID`, `SAName`, `TDATE`, `TTag`) VALUES ('3', '2222222222222222', '3', 'Apartment', '2019-01-05', 'D');
INSERT INTO `TRANSACTION` (`BID`, `CCNumber`, `CID`, `SAName`, `TDATE`, `TTag`) VALUES ('4', '3333333333333333', '4', 'Home', '2017-04-01', 'C');


-- Queries for Sale Statistics:
-- 1
select T.CCNumber, SUM(A.Quantity * A.PriceSold) As Total 
from appears_in A, transaction T, customer C 
WHERE C.CID = T.CID and T.BID = A.BID and A.BID IN 
    (select T1.BID from transaction T1, customer C1 where T1.CID = C1.CID and T1.TTag is NOT NULL) 
GROUP BY T.CID 
ORDER BY Total DESC

-- 2
select C.CID, C.FName, C.LName, SUM(A.Quantity * A.PriceSold) As Total 
from appears_in A, transaction T, customer C 
WHERE C.CID = T.CID and T.BID = A.BID and A.BID IN 
    (select T1.BID from transaction T1, customer C1 where T1.CID = C1.CID and T1.TTag is NOT NULL) 
GROUP BY T.CID 
ORDER BY Total DESC
LIMIT 10;

-- 3
SELECT A.PID, P.PName, SUM(A.Quantity) AS TotalQuantity from APPEARS_IN A, PRODUCT P 
where P.PID = A.PID and A.BID IN 
	(SELECT BID FROM TRANSACTION T WHERE T.TTag is NOT NULL and T.TDate BETWEEN CAST('2017-01-01' AS DATE) AND CAST('2020-01-01' AS DATE))
GROUP BY A.PID 
ORDER BY TotalQuantity DESC

-- 4
SELECT A.PID, P.PName, COUNT(DISTINCT T.CID) AS CustomerCount
FROM APPEARS_IN A
JOIN TRANSACTION T ON A.BID = T.BID
JOIN PRODUCT P ON A.PID = P.PID
WHERE T.TDate BETWEEN '2017-01-01' AND '2020-01-01'
GROUP BY A.PID, P.PName
ORDER BY CustomerCount DESC
LIMIT 1;

-- 5
select T.CCNumber, MAX(A.Quantity * A.PriceSold) As Total 
from appears_in A, transaction T, customer C 
WHERE C.CID = T.CID and T.BID = A.BID and A.BID IN 
    (select T1.BID from transaction T1, customer C1 where T1.CID = C1.CID and T1.TTag is NOT NULL) 
GROUP BY T.CID 
ORDER BY Total DESC

-- 6
SELECT P.PType, SUM(A.PriceSold * A.Quantity)/SUM(A.Quantity) As AveragePriceByType 
from appears_in A, product P, transaction T 
where A.PID = P.PID and T.BID = A.BID and T.TDate BETWEEN CAST('2017-01-01' AS DATE) AND CAST('2020-01-01' AS DATE) and P.PType NOT IN('A') 
GROUP BY P.PType 
ORDER BY AveragePriceByType DESC;
