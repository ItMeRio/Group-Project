
<?php
require_once('connect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you receive productId and quantity as POST parameters
    $products_ID = $_POST['product_ID'];
    // You may need to adjust the following SQL query based on your database structure
    $sql = "INSERT INTO orderitems (order_item_ID,  products_ID, quantity, subtotal) VALUES (2,  $products_ID, 1 , (SELECT price FROM products WHERE products_ID = $products_ID))";

    if ($conn->query($sql) === TRUE) {
        echo 'Order item inserted successfully';
    } else {
        echo 'Error inserting order item: ' . $conn->error;
    }
} else {
    echo 'Invalid request method';
}
?>