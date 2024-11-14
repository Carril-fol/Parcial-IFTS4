CREATE DATABASE inmueble;

USE inmueble;

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cuil BIGINT,
    name VARCHAR(255)
);

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni INT UNIQUE,
    firstName VARCHAR(255),
    lastName VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255)
);

CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    idClient INT,
    idSupplier INT,
    domicile VARCHAR(255),
    fanAmount INT,
    spentAmount INT,
    status VARCHAR(255),
    FOREIGN KEY (idClient) REFERENCES clients(id),
    FOREIGN KEY (idSupplier) REFERENCES suppliers(id)
);