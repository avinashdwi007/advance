<?php
require_once 'db.php';  
require_once 'Location.php'; 

$database = new Database();
$db = $database->getConnection();
$location = new Location($db); 

if (isset($_POST['country_id'])) {
    $states = $location->getStates($_POST['country_id']);
    echo '<option value="">Select State</option>';
    foreach ($states as $state) {
        echo '<option value="' . htmlspecialchars($state['id']) . '">' . htmlspecialchars($state['name']) . '</option>';
    }
}

if (isset($_POST['state_id'])) {
    $cities = $location->getCities($_POST['state_id']);
    echo '<option value="">Select City</option>';
    foreach ($cities as $city) {
        echo '<option value="' . htmlspecialchars($city['id']) . '">' . htmlspecialchars($city['name']) . '</option>';
    }
}
