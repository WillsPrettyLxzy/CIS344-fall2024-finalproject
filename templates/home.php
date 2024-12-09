<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #f9f9f9, #e0e0e0);
            color: #333;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }
        .nav-links a {
            text-decoration: none;
            color: white;
            background-color: #2c3e50;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: center;
        }
        .nav-links a:hover {
            background-color: #34495e;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <h1>Restaurant Management Portal</h1>
    </header>
    <div class="container">
        <h2>Welcome!</h2>
        <p>Manage your restaurant's reservations, customers, and dining experiences seamlessly with our easy-to-use portal. Use the links below to navigate the platform:</p>
        
        <!-- Customer Management Links -->
        <h3>Customer Management</h3>
        <div class="nav-links">
            <a href="addCustomers.php">Add Customer</a>
            <a href="viewCustomers.php">View Customers</a>
        </div>

        <!-- Reservation Management Links -->
        <h3>Reservation Management</h3>
        <div class="nav-links">
            <a href="addReservation.php?action=addReservation">Add Reservation</a>
            <a href="viewReservations.php?action=viewReservations">View Reservations</a>
        </div>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> CIS 344 Elijah Estrada. All rights reserved.
    </footer>
</body>
</html>
