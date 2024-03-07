<?php

$orderNumber = 123456;
$totalPrice = 99.99;
$customerName = "John Doe";
$shippingAddress = "123 Main St, Cityville";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>

</head>
<body>

<h2>Order Confirmation</h2>

<p>Thank you, <?php echo $customerName; ?>, for your purchase!</p>

<p>Your order number is: <?php echo $orderNumber; ?></p>

<p>Shipping Address: <?php echo $shippingAddress; ?></p>

<p>Total Price: $<?php echo number_format($totalPrice, 2); ?></p>

<a href="home page.html">Continue Shopping</a>

</body>
</html>
