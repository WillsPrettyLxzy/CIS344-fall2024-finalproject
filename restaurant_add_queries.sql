-- Use the correct database
USE restaurant_reservations;

-- 1. Create Customers Table (if not exists)
CREATE TABLE IF NOT EXISTS Customers (
    customerId INT AUTO_INCREMENT PRIMARY KEY,
    customerName VARCHAR(255) NOT NULL,
    contactInfo VARCHAR(255) NOT NULL
);

-- 2. Create Reservations Table (if not exists)
CREATE TABLE IF NOT EXISTS Reservations (
    reservationId INT AUTO_INCREMENT PRIMARY KEY,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests TEXT,
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

-- 3. Insert Test Data into Customers
INSERT INTO Customers (customerName, contactInfo) 
VALUES 
('Forrest Gump', 'forrest.gump@example.com'),
('Luna Lovegood', 'luna.lovegood@example.com');

-- 4. Insert Test Data into Reservations
INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests) 
VALUES 
(1, '2024-12-20 19:30:00', 5, 'Celebrating a graduation, needs extra chairs'),
(2, '2024-12-22 18:45:00', 3, 'Quiet area, prefers soft lighting');
