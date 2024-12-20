<?php
// Include the RestaurantDatabase class
include_once '../restaurantDatabase.php';

// Initialize the database connection
$restaurantDB = new RestaurantDatabase();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = $_POST['customer_name'];
    $contactInfo = $_POST['contact_info'];

    // Add customer to the database
    $restaurantDB->addCustomer($customerName, $contactInfo);

    // Redirect with a success message
    header('Location: viewCustomers.php?message=Customer+added+successfully');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer - Restaurant Management</title>
    <!-- Include Bootstrap CSS (you can use CDN or local file) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABQbWvxBzRn7Hk2XU5i5f5r9gOkK9m07V9eSTkSO2v8fgpg6e7mWk0a" crossorigin="anonymous">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            font-size: 2rem;
            color: #343a40;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            border-radius: 5px;
            border-color: #ced4da;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 1rem;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-link {
            text-decoration: none;
            color: #007bff;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .text-center {
            text-align: center;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .mt-3 {
            margin-top: 20px;
        }

        .col-md-6, .col-lg-4 {
            max-width: 100%;
        }

        @media (max-width: 767px) {
            .container {
                padding: 20px;
            }
            .col-md-6 {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center mb-4">Add a New Customer</h1>
            <form action="addCustomer.php" method="POST">
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                </div>

                <div class="mb-3">
                    <label for="contact_info" class="form-label">Contact Information</label>
                    <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Customer</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="home.php?action=home" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb2z8q7z5L0Xj68y8Q44aGpdQWq7ZfYfY9es35JPjK0HU5yImT" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0+NfEXoCp9e2dmHtC6FOkNQ2mOS9Glv7gbi6beV9vG3+5mOg" crossorigin="anonymous"></script>
</body>
</html>