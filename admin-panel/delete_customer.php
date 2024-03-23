<?php
include 'connection.php';

// Check if user_id is set in the URL
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    try {
        // Prepare and execute delete statement
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? AND account_type = 'customer'");
        $stmt->execute([$userId]);

        // Redirect to manage_customers.php with a success message
        header("Location: manage_customers.php?message=Customer+deleted+successfully");
        exit();
    } catch(PDOException $e) {
        // Redirect to manage_customers.php with an error message
        header("Location: manage_customers.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>

