<?php
// Include database connection code here (e.g., $conn)
$conn = new mysqli("hostname", "username", "password", "database");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve customer details from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert the new customer into the database
    $sql = "INSERT INTO customers (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Customer added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customer</title>
</head>
<body>
    <h2>Add New Customer</h2>

    <!-- Add customer form -->
    <form method="post" action="add_customer.php">
        <!-- Add input fields for customer details (username, email, password, etc.) -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <!-- Add more input fields as needed (e.g., name, address, etc.) -->

        <button type="submit">Add Customer</button>
    </form>

</body>
</html>
