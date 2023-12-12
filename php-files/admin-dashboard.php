<?php
session_start();

//if (!isset($_SESSION['admin_id'])) {
    //If admin is not logged in, redirect to admin login
    //header("Location: admin-login.php");
    //exit();
//}
//?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
  </head>
  <body>
    <h2>Welcome to the Admin Dashboard</h2>

    <!-- Links for the admin dashboard -->
    <ul>
      <li><a href="admin-products.php">Manage Products</a></li>
      <li><a href="admin-customers.php">Manage Customers</a></li>
      <li><a href="admin-orders.php">Manage Orders</a></li>
      <li><a href="admin-inventory.php">Inventory Management</a></li>
      <li><a href="admin-new-password.php">Change Password</a></li>
      <li><a href="admin-login.php">Login</a></li>
      <li><a href="admin-logout.php">Logout</a></li>
      <li><a href="notifications.php">Notifications</a></li>
    </ul>
  </body>
</html>
