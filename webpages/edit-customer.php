<?php
// Include your database connection code here
$conn = new mysqli("hostname", "username", "password", "database");

session_start();

// Assume you have a method to get customer details by ID
// Replace getCustomerDetailsById with your actual method
function getCustomerDetailsById($customerId) {
    global $conn;

    // Escape the customer ID to prevent SQL injection
    $customerId = mysqli_real_escape_string($conn, $customerId);

    // Query to retrieve customer details by ID
    $sql = "SELECT * FROM customers WHERE id = $customerId";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the customer details as an associative array
        $customerDetails = $result->fetch_assoc();

        // Free the result set
        $result->free_result();

        return $customerDetails;
    } else {
        // Handle query error (log, display an error message, etc.)
        echo "Error retrieving customer details: " . $conn->error;
        return null;
    }
}

// Check if a customer ID is provided in the URL
if (isset($_GET['id'])) {
    $customerId = intval($_GET['id']);
    $customerDetails = getCustomerDetailsById($customerId);

    if (!$customerDetails) {
        echo "Customer not found!";
        // You might want to include a link to go back to the customers list or do something else
        exit();
    }
} else {
    echo "Customer ID not provided!";
    // You might want to include a link to go back to the customers list or do something else
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated customer information from the form
    $updatedUsername = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';
    $updatedEmail = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    // Add other fields as needed

    // Validate and sanitize the input (implement your validation logic here)

    // Update the customer details in the database
    $updateCustomerSQL = "UPDATE customers 
                          SET username = '$updatedUsername', email = '$updatedEmail'
                          WHERE id = $customerId";

    if ($conn->query($updateCustomerSQL) === TRUE) {
        echo "Customer details updated successfully!";
    } else {
        echo "Error updating customer details: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>
<body>
    <h2>Edit Customer</h2>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $customerDetails['username']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $customerDetails['email']; ?>" required>
        <!-- Add other input fields for additional customer details -->

        <button type="submit">Update Customer</button>
    </form>
</body>
</html>

