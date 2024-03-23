<?php
include 'connection.php';

// Check if order_id is set in the URL
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    try {
        // Start transaction
        $conn->beginTransaction();

        // Delete order items first to maintain referential integrity
        $stmtItems = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
        $stmtItems->execute([$orderId]);

        // Delete the order
        $stmtOrder = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmtOrder->execute([$orderId]);

        // Commit transaction
        $conn->commit();

        $message = "Order successfully deleted.";
    } catch(PDOException $e) {
        // If there is an error, rollback transaction
        $conn->rollBack();
        $message = "Error deleting order: " . $e->getMessage();
    }
} else {
    $message = "No order ID provided.";
}

// Redirect to manage_orders.php with a message
header("Location: manage_orders.php?message=" . urlencode($message));
exit();
?>
