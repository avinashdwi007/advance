<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: read.php?message_type=success&message_text=Record deleted successfully");
        exit(); // Ensure the script stops after the redirect
    } else {
        header("Location: read.php?message_type=error&message_text=Error deleting record");
        exit();
    }

    $stmt->close();
} else {
    header("Location: read.php?message_type=error&message_text=Invalid or missing ID");
    exit();
}

$conn->close();
