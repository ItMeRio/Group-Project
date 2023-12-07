<?php
session_start();

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add') {
        $productName = $_POST['productName'];
        $quantity = $_POST['quantity'];

        $item = [
            'productName' => $productName,
            'quantity' => $quantity
        ];

        array_push($_SESSION['basket'], $item);
    } elseif ($_POST['action'] === 'remove') {
        $productName = $_POST['productName'];

        // Remove the item from the basket based on the product name
        $_SESSION['basket'] = array_filter($_SESSION['basket'], function ($item) use ($productName) {
            return $item['productName'] !== $productName;
        });
    }
}

// Output the current basket content
foreach ($_SESSION['basket'] as $item) {
    echo '<div class="basket-item">' . $item['productName'] . ' - Quantity: ' . $item['quantity'] . '</div>';
}
?>
