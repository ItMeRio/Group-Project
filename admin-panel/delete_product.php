<?php
include 'connection.php';

$productID = $_GET['product_id'];

try {
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->execute([$productID]);

    header('Location: manage_products.php');
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
