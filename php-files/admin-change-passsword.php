<?php
// Simulating database connection
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "your_db_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to simulate checking admin credentials (replace with your actual authentication logic)
function authenticateAdmin($username, $password)
{
    global $conn;

    // Escape user inputs to prevent SQL injection (use parameterized queries for better security)
    $escapedUsername = $conn->real_escape_string($username);

    // Fetch admin details from the database
    $sql = "SELECT * FROM admins WHERE username = '$escapedUsername'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $adminData = $result->fetch_assoc();

        // Verify the provided password against the hashed password in the database
        if (password_verify($password, $adminData['password'])) {
            // Authentication successful
            return true;
        }
    }

    // Authentication failed
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $adminUsername = $_POST['admin_username'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    // Validate form data (perform additional validation as needed)

    // Check if the provided credentials match the admin's credentials
    if (authenticateAdmin($adminUsername, $currentPassword)) {
        // Update the admin's password in the database
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password

        // Perform the database update (replace with your actual update query)
        $sql = "UPDATE admins SET password = '$passwordHash' WHERE username = '$adminUsername'";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Password changed successfully.";
        } else {
            $errorMessage = "Error updating password: " . $conn->error;
        }
    } else {
        $errorMessage = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Change Password</title>
</head>
<body>
    <h2>Admin Change Password</h2>

    <?php if (isset($errorMessage)) : ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <?php if (isset($successMessage)) : ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="admin_username">Admin Username:</label>
        <input type="text" id="admin_username" name="admin_username" required>

        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <button type="submit">Change Password</button>
    </form>
</body>
</html>
