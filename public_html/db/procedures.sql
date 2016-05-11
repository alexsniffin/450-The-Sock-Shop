/*
	Creates a new Product
*/
DELIMITER //
CREATE PROCEDURE newProduct
	(IN name VARCHAR(64),
	IN price INT,
	IN image_url VARCHAR(255),
	IN quantity INT,
	IN description VARCHAR(255))
BEGIN
	DECLARE EXIT HANDLER FOR 1062 SELECT 'Values cannot be null';
	INSERT INTO Product VALUES(NULL, name, price, image_url, quantity, description);
END //
DELIMITER ;

CALL newProduct('Men''s Burlington Socks', 899, 'itm_1.jpg', 999, 'High quality Mens Burlington socks.');
CALL newProduct('Minion Socks', 499, 'itm_2.jpg', 999, 'Fancy Minion socks from the movie Despicable Me!');
CALL newProduct('White Socks', 399, 'itm_3.jpg', 999, 'Plain white socks made from high quality cotton.');
CALL newProduct('Athletic Socks', 699, 'itm_4.jpg', 999, 'Thin athletic socks made specifically for comfort and high durability.');
CALL newProduct('Marvel Socks', 799, 'itm_5.jpg', 999, 'The popular Marvel Socks with characters from the fictional universal of Marvel.');
CALL newProduct('Sesame Street Socks', 899, 'itm_6.jpg', 999, 'Our custom Sesame Street Socks, one of our most popular orders.');

/*
	Creates a new Purchase
*/
DELIMITER //
CREATE PROCEDURE newPurchase
	(IN receipt_id INT,
	IN product_id INT,
	IN quantity INT)
BEGIN
	INSERT INTO Purchased VALUES(NULL, receipt_id, product_id, quantity);
END //
DELIMITER ;

/*
	Creates a new Customer if they don't exist, else just return the id
*/
DELIMITER //
CREATE FUNCTION newCustomer(fname VARCHAR(64), lname VARCHAR(64), address VARCHAR(255), phone INT, email VARCHAR(128))
	RETURNS BIGINT UNSIGNED
BEGIN
	DECLARE our_id BIGINT UNSIGNED DEFAULT NULL;

	SELECT customer_id INTO our_id FROM Customer c WHERE c.phone = phone AND c.email = email;

	IF (our_id IS NULL) THEN
		INSERT INTO Customer VALUES(NULL, fname, lname, address, phone, email);
		SET our_id = LAST_INSERT_ID();
	END IF;

	RETURN our_id;
END //
DELIMITER ;

/*
	Insert a new Receipt and returns the receipt_id
*/
DELIMITER //
CREATE FUNCTION newReceipt(customer_id INT, time_ordered TIMESTAMP)
	RETURNS BIGINT UNSIGNED
BEGIN
	INSERT INTO Receipt VALUES(NULL, customer_id, time_ordered);
	RETURN LAST_INSERT_ID();
END //
DELIMITER ;