<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Error: User not logged in.'); window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promote Blood Drive</title>
    <link rel="stylesheet" href="css/promote_drive.css">
</head>
<body>

    <div class="container">
        <h2>Promote Your Blood Drive</h2>

        <form action="php/blood_drive.php" method="POST">
            <label for="title">Drive Organizer:</label>
            <input type="text" id="title" name="title" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="contact">Contact Number:</label>
            <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" placeholder="Enter contact number (10 digits)" required>

            <label for="description">Description(Organizer Name,landmark):</label>
            <textarea id="description" name="description" rows="3" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        // Prevent past dates
        document.getElementById("date").min = new Date().toISOString().split("T")[0];
    </script>

</body>
</html>
