<?php
include 'connection.php'; // Include your database connection

$error_message = '';

try {
    $stmt = $conn->prepare("SELECT user_id, username, email FROM users WHERE account_type = 'customer'");
    $stmt->execute();
    $customers = $stmt->fetchAll();
} catch(PDOException $e) {
    $error_message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Customers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Management</h1>

        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?php echo htmlspecialchars($customer['username']); ?></td>
                <td><?php echo htmlspecialchars($customer['email']); ?></td>
                <td>
                    <a href="view_customer.php?user_id=<?php echo $customer['user_id']; ?>">View</a>
                    <a href="edit_customer.php?user_id=<?php echo $customer['user_id']; ?>">Edit</a>
                    <a href="delete_customer.php?user_id=<?php echo $customer['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <!-- Links for redirection -->
        <div class="redirect-links">
            <h3>Actions for Selected Customer:</h3>
            <form action="" method="get">
                <label for="user_id">Select Customer ID:</label>
                <select id="user_id" name="user_id">
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo $customer['user_id']; ?>">
                            <?php echo htmlspecialchars($customer['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button formaction="view_customer.php">View</button>
                <button formaction="edit_customer.php">Edit</button>
                <button formaction="delete_customer.php" onclick="return confirm('Are you sure?');">Delete</button>
            </form>
        </div>
    </div>
</body>
</html>

