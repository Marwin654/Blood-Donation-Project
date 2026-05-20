<?php
include 'config.php';
session_start();

// Retrieve form data
$name = $_POST['name'];
$message = $_POST['message'];

// Insert into database with automatic timestamp
$query = "INSERT INTO testimonials (name, message, created_at) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $name, $message);

if ($stmt->execute()) {
    echo "<script>alert('Testimonial submitted successfully!'); window.location.href = '../home.php#testimonials';</script>";
} else {
    echo "<script>alert('Error: " . addslashes($conn->error) . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
