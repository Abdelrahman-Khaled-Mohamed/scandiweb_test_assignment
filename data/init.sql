CREATE DATABASE store;

use store;

CREATE TABLE Products (
	SKU VARCHAR(16) PRIMARY KEY, 
	Name VARCHAR(32) NOT NULL,
	Price DOUBLE(16, 4) NOT NULL,
	CONSTRAINT CHK_Price CHECK (Price>=0)
);

CREATE TABLE Books (
	SKU VARCHAR(16) PRIMARY KEY, 
	Weight DOUBLE(8, 2) NOT NULL, 
	CONSTRAINT CHK_Weight CHECK (Weight>=0),
	CONSTRAINT FK_BookSKU FOREIGN KEY (SKU) REFERENCES Products(SKU) ON DELETE CASCADE
);

CREATE TABLE DVDs (
	SKU VARCHAR(16) PRIMARY KEY, 
	Size DOUBLE(8, 2) NOT NULL, 
	CONSTRAINT CHK_Size CHECK (Size>=0),
	CONSTRAINT FK_DVDSKU FOREIGN KEY (SKU) REFERENCES Products(SKU) ON DELETE CASCADE
);

CREATE TABLE Furniture (
	SKU VARCHAR(16) PRIMARY KEY, 
	Height DOUBLE(8, 2) NOT NULL,
	Width DOUBLE(8, 2) NOT NULL,
	Length DOUBLE(8, 2) NOT NULL,
	CONSTRAINT CHK_Dimensions CHECK (Height>=0 AND Width>=0 AND Length>=0),
	CONSTRAINT FK_FurnitureSKU FOREIGN KEY (SKU) REFERENCES Products(SKU) ON DELETE CASCADE
);