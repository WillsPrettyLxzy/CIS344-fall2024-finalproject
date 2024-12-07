<?php
class RestaurantDatabase {
    private $host = "localhost";
    private $port = "3306";
    private $database = "restaurant_reservations";
    private $user = "root";
    private $password = "";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        // echo "Successfully connected to the database"; // Optionally, comment this out in production
    }

    public function addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests) {
        $reservationTime = date('Y-m-d H:i:s', strtotime($reservationTime)); // Ensure correct format
        $stmt = $this->connection->prepare(
            "INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isis", $customerId, $reservationTime, $numberOfGuests, $specialRequests);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            die("Error executing the query: " . $stmt->error);
        }
        $stmt->close();
    }

    public function getAllReservations() {
        $result = $this->connection->query("SELECT * FROM reservations");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addCustomer($customerName, $contactInfo) {
        $stmt = $this->connection->prepare(
            "INSERT INTO Customers (customerName, contactInfo) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $customerName, $contactInfo);
        $stmt->execute();
        $stmt->close();
    }

    public function getCustomerPreferences($customerId) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM DiningPreferences WHERE customerId = ?"
        );
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $preferences = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $preferences;
    }

    public function addSpecialRequest($reservationId, $requests) {
        $stmt = $this->connection->prepare(
            "UPDATE reservations SET specialRequests = ? WHERE reservationId = ?"
        );
        $stmt->bind_param("si", $requests, $reservationId);
        $stmt->execute();
        $stmt->close();
    }

    public function findReservations($customerId) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM reservations WHERE customerId = ?"
        );
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $reservations = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $reservations;
    }

    public function cancelReservation($reservationId) {
        $stmt = $this->connection->prepare("DELETE FROM reservations WHERE reservationId = ?");
        $stmt->bind_param("i", $reservationId);
        $stmt->execute();
        $stmt->close();
    }

    public function getReservationById($reservationId) {
        $stmt = $this->connection->prepare("SELECT * FROM reservations WHERE reservationId = ?");
        $stmt->bind_param("i", $reservationId);
        $stmt->execute();
        $result = $stmt->get_result();
        $reservation = $result->fetch_assoc();
        $stmt->close();
        return $reservation;
    }

    public function updateReservation($reservationId, $customerId, $reservationTime, $numberOfGuests, $specialRequests) {
        $reservationTime = date('Y-m-d H:i:s', strtotime($reservationTime)); // Ensure correct format
        $stmt = $this->connection->prepare(
            "UPDATE reservations SET customerId = ?, reservationTime = ?, numberOfGuests = ?, specialRequests = ? WHERE reservationId = ?"
        );
        $stmt->bind_param("isisi", $customerId, $reservationTime, $numberOfGuests, $specialRequests, $reservationId);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct() {
        $this->connection->close();
    }
}
?>