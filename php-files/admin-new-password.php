<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the new password from the form
    $newPassword = $_POST['new_password'];

    // Validate and process the new password (you should hash passwords in a real scenario)
    // For simplicity, we'll just display a success message here

    // Display a success message
    $successMessage = "Password changed successfully!";
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

    <?php if (isset($successMessage)) : ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <button type="submit">Change Password</button>
    </form>
</body>
</html>
