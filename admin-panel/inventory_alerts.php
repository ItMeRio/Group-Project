<?php
include 'connection.php'; // Ensure this points to your database connection file

// Define the low stock threshold
$lowStockThreshold = 10;

try {
    $stmt = $conn->prepare("SELECT product_id, product_name, stock_quantity FROM products ORDER BY stock_quantity ASC");
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .low-stock { color: red; }
        .inventory-table { 
            width: 100%; 
            max-height: 400px; 
            overflow-y: auto; 
            border-collapse: collapse; 
        }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Inventory Management</h1>
    <div class="inventory-table">
        <table>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Stock Quantity</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <tr class="<?php echo $product['stock_quantity'] <= $lowStockThreshold ? 'low-stock' : ''; ?>">
                <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                <td><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
