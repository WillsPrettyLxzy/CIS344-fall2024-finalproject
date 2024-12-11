<?php
require_once '../restaurantServer.php';  // Include the server file to access the portal object

// Get the customer ID from the URL
$customerId = $_GET['id'] ?? null;

if ($customerId) {
    // Initialize the portal object
    $portal = new RestaurantPortal();  // Make sure to initialize the portal

    // Delete the customer from the database
    $portal->getDb()->deleteCustomer($customerId);

    // Redirect back to the customer list or another page after deletion
    header("Location: viewCustomers.php?message=Customer+Deleted+Successfully");
    exit;
} else {
    die("Customer not found.");
}
?>
