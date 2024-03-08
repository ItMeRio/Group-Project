<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/include.php") ?>
<link rel="stylesheet" href="../css/checkout.css">


</head>

<body>
<?php include_once("includes/navbar.php") ?>

<main>
<div class="main-content">

    <h1>Checkout</h1>

    <div class="checkout-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode" required>

        <label for="payment">Payment Information:</label>
        <input type="text" id="payment" name="payment" placeholder="Credit Card Number" required>

        <div class="subtotal">
            Subtotal:
            <button type="button">Confirm and Pay</button>
        </div>
    </div>

</div>
</main>
<?php include_once("includes/footer.php") ?>

</body>
</html>
