/*
	A Product can be part of many Purchased Receipts
*/
CREATE TABLE Product (
	product_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	price INT NOT NULL,
	image_url VARCHAR(255),
	quantity INT,
	description VARCHAR(255)
);

/*
	A Receipt can have many Products Purchased
*/
CREATE TABLE Receipt (
	receipt_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	customer_id INT NOT NULL,
	time_ordered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
);

/* 
	A Purchased is mapped to one Product and one Receipt
*/
CREATE TABLE Purchased (
	purchased_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	receipt_id INT NOT NULL,
	product_id INT NOT NULL,
	quantity INT NOT NULL,
	FOREIGN KEY (receipt_id) REFERENCES Receipt(receipt_id),
	FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

/*
	A Customer can have many Receipts
*/
CREATE TABLE Customer (
	customer_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fname VARCHAR(64) NOT NULL,
	lname VARCHAR(64) NOT NULL,
	address VARCHAR(255) NOT NULL,
	phone INT NOT NULL,
	email VARCHAR(128) NOT NULL,
	UNIQUE(phone),
	UNIQUE(email)
);

/*
	Administrator table
*/
CREATE TABLE Administrator (
	admin_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(64) NOT NULL,
	password VARCHAR(64) NOT NULL,
	UNIQUE(username)
);

-- Search index for name
CREATE INDEX search_name ON Product(name);
-- Search index for price
CREATE INDEX search_price ON Product(price);
-- Search index for a Customer based on unique phone and email
CREATE INDEX search_customer ON Customer(phone, email);