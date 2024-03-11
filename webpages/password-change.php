<?php
session_start();

// Function to change user password
function changePassword($currentPassword, $newPassword, $confirmPassword) {
    // Validate the current password (compare with the stored hashed password)
    $storedHashedPassword = password_hash("current_password123", PASSWORD_DEFAULT); // Replace with the actual hashed password from the database

    if (password_verify($currentPassword, $storedHashedPassword)) {
        // Validate the new password and confirm password
        if ($newPassword === $confirmPassword) {
            // New password and confirm password match
           
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            // Update the user's password 
            $_SESSION['user']['password'] = $newHashedPassword;

            return "Password changed successfully!";
        } else {
            return "New password and confirm password do not match!";
        }
    } else {
        return "Incorrect current password!";
    }
}

?>


<form method="post" action="change_password.php">
    <label for="currentPassword">Current Password:</label>
    <input type="password" id="currentPassword" name="currentPassword" required>
    <label for="newPassword">New Password:</label>
    <input type="password" id="newPassword" name="newPassword" required>
    <label for="confirmPassword">Confirm Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required>
    <button type="submit" name="changePassword">Change Password</button>
</form>
