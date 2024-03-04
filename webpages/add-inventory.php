<?php
// Include your database connection code here
$conn = new mysqli("hostname", "username", "password", "database");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve inventory information from the form
    $itemName = isset($_POST['item_name']) ? htmlspecialchars(trim($_POST['item_name'])) : '';
    $itemDescription = isset($_POST['item_description']) ? htmlspecialchars(trim($_POST['item_description'])) : '';
    $itemQuantity = isset($_POST['item_quantity']) ? intval($_POST['item_quantity']) : 0;

    // Validate and sanitize the input (implement your validation logic here)

    // Insert the inventory item into the inventory table
    $insertInventorySQL = "INSERT INTO inventory (item_name, item_description, item_quantity) 
                           VALUES ('$itemName', '$itemDescription', $itemQuantity)";

    if ($conn->query($insertInventorySQL) === TRUE) {
        echo "Inventory item added successfully!";
    } else {
        echo "Error adding inventory item: " . $conn->error;
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
    <title>Add Inventory Item</title>
</head>
<body>
    <h2>Add Inventory Item</h2>

    <form method="post">
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required>

        <label for="item_description">Item Description:</label>
        <textarea id="item_description" name="item_description" required></textarea>

        <label for="item_quantity">Item Quantity:</label>
        <input type="number" id="item_quantity" name="item_quantity" required>

        <button type="submit">Add Inventory Item</button>
    </form>
</body>
</html>
