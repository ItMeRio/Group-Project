<?php
session_start();

// Redirect if not logged in or if the user is not an admin
if (!isset($_SESSION['account_type']) || $_SESSION['account_type'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Database Connection
require 'connection.php';

$error_message = '';
$success_message = '';

// Handle POST request for adding or deleting an admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        if ($action === 'add') {
            // Add new admin
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, account_type) VALUES (?, ?, ?, 'admin')");
            $insert_stmt->execute([$username, $email, $hashedPassword]);
            $success_message = 'Admin added successfully.';
        } elseif ($action === 'delete') {
            // Delete admin
            $adminId = $_POST['admin_id'];
            $delete_stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? AND account_type = 'admin'");
            $delete_stmt->execute([$adminId]);
            $success_message = 'Admin deleted successfully.';
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Fetch all admins
try {
    $stmt = $conn->prepare("SELECT user_id, username, email FROM users WHERE account_type = 'admin'");
    $stmt->execute();
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Admins</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 80%; margin: 20px auto; padding: 20px; background-color: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f0f0f0; }
        .error, .success { color: #d32f2f; margin-bottom: 15px; }
        .success { color: #388e3c; }
        label, input, button { display: block; margin-bottom: 10px; }
        input[type="text"], input[type="email"], input[type="password"] { padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Admins</h1>

        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo htmlspecialchars($admin['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($admin['username']); ?></td>
                    <td><?php echo htmlspecialchars($admin['email']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="admin_id" value="<?php echo $admin['user_id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Add New Admin</h2>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="hidden" name="action" value="add">
            <button type="submit">Add Admin</button>
        </form>
    </div>
</body>
</html>
