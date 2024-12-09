<?php
require_once '../restaurant_server.php';  // Include the server file to access the portal object

// Check if the 'id' parameter is provided in the URL
$reservationId = $_GET['id'] ?? null;
if ($reservationId) {
    // Call the cancelReservation method from the RestaurantPortal class
    $portal = new RestaurantPortal(); // Initialize the portal class
    $portal->cancelReservation($reservationId);  // Call the method to delete the reservation

    // Optionally, you can show a success message here (you could also show it in the view)
    echo "Reservation cancelled successfully.";
    exit;
} else {
    echo "Reservation ID not provided.";
}
?>