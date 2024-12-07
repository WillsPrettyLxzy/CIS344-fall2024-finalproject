<?php
// Include the main server file to handle requests.
require_once 'restaurant_server.php';

// Create an instance of the RestaurantPortal class and handle the request.
$portal = new RestaurantPortal();
$portal->handleRequest();
