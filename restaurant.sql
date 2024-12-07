CREATE DATABASE restaurant_reservations;

USE restaurant_reservations;

CREATE TABLE Customers (
    customerId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerName VARCHAR(45) NOT NULL,
    contactInfo VARCHAR(200),
    PRIMARY KEY (customerId)
);

CREATE TABLE Reservations (
    reservationId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests VARCHAR(200),
    PRIMARY KEY (reservationId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

CREATE TABLE DiningPreferences (
    preferenceId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    favoriteTable VARCHAR(45),
    dietaryRestrictions VARCHAR(200),
    PRIMARY KEY (preferenceId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

DELIMITER $$

CREATE PROCEDURE findReservations(IN inputCustomerId INT)
BEGIN
    SELECT * FROM Reservations WHERE customerId = inputCustomerId;
END $$

CREATE PROCEDURE addSpecialRequest(IN inputReservationId INT, IN inputRequests VARCHAR(200))
BEGIN
    UPDATE Reservations SET specialRequests = inputRequests WHERE reservationId = inputReservationId;
END $$

CREATE PROCEDURE addReservation(
    IN inputCustomerName VARCHAR(45), 
    IN inputContactInfo VARCHAR(200),
    IN inputReservationTime DATETIME,
    IN inputNumberOfGuests INT,
    IN inputSpecialRequests VARCHAR(200)
)
BEGIN
    DECLARE existingCustomerId INT;
    SELECT customerId INTO existingCustomerId FROM Customers WHERE customerName = inputCustomerName;

    IF existingCustomerId IS NULL THEN
        INSERT INTO Customers (customerName, contactInfo) VALUES (inputCustomerName, inputContactInfo);
        SET existingCustomerId = LAST_INSERT_ID();
    END IF;

    INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
    VALUES (existingCustomerId, inputReservationTime, inputNumberOfGuests, inputSpecialRequests);
END $$

DELIMITER ;

INSERT INTO Customers (customerName, contactInfo) VALUES
('John Doe', 'john.doe@example.com'),
('Jane Smith', 'jane.smith@example.com'),
('Alice Johnson', 'alice.johnson@example.com');

INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests) VALUES
(1, '2024-12-10 18:30:00', 4, 'Window seat'),
(2, '2024-12-11 19:00:00', 2, 'Vegan options'),
(3, '2024-12-12 20:00:00', 3, 'Birthday celebration');