<?php
// Include the RestaurantDatabase class
include_once '../restaurantDatabase.php';

// Initialize the database connection
$restaurantDB = new RestaurantDatabase();

// Fetch all customers from the database
$customers = $restaurantDB->getAllCustomers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers - Restaurant Management</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABQbWvxBzRn7Hk2XU5i5f5r9gOkK9m07V9eSTkSO2v8fgpg6e7mWk0a" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            padding-top: 30px;
        }
        .table th, .table td {
            text-align: center;
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .table-striped tbody tr:nth-child(even) {
            background-color: #fff;
        }
        .btn-primary, .btn-warning, .btn-danger {
            font-size: 14px;
            padding: 8px 16px;
        }
        .btn-link {
            font-size: 16px;
        }
        .text-center {
            margin-top: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">All Customers</h1>

        <!-- Show message if any -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success text-center" role="alert">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Customers Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)): ?>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= htmlspecialchars($customer['customerId']) ?></td>
                                <td><?= htmlspecialchars($customer['customerName']) ?></td>
                                <td><?= htmlspecialchars($customer['contactInfo']) ?></td>
                                <td>
                                    <a href="modifyCustomer.php?id=<?= $customer['customerId'] ?>" class="btn btn-warning btn-sm">Modify</a>
                                    <a href="deleteCustomer.php?id=<?= $customer['customerId'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No customers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Back to Home Button -->
        <div class="text-center">
            <a href="home.php?action=home" class="btn btn-primary">Back to Home</a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb2z8q7z5L0Xj68y8Q44aGpdQWq7ZfYfY9es35JPjK0HU5yImT" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0+NfEXoCp9e2dmHtC6FOkNQ2mOS9Glv7gbi6beV9vG3+5mOg" crossorigin="anonymous"></script>
</body>
</html>