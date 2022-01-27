CREATE DATABASE E_SHOPPER;
USE E_SHOPPER;

#################MANUCATURER##########################

CREATE TABLE MANUFCATURER (
ManID INT NOT NULL AUTO_INCREMENT, 
ManName VARCHAR(150) NOT NULL,  
ManLocation VARCHAR(200),
ManLandline VARCHAR(11),  
ManContactPerson VARCHAR(50) NOT NULL,    
ManContactPersonPhone VARCHAR(11) NOT NULL,  
CONSTRAINT Man_PK PRIMARY KEY (ManID)
);

#################CATEGORIES##########################
CREATE TABLE CATEGORIES(
CatID INT NOT NULL AUTO_INCREMENT,
CatName VARCHAR (150) NOT NULL,
CatDescription VARCHAR (200),
CONSTRAINT CATEGORIES_PK PRIMARY KEY (CatID)
);

#################SUB_CATEGORIES##########################

CREATE TABLE SUB_CATEGORIES(
SubCatID INT NOT NULL AUTO_INCREMENT,
SubCatName VARCHAR (150) NOT NULL,
SubCatDescription VARCHAR (200),
CatID INT NOT NULL,
CONSTRAINT SUB_CATEGORIES_PK PRIMARY KEY (SubCatID),
CONSTRAINT SUB_CATEGORIES_FK FOREIGN KEY (CatID) REFERENCES CATEGORIES(CatID) ON UPDATE CASCADE ON DELETE CASCADE
);

#################SUBCAT_MAN##########################

CREATE TABLE SUBCAT_MAN (
SubCatID INT NOT NULL,
ManID INT NOT NULL,
SubCatDiscount dOUBLE,
CONSTRAINT SUBCAT_MAN_PK PRIMARY KEY (SubCatID,ManID),
CONSTRAINT SUBCAT_MAN_FK1 FOREIGN KEY (SubCatID) REFERENCES SUB_CATEGORIES (SubCatID)  ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT SUBCAT_MAN_FK2 FOREIGN KEY (ManID) REFERENCES MANUFCATURER (ManID)  ON UPDATE CASCADE ON DELETE CASCADE
);

#################PRODUCT##########################
CREATE TABLE PRODUCT (
ProdID INT NOT NULL AUTO_INCREMENT, 
ProdName VARCHAR(100) NOT NULL, 
SubCatID INT NOT NULL,
ProdImageLink VARCHAR(150) NOT NULL,  
ManID INT NOT NULL, 
ProdTechnicalSpecs VARCHAR(200),  
ProdPrice Double NOT NULL, 
ProdQuantityAvalilableNew INT NOT NULL,
ProdQuantityAvalilableRef INT NOT NULL,  
ProdDiscount Double NULL, 
CONSTRAINT Prod_PK PRIMARY KEY (ProdID),
CONSTRAINT Prod_FK1 FOREIGN KEY (SubCatID) REFERENCES SUB_CATEGORIES (SubCatID)  ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT Prod_FK2 FOREIGN KEY (ManID) REFERENCES MANUFCATURER (ManID)  ON UPDATE CASCADE ON DELETE CASCADE
);

#################INVOICE##########################

CREATE TABLE INVOICE (
InvNumber INT NOT NULL AUTO_INCREMENT, 
InvDate Date NOT NULL,  
InvTime time NOT NULL, 
InvTotal INT NOT NULL,
InvComments VARCHAR(200) NULL,
InvExpShipingTime VARCHAR(50) NOT NULL,  
InvStatus VARCHAR(50) NOT NULL CHECK (InvStatus IN ('Processing', 'Shipped','Canceled')),
InvPaymentMethod VARCHAR(50) NOT NULL,
CONSTRAINT Inv_PK PRIMARY KEY (InvNumber)
);

#################PROD_INV##########################

CREATE TABLE PROD_INV (
ProdID INT NOT NULL , 
InvNumber INT NOT NULL , 
PIQuntity INT NOT NULL,
PIStatus VARCHAR(50) NOT NULL CHECK (PIStatus IN ('New', 'Refurbished')),
CONSTRAINT PRODINV_PK PRIMARY KEY (ProdID,InvNumber),
CONSTRAINT PRODINV_FK1 FOREIGN KEY (ProdID) REFERENCES PRODUCT (ProdID)  ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT PRODINV_FK2 FOREIGN KEY (InvNumber) REFERENCES INVOICE (InvNumber)  ON UPDATE CASCADE ON DELETE CASCADE
);

#################CUSTOMER##########################

CREATE TABLE CUSTOMER(
CusID INT NOT NULL AUTO_INCREMENT,
CusFirstName VARCHAR(20) NOT NULL,
CusLastName VARCHAR(20) NOT NULL,
CusEmailAddress VARCHAR(50) NOT NULL,
CusEncryptedPass VARCHAR(50) NOT NULL,
Admin BOOLEAN NOT NULL,
CusDiscountCode VARCHAR (50) NULL,
CusBalance DOUBLE NULL,
CusShippingAddress VARCHAR(100) NULL,
CONSTRAINT CUSTOMER_PK PRIMARY KEY (CusID)
);

#################CUS_INV##########################

CREATE TABLE CUS_INV (
CusID INT NOT NULL , 
InvNumber INT NOT NULL,
CONSTRAINT CUSINV_PK PRIMARY KEY (CusID,InvNumber),
CONSTRAINT CUSINV_FK1 FOREIGN KEY (CusID) REFERENCES CUSTOMER (CusID)  ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT CUSINV_FK2 FOREIGN KEY (InvNumber) REFERENCES INVOICE (InvNumber)  ON UPDATE CASCADE ON DELETE CASCADE
);

#################CARDS##########################

CREATE TABLE CARDS(
CardNumber VARCHAR(12) NOT NULL,
CardHolder VARCHAR(20) NOT NULL,
CardCVV VARCHAR (3) NOT NULL,
CardBank VARCHAR (50) NOT NULL,
CusID INT NOT NULL,
CONSTRAINT CARDS_PK PRIMARY KEY (CardNumber),
CONSTRAINT CUSTOMER_FK FOREIGN KEY (CusID) REFERENCES CUSTOMER (CusID) ON UPDATE CASCADE ON DELETE CASCADE
);

#################FAVOURITS##########################

CREATE TABLE FAVOURITS(
CusID INT NOT NULL,
ProdID INT NOT NULL,
CONSTRAINT FAVOURITS_PK PRIMARY KEY (CusID,ProdID),
CONSTRAINT FAVOURITS_FK1 FOREIGN KEY (ProdID) REFERENCES PRODUCT(ProdID) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT FAVOURITS_FK2 FOREIGN KEY (CusID) REFERENCES CUSTOMER(CusID) ON UPDATE CASCADE ON DELETE CASCADE
);

#################CART##########################

CREATE TABLE CART(
CusID INT NOT NULL,
ProdID INT NOT NULL,
Quantity INT NOT NULL,
CONSTRAINT CART_PK PRIMARY KEY (CusID,ProdID),
CONSTRAINT CART_FK1 FOREIGN KEY (ProdID) REFERENCES PRODUCT(ProdID) ,
CONSTRAINT CART_FK2 FOREIGN KEY (CusID) REFERENCES CUSTOMER(CusID) ON UPDATE CASCADE ON DELETE CASCADE
);

#################CALL_CENTER_REP##########################

CREATE TABLE CALL_CENTER_REP(
CCRepID INT NOT NULL AUTO_INCREMENT,
CCRepFName VARCHAR(20) NOT NULL,
CCRepRepLName VARCHAR(20) NOT NULL,
CCRepEmailAddress VARCHAR(50) NOT NULL,
CCRepHireDate Date NOT NULL,
CCRepWage INT Not NULL,
CONSTRAINT CALL_CENTER_REP_PK PRIMARY KEY (CCRepID)
);

#################CALL_CENTER_Archive##########################

CREATE TABLE CALL_CENTER_ARCHIVE(
CallID INT NOT NULL AUTO_INCREMENT,
CCRepID INT NOT NULL,
CusID INT NOT NULL,
CallDate Date NOT NULL,
CallTime Time NOT NULL,
InvNumber INT,
CallDescription VARCHAR (1000),
CallType VARCHAR(60) NOT NULL CHECK (CallType IN ('Follow Up', 'Request by customer')),
CONSTRAINT CALL_CENTER_ARCHIVE_PK PRIMARY KEY (CallID),
CONSTRAINT CALL_CENTER_ARCHIVE_FK1 FOREIGN KEY (InvNumber) REFERENCES INVOICE (InvNumber)  ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT CALL_CENTER_ARCHIVE_FK2 FOREIGN KEY (CusID) REFERENCES CUSTOMER(CusID) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT CALL_CENTER_ARCHIVE_FK3 FOREIGN KEY (CCRepID) REFERENCES CALL_CENTER_REP(CCRepID) ON UPDATE CASCADE ON DELETE CASCADE
);

#################CALL_CENTER_Ass##########################

CREATE TABLE CALL_CENTER_ASS(
CCAssID INT NOT NULL AUTO_INCREMENT,
CCRepID INT NOT NULL,
CusID INT NOT NULL,
InvNumber INT NOT NULL,
CONSTRAINT CALL_CENTER_ASS_PK PRIMARY KEY (CCAssID),
CONSTRAINT CALL_CENTER_ASS_FK1 FOREIGN KEY (InvNumber) REFERENCES INVOICE (InvNumber)  ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT CALL_CENTER_ASS_FK2 FOREIGN KEY (CusID) REFERENCES CUSTOMER(CusID) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT CALL_CENTER_ASS_FK3 FOREIGN KEY (CCRepID) REFERENCES CALL_CENTER_REP(CCRepID) ON UPDATE CASCADE ON DELETE CASCADE
);



####################################################INSERT STATEMENTS####################################################
INSERT INTO MANUFCATURER (ManName, ManLocation, ManLandline, ManContactPerson, ManContactPersonPhone)  VALUES
('Samsung', '58 Abou Bakr El-Sedeek St., El-Nozha, Cairo Governorate', '02 00216580', 'Ahmed Salah Abdo', '01288892623'),
('Redmi', '79 Mossadak, Ad Doqi, Dokki, Giza Governorate', '02 33361566', 'Hassam Ahmed Amin', '01158492623'),
('Apple', '7 El-Thawra Square, Ad Doqi, Dokki, Giza Governorate', '02 33350375', 'Mahmoud Salem', '01212392623'),
('Dell', 'Smart village KM 28 Cairo Alexandria desert road, Building 4, Street 1106 , Cairo', '02 35358000', 'Salem Ahmed', '0106595788'),
('HP', 'xxxx xxxx', '02 xxx', 'Mostafa EL-Said', '01090855411'),
('Lenovo', 'xxxx xxxx', '02 xxx', 'xxx', 'xxxx');

INSERT INTO CATEGORIES (CatName) VALUES 
('Mobile Phones & Communication Products'),
('Portable Devices'),
('Camera & Photo Products'),
('Car & Vehicle Electronics'),
('Computers, Components & Accessories'),
('eBook Readers & Accessories'),
('Headphones, Earbuds & Accessories'),
('Home Audio & Theater Products'),
('Home Theater, TV & Video Products'),
('Household Batteries & Chargers'),
('Portable Sound & Vision Products'),
('Electrical Power Accessories'),
('GPS & Navigation Equipment'),
('Telephones, VoIP & Accessories'),
('Wearable Technology');  


INSERT INTO SUB_CATEGORIES(SubCatName, CatID) VALUES
('Smart Phones', 1),
('Laptops', 2),
('Gaming Laptops', 2),
('Tablets', 2),
('Monitors', 5),
('Printers', 5),
('Scanners', 5),
('Smart Watches',15),
('Fitness Trackers',15),
('Head-Mounted Displays',15);

INSERT INTO SUBCAT_MAN (SubCatID, ManID, SubCatDiscount) VALUES
(1, 1, 10),
(1, 2, 5),
(1, 3, 0),
(2, 4, 5);

INSERT INTO PRODUCT (ProdName, ProdPrice, ProdImageLink, SubCatID, ManID, ProdQuantityAvalilableNew, ProdQuantityAvalilableRef, ProdDiscount, ProdTechnicalSpecs ) VALUES
('Samsung Galaxy 10', 152.00, './assets/products/1.png', 1, 1, 1000, 2, 5, null), 
('Redmi Note 7', 122.00, './assets/products/2.png', 1, 2, 1010, 0, 5, null),
('Redmi Note 6', 122.00, './assets/products/3.png', 1, 2, 1020, 0, null, null),
('Redmi Note 5', 122.00, './assets/products/4.png', 1, 2, 1005, 0, null, null),
('Redmi Note 4', 122.00, './assets/products/5.png', 1, 2, 150, 1, null, null),
('Redmi Note 8', 122.00, './assets/products/6.png', 1, 2, 100, 1, null, null),
('Redmi Note 9', 122.00, './assets/products/8.png', 1, 2, 150, 5, null, null),
('Redmi Note', 122.00, './assets/products/10.png', 1, 2, 100, 0, null, null),
('Samsung Galaxy S6', 152.00, './assets/products/11.png', 1, 1, 2000, 0, 10, null),
('Samsung Galaxy S7', 152.00, './assets/products/12.png', 1, 1, 1000, 0, null, null),
('Apple iPhone 5', 152.00, './assets/products/13.png', 1, 3, 100, 0, 20, null),
('Apple iPhone 6', 152.00, './assets/products/14.png', 1, 3, 100, 0, null, null),
('Apple iPhone 7', 152.00, './assets/products/15.png', 1, 3, 500, 5, null, null),
('Dell Vostro 3500 laptop', 12775.00, './assets/products/16.png', 2, 4, 50, 5, 12, 'Dell Vostro 3500 laptop - 11th Intel core i7-1165G7, 8GB RAM, 1TB HDD, Nvidia GeForce MX330 GDDR5 Graphics, 15.6 Inch FHD, Ubuntu - Black'),
('Dell Inspiron 7506 2n1 X360 laptop', 17893.44, './assets/products/17.png', 2, 4, 50, 5, 12, 'Dell Inspiron 7506 2n1 X360 laptop - 11th Intel Core i5-1135G7, 12GB RAM, 512GB SSD & 32GB Optane, 15.6" FHD Touch, Intel Iris Xe Graphics, FingerPrint, Backlit keyboard, Windows 10- Platinum Silver'),
('Apple MacBook Pro', 24490.00, './assets/products/18.png', 2, 3, 20, 4, null, 'Apple MacBook Pro Late 2020 MYD82 Model With Touch Bar And Touch ID'),
('HP 250 G7 Laptop', 11949.00, './assets/products/19.png', 2, 5, 15, 1, null, 'HP 250 G7 Laptop, 10th Generation Intel Core i7-1065G7, 8 GB RAM, 1TB HDD, Intel Iris Plus Graphics, 15.6 Inch HD anti-glare 220 nits, Windows 10 - Dark ash silver'),
('Lenovo ThinkBook 15 G2 Laptop', 14500.00, './assets/products/20.png', 2, 6, 25, 0, 3, 'Lenovo ThinkBook 15 G2 Laptop - 11th Intel Core i7-1165G7, 8GB RAM, 1TB HDD, NVIDIA GeForce MX450 2GB GDDR6 Graphics, 15.6 Inch FHD (1920x1080) 220nits Anti-glare, Fingerprint Reader - Mineral Grey');




