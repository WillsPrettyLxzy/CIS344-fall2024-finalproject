<?php
// Database credentials
$host = '127.0.0.1';  // Use localhost or IP
$db = 'restaurant_reservations';  // Your database name
$user = 'root';  // Your MySQL username (default for XAMPP is root)
$pass = '';  // Your MySQL password (default for XAMPP is empty)

// Create PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;  // Stop the script if there's a connection error
}

// Fetch reservations from the database
$query = "SELECT * FROM Reservations";
$stmt = $pdo->query($query);

$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch all reservations
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations - Restaurant Management</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABQbWvxBzRn7Hk2XU5i5f5r9gOkK9m07V9eSTkSO2v8fgpg6e7mWk0a" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css"> <!-- Optional Custom Styles -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">All Reservations</h1>

        <!-- Show message if any -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success text-center" role="alert">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Reservation ID</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Reservation Time</th>
                        <th scope="col">Number of Guests</th>
                        <th scope="col">Special Requests</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reservations)): ?>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reservation['reservationId']) ?></td>
                                <td><?= htmlspecialchars($reservation['customerId']) ?></td>
                                <td><?= htmlspecialchars($reservation['reservationTime']) ?></td>
                                <td><?= htmlspecialchars($reservation['numberOfGuests']) ?></td>
                                <td><?= htmlspecialchars($reservation['specialRequests']) ?></td>
                                <td>
                                    <a href="modify_reservation.php?id=<?= $reservation['reservationId'] ?>" class="btn btn-warning btn-sm">Modify</a>
                                    <a href="view_reservations.php?action=cancelReservation&id=<?= $reservation['reservationId'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No reservations found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="home.php?action=home" class="btn btn-primary">Back to Home</a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb2z8q7z5L0Xj68y8Q44aGpdQWq7ZfYfY9es35JPjK0HU5yImT" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0+NfEXoCp9e2dmHtC6FOkNQ2mOS9Glv7gbi6beV9vG3+5mOg" crossorigin="anonymous"></script>
</body>
</html>
