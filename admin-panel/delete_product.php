<?php
include 'connection.php';

$productID = $_GET['products_ID'];

try {
    $stmt = $conn->prepare("DELETE FROM products WHERE product_ID = ?");
    $stmt->execute([$productID]);

    header('Location: manage_products.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
