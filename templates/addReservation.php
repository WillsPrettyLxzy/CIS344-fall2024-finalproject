<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reservation - Restaurant Management</title>
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
            <h1 class="text-center mb-4">Add a New Reservation</h1>
            <form action="index.php?action=addReservation" method="POST">
                <div class="mb-3">
                    <label for="customer_id" class="form-label">Customer ID</label>
                    <input type="number" class="form-control" id="customer_id" name="customer_id" required>
                </div>

                <div class="mb-3">
                    <label for="reservation_time" class="form-label">Reservation Time</label>
                    <input type="datetime-local" class="form-control" id="reservation_time" name="reservation_time" required>
                </div>

                <div class="mb-3">
                    <label for="number_of_guests" class="form-label">Number of Guests</label>
                    <input type="number" class="form-control" id="number_of_guests" name="number_of_guests" required>
                </div>

                <div class="mb-3">
                    <label for="special_requests" class="form-label">Special Requests</label>
                    <textarea class="form-control" id="special_requests" name="special_requests" rows="4"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Reservation</button>
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
