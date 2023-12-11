<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // If admin is not logged in, redirect to admin login
    header("Location: admin-login.php");
    exit();
}

//include database connection logic here
$conn = new mysqli("hostname", "username", "password", "database");

$customers = []; // Fetch customers from the database

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Customers</title>
<ul>
    <li><a href="add-customers.php">Add Customers</a></li>
    <li><a href="delete-customer.php">Delete Customers</a></li>
    <li><a href="edit-customer.php">Edit Customers</a></li>
</ul>  
</head>
<body>
    <h2>Manage Customers</h2>

    <!-- Customer list -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?php echo $customer['id']; ?></td>
                    <td><?php echo $customer['first_name']; ?></td>
                    <td><?php echo $customer['last_name']; ?></td>
                    <td><?php echo $customer['username']; ?></td>
                    <td>
                        <a href="edit-customer.php?id=<?php echo $customer['id']; ?>">Edit</a>
                        <a href="delete-customer.php?id=<?php echo $customer['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="add-customer.php">Add New Customer</a>
</body>
</html>
