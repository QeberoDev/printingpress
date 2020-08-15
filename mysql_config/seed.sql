use printingpress_test;

INSERT INTO `customer` 
	(name, phonenumber, address, email)
VALUES 
	('Abebe Biqila', '+251911223344', 'Bole 04', 'notemail@domain.com'),
	('Beqele Terefe', '+251918283388', 'Genda Gara', 'mail@notdomain.com');

INSERT INTO `employee_type`
	(name, description)
VALUES
	('type 1', 'this is a type 1 employee');

INSERT INTO `employee` 
	(first_name, last_name, phone_number, employee_type_id, address, email)
VALUES 
	('Girma', 'Tadesse', '+251920304050', '1', 'Collage Addisu', 'empmail@ourdomain.com'),
	('Biftu', 'Masresha', '+251911334455', '1', 'Atana Tera', 'ouremp@mail.com');