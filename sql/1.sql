CREATE TABLE pagos360.clients
(
    id INT(8) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(128),
    lastName VARCHAR(128),
    dni INT(9),
    email VARCHAR(128)
);
CREATE INDEX clients_dni_index ON pagos360.clients (dni);
CREATE INDEX clients_names_index ON pagos360.clients (lastName, name);
