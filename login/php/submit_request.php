<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('You must be logged in to post a request.'); window.location.href='../index.php';</script>";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];

    $query = "INSERT INTO urgent_requests (user_id, name, blood_type, location, contact, message) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssss", $user_id, $name, $blood_type, $location, $contact, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Urgent blood request posted successfully!'); window.location.href='../home.php';</script>";
    } else {
        echo "<script>alert('Error: Could not post request. Please try again.'); window.location.href='../home.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
