<?php
include 'connection.php';

$error_message = '';
$customer = null;

// Fetch customer details
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ? AND account_type = 'customer'");
        $stmt->execute([$userId]);
        $customer = $stmt->fetch();

        if (!$customer) {
            $error_message = "No customer found with ID: " . htmlspecialchars($userId);
        }
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
} else {
    $error_message = "No customer ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Details</h1>

        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <?php if ($customer): ?>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($customer['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
            <!-- Add more customer details here -->
        <?php endif; ?>

        <a href="manage_customers.php">Back to Customer Management</a>
    </div>
</body>
</html>

