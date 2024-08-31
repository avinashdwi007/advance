<?php
include 'db.php';
include 'Location.php';

$database = new Database();
$db = $database->getConnection();
$location = new Location($db);

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['country_id'])) {
    $states = $location->getStates($data['country_id']);
    echo json_encode(['status' => 'success', 'data' => $states]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Country ID is missing.']);
}
