CREATE TABLE users(
	int SERIAL NOT NULL,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL UNIQUE,
	email VARCHAR(50) NOT NULL UNIQUE
);
INSERT INTO users(username, password, email) VALUES('admin', 'admin', 'admin@mail.ru')