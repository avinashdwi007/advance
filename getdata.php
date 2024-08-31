<?php
include 'db.php';
include 'location.php';

$database = new Database();
$db = $database->getConnection();
$location = new Location($db);

$type = $_GET['type'];
$id = $_GET['id'];

$response = ['status' => 'error', 'data' => []];

if ($type === 'state') {
    $states = $location->getStates($id);
    $response = [
        'status' => 'success',
        'data' => $states
    ];
} elseif ($type === 'city') {
    $cities = $location->getCities($id);
    $response = [
        'status' => 'success',
        'data' => $cities
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
