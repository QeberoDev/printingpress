use printingpress_test;

INSERT INTO `customer` (name, phonenumber, address, email)
VALUES 
	('Abebe Biqila', '+251911223344', 'Bole 04', 'notemail@domain.com'),
	('Beqele Terefe', '+251918283388', 'Genda Gara', 'mail@notdomain.com');

INSERT INTO `employee` (first_name, last_name, phone_number, employee_type_id, address, email)
VALUES 
	('Girma', 'Tadesse', '+251920304050', '1', 'Collage Addisu', 'empmail@ourdomain.com'),
	('Biftu', 'Masresha', '+251911334455', '1', 'Atana Tera', 'ouremp@mail.com');

INSERT INTO `user` (employee_id, `username`, `password`, account_type)
VALUES
	(1, 'empuser1', 'emppass1', '1')
	(2, 'empuser2', 'emppass2', '1');