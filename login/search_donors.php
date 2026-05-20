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
    <title>Search Donors</title>
    <link rel="stylesheet" href="css/searchdonor.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- ✅ Include jQuery -->
</head>
<body>

    <div class="container">
        <h2>Search for Blood Donors</h2>
        
        <!-- Search Form -->
        <form id="searchForm">
            <label for="blood_type">Select Blood Type:</label>
            <select id="blood_type" name="blood_type" required>
                <option value="All">All Blood Types</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>

            <button type="submit">Search</button>
        </form>

        <h3>Available Donors</h3>
        <div id="results">
            <!-- Results will be displayed here dynamically -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#searchForm").submit(function(e) {
                e.preventDefault(); // Prevent form from refreshing the page

                var bloodType = $("#blood_type").val(); // Get selected blood type

                $.ajax({
                    url: "php/process_search.php",
                    type: "GET",
                    data: { blood_type: bloodType },
                    beforeSend: function() {
                        $("#results").html("<p>Loading...</p>");
                    },
                    success: function(response) {
                        $("#results").html(response); // Insert search results into the page
                    },
                    error: function() {
                        $("#results").html("<p>Something went wrong. Try again.</p>");
                    }
                });
            });
        });
    </script>

</body>
</html>
