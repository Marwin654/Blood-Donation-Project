<?php
include 'config.php'; // Ensure this file contains your database connection

// Fetch active blood drives (excluding expired ones)
$sql = "SELECT * FROM bloodpromote WHERE date >= CURDATE() ORDER BY date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Blood Drives</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .drive {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .drive:last-child {
            border-bottom: none;
        }
        .drive h3 {
            margin: 0;
            color: #d9534f;
        }
        .drive p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upcoming Blood Drives</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="drive">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
                    <p><strong>Time:</strong> <?php echo $row['time']; ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                    <p><strong>Contact:</strong> <?php echo htmlspecialchars($row['contact']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No upcoming blood drives.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
