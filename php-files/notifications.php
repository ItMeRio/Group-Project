<?php
// Include database connection code here (e.g., $conn)

// Fetch email notifications from the database
$sql = "SELECT * FROM notifications ORDER BY created_at DESC"; // Assuming you have a 'notifications' table
$result = $conn->query($sql);

$notifications = ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : array();

// Close the database connection (e.g., $conn->close())
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Notifications</title>
    <!-- Include any additional styles or scripts if necessary -->
</head>
<body>

<h2>Email Notifications</h2>

<?php if (!empty($notifications)) : ?>
    <ul>
        <?php foreach ($notifications as $notification) : ?>
            <li>
                <strong>Date:</strong> <?php echo $notification['created_at']; ?><br>
                <strong>Subject:</strong> <?php echo $notification['subject']; ?><br>
                <strong>Message:</strong> <?php echo $notification['message']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No email notifications.</p>
<?php endif; ?>

<!-- Add any additional content or navigation as needed -->

</body>
</html>
