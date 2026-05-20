<?php
session_start();
include 'config.php';

// ✅ Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Error: User not logged in.'); window.location.href='index.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID
$new_donation_date = !empty($_POST['new_donation_date']) ? $_POST['new_donation_date'] : NULL;

if (!$new_donation_date) {
    echo "<script>alert('Please select a valid date.'); window.history.back();</script>";
    exit();
}

// ✅ Check if the user is a registered donor
$check_query = "SELECT id FROM donors WHERE user_id = ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo "<script>alert('You are not registered as a donor.'); window.history.back();</script>";
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

// ✅ Update the last donation date
$update_query = "UPDATE donors SET last_donation_date = ?, updated_at = NOW() WHERE user_id = ?";
$stmt = $conn->prepare($update_query);
$stmt->bind_param("si", $new_donation_date, $user_id);

if ($stmt->execute()) {
    echo "<script>alert('Last donation date updated successfully!'); window.location.href='../home.php';</script>";
} else {
    echo "<script>alert('Error updating donation date. Try again.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
