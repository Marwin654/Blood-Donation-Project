<?php
session_start();
include 'config.php';

// ✅ Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Error: User not logged in.'); window.location.href='index.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID

// Fetch user email from users table
$email_query = "SELECT email FROM users WHERE id = ?";
$stmt = $conn->prepare($email_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

// Ensure email is retrieved
if (empty($email)) {
    echo "<script>alert('Error: Could not fetch email. Please try again.'); window.history.back();</script>";
    exit();
}

// Get form data with sanitization
$full_name = htmlspecialchars(strip_tags($_POST['full_name']));
$blood_type = htmlspecialchars(strip_tags($_POST['blood_type']));
$age = intval($_POST['age']); // Ensure age is an integer
$weight = intval($_POST['weight']); // Ensure weight is an integer
$gender = htmlspecialchars(strip_tags($_POST['gender']));
$contact_number = htmlspecialchars(strip_tags($_POST['contact_number']));
$city = htmlspecialchars(strip_tags($_POST['city']));
$state = htmlspecialchars(strip_tags($_POST['state']));
$country = htmlspecialchars(strip_tags($_POST['country']));
$last_donation_date = !empty($_POST['last_donation_date']) ? $_POST['last_donation_date'] : NULL;
$health_conditions = !empty($_POST['health_conditions']) ? htmlspecialchars(strip_tags($_POST['health_conditions'])) : NULL;

// Check if the user is already registered as a donor
$check_query = "SELECT id FROM donors WHERE user_id = ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('You are already registered as a donor.'); window.history.back();</script>";
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

// Insert donor data into the database
$insert_query = "INSERT INTO donors (user_id, full_name, email, blood_type, age, weight, gender, contact_number, city, state, country, last_donation_date, health_conditions, created_at, updated_at) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

$stmt = $conn->prepare($insert_query);
$stmt->bind_param("isssiiissssss", $user_id, $full_name, $email, $blood_type, $age, $weight, $gender, $contact_number, $city, $state, $country, $last_donation_date, $health_conditions);

if ($stmt->execute()) {
    echo "<script>alert('Donor registration successful!'); window.location.href='../home.php';</script>";
} else {
    echo "<script>alert('Error: Could not register. Please try again.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
