<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Error: User not logged in.'); window.location.href='../index.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

$title = htmlspecialchars(strip_tags($_POST['title']));
$date = $_POST['date'];
$time = $_POST['time'];
$location = htmlspecialchars(strip_tags($_POST['location']));
$contact = htmlspecialchars(strip_tags($_POST['contact']));
$description = htmlspecialchars(strip_tags($_POST['description']));

// Delete expired blood drives (past events)
$delete_query = "DELETE FROM blood_drives WHERE date < CURDATE()";
$conn->query($delete_query);

$query = "INSERT INTO blood_drives (user_id, title, date, time, location, contact, description, created_at) 
          VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($query);
$stmt->bind_param("issssss", $user_id, $title, $date, $time, $location, $contact, $description);

if ($stmt->execute()) {
    echo "<script>alert('Blood drive promoted successfully!'); window.location.href='../home.php';</script>";
} else {
    echo "<script>alert('Error: Could not submit the blood drive. Please try again.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
