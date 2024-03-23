<?php
// Connect to database using PDO
include 'connection.php'; // Assuming 'connection.php' contains your database connection code

$error_message = '';
$success_message = '';

// Registration process
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type']; // 'customer' or 'admin'

    try {
        // Check if the username or email already exists
        $stmt = $conn->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->rowCount() > 0) {
            $error_message = "Username or Email already exists.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new account with the hashed password
            $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, account_type) VALUES (?, ?, ?, ?)");
            $insert_stmt->execute([$username, $email, $hashedPassword, $account_type]);
            $success_message = "Account registered successfully!";
        }
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Registration</title>
</head>
<body>
    <h2>Account Registration</h2>

    <?php if ($success_message) : ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if ($error_message) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br/><br/>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br/><br/>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br/><br/>
        <label for="account_type">Account Type:</label>
        <select id="account_type" name="account_type" required>
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
        </select><br/><br/>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
