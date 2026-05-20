<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['blood_type'])) {
    $blood_type = htmlspecialchars(strip_tags($_GET['blood_type']));

    // Check if "All Blood Types" is selected (empty value)
    if ($blood_type === "" || $blood_type === "All") {
        $query = "SELECT full_name, email,contact_number, blood_type, city, state FROM donors";
        $stmt = $conn->prepare($query);
    } else {
        $query = "SELECT full_name, email,contact_number, blood_type, city, state FROM donors WHERE blood_type = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $blood_type);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='donor-table'>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Blood Type</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Contact</th>
                    </tr>";

        while ($row = $result->fetch_assoc()) {
            $email = htmlspecialchars($row['email']);
            echo "<tr>
                    <td>" . htmlspecialchars($row['full_name']) . "</td>
                    <td>" . htmlspecialchars($row['blood_type']) . "</td>
                    <td>" . $email . "</td>
                    <td>" . htmlspecialchars($row['city']) . "</td>
                    <td>" . htmlspecialchars($row['state']) . "</td>
                    <td>
                        <a href='tel:+91" . $row['contact_number'] . "' class='contact-btn call-btn'>📞 Call</a>
                        <a href='mailto:" . $email . "' class='contact-btn email-btn'>📧 Email</a>
                    </td>
                </tr>";
        }
        echo "</table></div>";
    } else {
        echo "<p>No donors found.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Invalid request. Please try again.</p>";
}

$conn->close();
?>
