CREATE DATABASE cargardatos;
USE cargardatos;


CREATE TABLE datos(
    id INT NOT NULL auto_increment,
    nombres VARCHAR(50) NOT NULL,
    apellido1 VARCHAR(25) NOT NULL,
    apellido2 VARCHAR(25) NOT NULL,
    dia INT(2) NOT NULL,
    mes INT(2) NOT NULL,
    year_na INT(4) NOT NULL,
	sexo VARCHAR(1) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    PRIMARY KEY(id)
);



