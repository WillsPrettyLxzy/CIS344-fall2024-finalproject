-- Use the correct database
USE restaurant_reservations;

-- Delete reservations associated with Forrest Gump and Luna Lovegood
DELETE FROM Reservations
WHERE customerId IN (
    SELECT customerId 
    FROM Customers 
    WHERE customerName IN ('Thanos', 'Niko Bellic')
);

-- Delete the customers Forrest Gump and Luna Lovegood
DELETE FROM Customers
WHERE customerName IN ('Thanos', 'Niko Bellic');
