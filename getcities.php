<?php
include 'db.php';
include 'Location.php';

$database = new Database();
$db = $database->getConnection();
$location = new Location($db);

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['state_id'])) {
    $cities = $location->getCities($data['state_id']);
    echo json_encode(['status' => 'success', 'data' => $cities]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'State ID is missing.']);
}
