<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // If admin is not logged in, redirect to admin login
    header("Location: admin-login.php");
    exit();
}

// Include your database connection logic here
$conn = new mysqli("your_server", "your_username", "your_password", "your_database");

// Check for a successful database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    // Retrieve the item_id from the form (replace with your actual input name)
    $item_id = $_POST['item_id'];

    // Delete the inventory item from the database
    $sql = "DELETE FROM inventory WHERE item_id = $item_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to inventory list or show a success message
        header("Location: admin-invetory.php");
        exit();
    } else {
        echo "Error deleting inventory item: " . $conn->error;
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
    <title>Delete Inventory Item</title>
</head>
<body>
    <h2>Delete Inventory Item</h2>

    <p>Are you sure you want to delete this inventory item?</p>

    <!-- Display item_id for confirmation (replace with actual item details) -->
    <p>Item ID: <?php echo $_GET['item_id']; ?></p>

    <!-- Add confirmation button -->
    <form method="post">
        <input type="hidden" name="item_id" value="<?php echo $_GET['item_id']; ?>">
        <button type="submit">Yes, Delete Inventory Item</button>
    </form>
</body>
</html>

