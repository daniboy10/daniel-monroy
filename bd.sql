CREATE DATABASE gestor;


--usuarios 

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    status INT NOT NULL,
    token INT
);

--PRODUCTOS
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    cantidad INT NOT NULL,
    status INT NOT NULL
);
CREATE TABLE catalog_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    height INT,
    length INT,
    width INT,
    status INT
);



INSERT INTO usuarios (nombre,correo, pass, status, token) 
VALUES ('JuanPerez','jperez@gmail.com', 'password123', 1, 9876);


INSERT INTO productos (nombre, cantidad, status) 
VALUES ('Detergente', 50, 1);