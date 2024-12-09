<?php
require_once 'restaurantDatabase.php';

class RestaurantPortal {
    private $db;

    public function __construct() {
        $this->db = new RestaurantDatabase();
    }

    public function getDb() {
        return $this->db;  // Getter method for accessing $db
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
            case 'addReservation':
                $this->addReservation();
                break;
            case 'viewReservations':
                $this->viewReservations();
                break;
            case 'addSpecialRequest':
                $this->addSpecialRequest();
                break;
            case 'viewPreferences':
                $this->viewPreferences();
                break;
            case 'cancelReservation':
                $this->cancelReservation();
                break;
            case 'modifyReservation':
                $this->modifyReservation();
                break;
            default:
                $this->home();
                break;
        }
    }

    private function home() {
        include 'templates/home.php';
    }

    private function addReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerId = $_POST['customer_id'];
            $reservationTime = $_POST['reservation_time'];
            $numberOfGuests = $_POST['number_of_guests'];
            $specialRequests = $_POST['special_requests'];

            $this->db->addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests);
            header("Location: index.php?action=viewReservations&message=Reservation Added");
            exit;
        } else {
            include 'templates/add_reservation.php';
        }
    }

    private function viewReservations() {
        $reservations = $this->db->getAllReservations();
        include 'templates/view_reservations.php';
    }

    private function addSpecialRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservationId = $_POST['reservation_id'];
            $specialRequests = $_POST['special_requests'];
            $this->db->addSpecialRequest($reservationId, $specialRequests);
            header("Location: index.php?action=viewReservations&message=Special Request Added");
            exit;
        } else {
            include 'templates/addSpecialRequest.php';
        }
    }

    private function viewPreferences() {
        $customerId = $_GET['customer_id'] ?? null;
        if ($customerId) {
            $preferences = $this->db->getCustomerPreferences($customerId);
            include 'templates/viewPreferences.php';
        } else {
            echo "Customer ID not provided.";
        }
    }

    private function cancelReservation() {
        $reservationId = $_GET['id'] ?? null;
        if ($reservationId) {
            $this->db->cancelReservation($reservationId);
            header("Location: index.php?action=viewReservations&message=Reservation Cancelled");
            exit;
        } else {
            echo "Reservation ID not provided.";
        }
    }

    private function modifyReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservationId = $_POST['reservation_id'];
            $reservationTime = $_POST['reservation_time'];
            $numberOfGuests = $_POST['number_of_guests'];
            $specialRequests = $_POST['special_requests'];

            $this->db->updateReservation($reservationId, $reservationTime, $numberOfGuests, $specialRequests);  // Fixed method name here
            header("Location: index.php?action=viewReservations&message=Reservation Modified");
            exit;
        } else {
            $reservationId = $_GET['id'] ?? null;
            if ($reservationId) {
                $reservation = $this->db->getReservationById($reservationId);
                include 'templates/modify_reservation.php';
            } else {
                echo "Reservation ID not provided.";
            }
        }
    }
}

// Entry point for handling requests
$portal = new RestaurantPortal();
$portal->handleRequest();