<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    // If admin is already logged in, redirect to admin dashboard
    header("Location: admin-dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check login credentials (you should hash passwords in a real scenario)
    $username = $_POST['username'];
    $password = $_POST['password']; // Remember to hash this in a real scenario

    // Validate admin credentials (you should replace this with database validation)
    if ($username === 'admin' && $password === 'admin123') {
        // Set admin session
        $_SESSION['admin_id'] = 1; // You may use a unique identifier from your database

        // Redirect to admin dashboard
        header("Location: admin-dashboard.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    
    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br/><br/>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br/><br/>
        <button type="submit">Login</button>
    </form>
</body>
</html>

<?php ?>
