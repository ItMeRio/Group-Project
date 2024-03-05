<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/include.php") ?>
<link rel="stylesheet" href="../css/baskets.css">


</head>
<body>
<?php include_once("includes/navbar.php") ?>


<main>
<div class="main-content">

    <h1>Previous orders</h1>

    <div class="product">
        Product 1 + Details
        <button class="add-review-button" onclick="showReviewForm('product1')">Add Review</button>
        <form class="add-review-form" id="reviewFormProduct1">
            <label for="reviewProduct1">Review:</label>
            <input type="text" id="reviewProduct1" name="reviewProduct1">
            <button type="button" onclick="submitReview('product1')">Submit Review</button>
        </form>
    </div>

    <div class="product">
        Product 2 + Details
        <button class="add-review-button" onclick="showReviewForm('product2')">Add Review</button>
        <form class="add-review-form" id="reviewFormProduct2">
            <label for="reviewProduct2">Review:</label>
            <input type="text" id="reviewProduct2" name="reviewProduct2">
            <button type="button" onclick="submitReview('product2')">Submit Review</button>
        </form>
    </div>

    <div class="product">
        Product 3 + Details
        <button class="add-review-button" onclick="showReviewForm('product3')">Add Review</button>
        <form class="add-review-form" id="reviewFormProduct3">
            <label for="reviewProduct3">Review:</label>
            <input type="text" id="reviewProduct3" name="reviewProduct3">
            <button type="button" onclick="submitReview('product3')">Submit Review</button>
        </form>
    </div>

    <button class="back-to-basket-button" onclick="window.location.href='basket-page.php'">Back to Basket</button>

</div>

<script src="baskets.js"></script>

</main>
<?php include_once("includes/footer.php") ?>

</body>
</html>
