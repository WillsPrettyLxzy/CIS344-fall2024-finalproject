<?php
require_once '../restaurant_server.php';

// Fetch customer details
$customerId = $_GET['id'] ?? null;
if ($customerId) {
    $customer = $portal->getDb()->getCustomerById($customerId);  // Use the getter method to access $db
} else {
    die("Customer not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = $_POST['customer_name'];
    $contactInfo = $_POST['contact_info'];

    // Update customer in the database
    $portal->getDb()->updateCustomer($customerId, $customerName, $contactInfo);  // Use getter method for $db

    // Redirect to view_customers.php after update
    header("Location: viewCustomers.php?message=Customer+Updated+Successfully");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Customer - Restaurant Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Modify Customer</h1>
        
        <!-- Display success message if redirected from update -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?= htmlspecialchars($customer['customerName']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info</label>
                <input type="text" class="form-control" id="contact_info" name="contact_info" value="<?= htmlspecialchars($customer['contactInfo']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </form>
        <a href="viewCustomers.php" class="btn btn-secondary mt-3">Back to Customers</a>
    </div>
</body>
</html>
