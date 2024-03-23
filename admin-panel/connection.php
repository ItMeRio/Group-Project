<?php
// Database credentials
$host = 'localhost';
$dbname = 'teamproject';
$username = 'root';
$password = ''; // the root password is empty

$connectionStatus = '';

try {
    // Create a PDO instance as db connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set a success message
    $connectionStatus = "Connected successfully";
}
catch(PDOException $e) {
    // Handle connection error
    $connectionStatus = "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Connection</title>
</head>
<body>
    <?php if (!empty($connectionStatus)): ?>
        <div id="connection-status"><?php echo $connectionStatus; ?></div>

        <script>
            setTimeout(function() {
                var statusElement = document.getElementById('connection-status');
                if (statusElement) {
                    statusElement.style.display = 'none';
                }
            }, 5000); // Hide the status message after 5 seconds
        </script>
    <?php endif; ?>

</body>
</html>

