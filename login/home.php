<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Line</title>
    <link rel="stylesheet" href="css/styleshome.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header>
    <h1 align="left">BloodLine</h1>
    <nav>
        <div class="nav-links">
            <ul>
                <li><a href="#top">Home</a></li>
                <li><a href="search_donors.php">Find Donors</a></li>
                <li><a href="register_donors.php">Become a Donor</a></li>
                <li><a href="blood_drive_subm.php">Promote Your Blood Drives</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><form action="php/logout.php" method="POST" class="logout-form">
                <button type="submit" class="logout-btn">Logout</button>
            </form></li>
            </ul>
            
        </div>
    </nav>
</header>


    <!-- Hero Section -->
    <div class="hero-section">
    <div class="hero-text">
   
            <h1>🩸BloodLine</h1>
            <p> 
            BloodLine is a platform that connects blood donors with those in need.<br> 
            It allows users to register as donors, search for donors based on blood type, and promote blood drives..<br>
             Organizers can submit blood drive details, which are displayed for the community..<br>
              The platform ensures seamless communication between donors and recipients, encouraging life-saving donations. 
        </p>
    </div>
    <div class="hero-image">
        <img src="blood.png" alt="Blood Donation">
    </div>
</div>

<br>
    <!-- More About Blood Line -->
    <section class="Donate">
        <p> 
        <h1>Donate <span style="color:red;">Blood</span>, Save Lives</h1>
        <br>
        Find a donor or become one today.
        </p>
        <br>
        <br>
        <p>
       <a href="search_donors.php" class="ba">Find Donors</a>
          <a href="register_donors.php" class="ba">Become a Donor</a>
        
        </p>
    </section>
    <br> 
    <section class="urgent-requests">
    <h2>Urgent Blood Requests</h2>
    <div class="requests-container">
        <?php
        include 'php/config.php';

        $query = "SELECT name, blood_type, location, contact, message, created_at FROM urgent_requests ORDER BY created_at DESC LIMIT 5";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='request-card'>";
                echo "<h3>" . htmlspecialchars($row['name']) . " needs " . htmlspecialchars($row['blood_type']) . " blood</h3>";
                echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                echo "<p><strong>Contact:</strong> " . htmlspecialchars($row['contact']) . "</p>";
                echo "<p>" . htmlspecialchars($row['message']) . "</p>";
                echo "<p class='request-time'>" . date("F j, Y, g:i a", strtotime($row['created_at'])) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No urgent blood requests at the moment.</p>";
        }
        $conn->close();
        ?>
    </div>
</section>
 <br> 
<br>
<h2>Post an Urgent Blood Request</h2>
<form action="php/submit_request.php" method="POST" class="request-form">
    <input type="text" name="name" placeholder="Your Name" required>
    <select name="blood_type" required>
        <option value="">Select Blood Type</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
    </select>
    <input type="text" name="location" placeholder="Location" required>
    <input type="text" name="contact" placeholder="Contact Number"pattern="[0-9]{10}" required>
    <textarea name="message" placeholder="Describe your urgency" required></textarea>
    <button type="submit">Submit Request</button>
</form>

<br>
    <!-- Blood Drives Section -->
    <section class="blood-drives">
        <h2 align="left" class="h1driveh">Upcoming Blood Drives Near You: </h2>

        <?php
        include 'php/config.php';
        $query = "SELECT title, date, time, location, contact, description FROM blood_drives ORDER BY created_at DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<div class='blood-drive-container'>";
            echo "<div class='blood-drive-wrapper'>"; // Wrapper for horizontal scrolling
            while ($row = $result->fetch_assoc()) {
                echo "<div class='blood-drive-card'>
                        <h3>" . htmlspecialchars($row['title']) . "</h3>
                        <p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>
                        <p><strong>Time:</strong> " . htmlspecialchars($row['time']) . "</p>
                        <p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>
                        <p><strong>Contact:</strong> " . htmlspecialchars($row['contact']) . "</p>
                        <p>" . htmlspecialchars($row['description']) . "</p>
                    </div>";
            }
            echo "</div>"; // Close wrapper
            echo "</div>"; // Close container
        } else {
            echo "<p>No upcoming blood drives.</p>";
        }

        $conn->close();
        ?>
    </section>
    <section >
<div class="ydonate">
<h2>Why Donate?</h2>
<p>
    <ul class="why_donate">
 <li><b style="color:black">Saves Lives:</b> 
Every donation can help up to three people in need of blood transfusions due to accidents, surgeries, or medical conditions. 
<br>
 <li><b style="color:black">Promotes Heart Health:</b>
Regular blood donation helps reduce iron levels, which may lower the risk of heart disease and stroke.  
<br>
<li><b style="color:black">Improves Blood Circulation:</b>
Donating blood stimulates new blood cell production, keeping your blood fresh and healthy.  
<br>
<li><b style="color:black">Reduces the Risk of Certain Diseases:</b> 
Studies suggest that regular blood donation may lower the risk of cancer and other illnesses linked to high iron levels.  
<br>
<li><b style="color:black">Free Health Check-Up: </b> 
Before donating, you get a mini health check, including blood pressure, hemoglobin levels, and other vital signs.  
<br>
<li><b style="color:black">Burns Calories:</b>
A single donation burns up to 650 calories, making it a small but healthy metabolic boost.  
<br>
<li><b style="color:black">Encourages Community Giving:</b>
By donating, you become a lifesaver and inspire others to do the same, creating a stronger, healthier community.  
</ul>
</p>
</div>
</section>

   <!-- Testimonials Section -->
   <section class="testimonial-section" id="testimonials">
    <h2>Testimonials</h2>
    <div class="testimonial-wrapper">
        <?php
        include 'php/config.php';
        $query = "SELECT name, message,created_at FROM testimonials ORDER BY created_at DESC";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='testimonial-card'>";
                echo "<p><strong>" . htmlspecialchars($row['name']) . ":</strong> " . htmlspecialchars($row['message']) . "</p>";
                echo "<p class='testimonial-time'>" . date("F j, Y,g:i a", strtotime($row['created_at'])) . "</p>"; // Date on new line
                echo "</div>";
            }
        } else {
            echo "<p>No testimonials yet. Be the first to share your experience!</p>";
        }
        $conn->close();
        ?>
    </div>
    <br><br>

    <!-- Submit Testimonial Form -->
    <h2>Share Your Experience</h2>
    <form action="php/submit_testimonial.php" method="POST" class="testimonial-form">
        <input type="text" name="name" placeholder="Your Name" required>
        <textarea name="message" placeholder="Your Testimonial" required></textarea>
        <button type="submit">Submit</button>
    </form>
</section>
<div class="faq-section">
    <h2>Frequently Asked Questions (FAQs)</h2>

    <div class="faq">
        <h3>1. What is this website about?</h3>
        <p>This website connects blood donors with those in need. It allows users to <strong>register as donors</strong>, <strong>search for donors</strong>, and <strong>promote blood drives</strong>.</p>
    </div>

    <div class="faq">
        <h3>2. How do I register as a blood donor?</h3>
        <p>Log in to your account and fill out the <strong>Donor Registration Form</strong> with your details, including blood type, age, contact number, and last donation date.</p>
    </div>

    <div class="faq">
        <h3>3. How do I find a blood donor?</h3>
        <p>Click on the <a href="search_donors.php">"Find Donors"</a> button and enter the required details such as blood type and location. The system will show a list of available donors.</p>
    </div>

    <div class="faq">
        <h3>4. Who can donate blood?</h3>
        <p>You can donate blood if you:</p>
        <ul>
            Are <strong>between 18 and 65 years old</strong><br>
            Weigh at least <strong>50 kg (110 lbs)</strong><br>
            Are in <strong>good health</strong> without infections or serious conditions<br>
        </ul>
    </div>

    <div class="faq">
        <h3>5. How often can I donate blood?</h3>
        <p><strong>Whole blood:</strong> Every <strong>3 months</strong> (for men) and <strong>4 months</strong> (for women).<br>
           <strong>Platelets & plasma:</strong> Every <strong>2-4 weeks</strong>.</p>
    </div>

    <div class="faq">
        <h3>6. How do I update my last donation date?</h3>
        <p>Log in to your account and go to the <strong>Update Last Donation Date</strong> section to enter your latest donation date.</p>
    </div>

    <div class="faq">
        <h3>7. How do I promote a blood drive?</h3>
        <p>Organizers can submit a <strong>Blood Drive Promotion Form</strong> with event details. It will be displayed on the homepage.</p>
    </div>

    <div class="faq">
        <h3>8. How do I contact a donor?</h3>
        <p>Once you find a donor, you can <strong>view their contact details</strong> and reach out to them directly.</p>
    </div>

    <div class="faq">
        <h3>9. Is my personal information safe?</h3>
        <p>Yes, we <strong>do not share your personal data</strong> with third parties. Your contact details are only visible to users searching for donors.</p>
    </div>
</div>


    <script src="script.js"></script>
</body>
</html>
