<?php
//Include your database connection code here
$conn = new mysqli("hostname", "username", "password", "database");

session_start();

function getInventoryDetailsById($itemId) {
    global $conn;

    $itemId = mysqli_real_escape_string($conn, $itemId);

    // Query to retrieve inventory details by ID
    $sql = "SELECT * FROM inventory WHERE item_id = $itemId";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the inventory details as an associative array
        $inventoryDetails = $result->fetch_assoc();

        $result->free_result();

        return $inventoryDetails;
    } else {
        // Handle query error
        echo "Error retrieving inventory details: " . $conn->error;
        return null;
    }
}


if (isset($_GET['id'])) {
    $inventoryId = intval($_GET['id']);
    $inventoryDetails = getInventoryDetailsById($inventoryId);

    if (!$inventoryDetails) {
        echo "Inventory item not found!";
     
        exit();
    }
} else {
    echo "Inventory item ID not provided!";
  
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated inventory item information from the form
    $updatedItemName = isset($_POST['item_name']) ? htmlspecialchars(trim($_POST['item_name'])) : '';
    $updatedItemDescription = isset($_POST['item_description']) ? htmlspecialchars(trim($_POST['item_description'])) : '';
    $updatedItemQuantity = isset($_POST['item_quantity']) ? intval($_POST['item_quantity']) : 0;
  

    // Update the inventory item details in the database
    $updateInventorySQL = "UPDATE inventory 
                           SET item_name = '$updatedItemName', 
                               item_description = '$updatedItemDescription',
                               item_quantity = $updatedItemQuantity
                           WHERE id = $inventoryId";

    if ($conn->query($updateInventorySQL) === TRUE) {
        echo "Inventory item details updated successfully!";
    } else {
        echo "Error updating inventory item details: " . $conn->error;
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
    <title>Edit Inventory Item</title>
</head>
<body>
    <h2>Edit Inventory Item</h2>

    <form method="post">
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" value="<?php echo $inventoryDetails['item_name']; ?>" required>

        <label for="item_description">Item Description:</label>
        <textarea id="item_description" name="item_description" required><?php echo $inventoryDetails['item_description']; ?></textarea>

        <label for="item_quantity">Item Quantity:</label>
        <input type="number" id="item_quantity" name="item_quantity" value="<?php echo $inventoryDetails['item_quantity']; ?>" required>
        

        <button type="submit">Update Inventory Item</button>
    </form>
</body>
</html>

