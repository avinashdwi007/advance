<?php
include 'db.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    if (isset($_FILES['passport']) && $_FILES['passport']['error'] == UPLOAD_ERR_OK) {
        if ($_FILES['passport']['size'] > 1024 * 1024 * 10) {
            die("File is too large. Maximum allowed size is 10MB.");
        }

        $passportImagePath = 'uploads/' . basename($_FILES['passport']['name']);
        if (move_uploaded_file($_FILES['passport']['tmp_name'], $passportImagePath)) {
            $passportImageData = $passportImagePath;
        } else {
            $passportImageData = null;
        }
    } else {
        $passportImageData = null;
    }

    $query = "INSERT INTO customers (name, email, contact_no, dob, gender, address, country, state, city, passport_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $db->prepare($query)) {
        $stmt->bind_param("ssssssssss", $name, $email, $contact, $dob, $gender, $address, $country, $state, $city, $passportImageData);

        if ($stmt->execute()) {
            header("Location: read.php?message_type=success&message_text=Record inserted successfully");
            exit();
        } else {
            echo "Error inserting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $db->error;
    }

    $db->close();
}
