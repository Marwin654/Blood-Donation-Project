<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
    <link rel="stylesheet" href="css/donor_style.css">
</head>
<body>

    <div class="container">
        <h2>Donor Registration Form</h2>

        <!-- Donor Registration Form -->
        <form action="php/register_donor.php" method="POST">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="blood_type">Blood Type:</label>
            <select id="blood_type" name="blood_type" required>
                <option value="">Select Blood Type</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="18" max="65" required>

            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" min="50" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="contact_number">Contact Number:</label>
            <input type="tel" id="contact_number" name="contact_number" pattern="[0-9]{10}" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="India" required>

            <label for="last_donation_date">Last Donation Date:</label>
            <input type="date" id="last_donation_date" name="last_donation_date">

            <label for="health_conditions">Health Conditions (if any):</label>
            <textarea id="health_conditions" name="health_conditions" rows="2"></textarea>

            <button type="submit">Register as Donor</button>
        </form>

        <!-- NEW: Separate Update Form -->
        <form action="php/update_donation_date.php" method="POST">
            <h2>Update Last Donation Date</h2>

            <label for="new_donation_date">New Donation Date:</label>
            <input type="date" id="new_donation_date" name="new_donation_date" required>

            <button type="submit">Update</button>
        </form>

        <script>
            // Prevent future dates for donation fields
            document.getElementById("last_donation_date").max = new Date().toISOString().split("T")[0];
            document.getElementById("new_donation_date").max = new Date().toISOString().split("T")[0];
        </script>
    </div>
</body>
</html>
