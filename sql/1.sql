-- Table structure
CREATE TABLE clients
(
    id INT(8) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(128),
    lastname VARCHAR(128),
    dni INT(9),
    email VARCHAR(128)
);
CREATE INDEX clients_dni_index ON pagos360.clients (dni);
CREATE INDEX clients_names_index ON pagos360.clients (lastName, name);

-- Sample data
INSERT INTO pagos360.clients (name,lastname,dni,email) VALUES ('Matias','Pino',33387275,'pnoexz@gmail.com');
INSERT INTO pagos360.clients (name,lastname,dni) VALUES ('Foo','Bar',12345678);
