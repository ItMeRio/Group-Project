<?php
include 'connection.php';

$error_message = '';
$success_message = '';
$customer = null;

// Fetch customer details for editing
if (isset($_GET['users_id'])) {
    $userId = $_GET['usesr_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE users_id = ? AND user_type = 'client'");
        $stmt->execute([$userId]);
        $customer = $stmt->fetch();

        if (!$customer) {
            header("Location: manage_customers.php");
            exit();
        }
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Handle Update Customer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    // Additional fields as necessary...

    try {
        $update_stmt = $conn->prepare("UPDATE users SET fullName = ?, email = ? WHERE user_id = ?");
        $update_stmt->execute([$username, $email, $userId]);
        $success_message = 'Customer updated successfully.';
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
</head>
<body>
    <div class="container">
        <h1>Edit Customer</h1>

        <!-- Display success/error messages -->
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <!-- Edit Customer Form -->
        <?php if ($customer): ?>
        <form method="post">
            <input type="hidden" name="users_id" value="<?php echo $customer['users_id']; ?>">

            <label for="fullName">fullName:</label>
            <input type="text" id="fullName" name="fullName" required
                   value="<?php echo htmlspecialchars($customer['fullName']); ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required
                   value="<?php echo htmlspecialchars($customer['email']); ?>">

            <button type="submit">Update Customer</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
