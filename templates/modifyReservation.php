<?php
require_once '../restaurantServer.php';

// Fetch reservation details
$reservationId = $_GET['id'] ?? null;
if ($reservationId) {
    $reservation = $portal->getDb()->getReservationById($reservationId);  // Use the getter method to access $db
} else {
    die("Reservation not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['customer_id'];
    $reservationTime = $_POST['reservation_time'];
    $numberOfGuests = $_POST['number_of_guests'];
    $specialRequests = $_POST['special_requests'];

    // Update reservation in the database
    $portal->getDb()->updateReservation($reservationId, $customerId, $reservationTime, $numberOfGuests, $specialRequests);  // Use getter method for $db

    // Redirect to view_reservations.php after update
    header("Location: viewReservations.php?message=Reservation+Updated+Successfully");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Reservation - Restaurant Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Modify Reservation</h1>
        
        <!-- Display success message if redirected from update -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer ID</label>
                <input type="number" class="form-control" id="customer_id" name="customer_id" value="<?= htmlspecialchars($reservation['customerId']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="reservation_time" class="form-label">Reservation Time</label>
                <input type="datetime-local" class="form-control" id="reservation_time" name="reservation_time" value="<?= htmlspecialchars($reservation['reservationTime']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="number_of_guests" class="form-label">Number of Guests</label>
                <input type="number" class="form-control" id="number_of_guests" name="number_of_guests" value="<?= htmlspecialchars($reservation['numberOfGuests']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="special_requests" class="form-label">Preferences</label>
                <textarea class="form-control" id="special_requests" name="special_requests"><?= htmlspecialchars($reservation['specialRequests']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Reservation</button>
        </form>
        <a href="viewReservations.php" class="btn btn-secondary mt-3">Back to Reservations</a>
    </div>
</body>
</html>