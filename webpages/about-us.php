<?php 
include "connect.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("includes/include.php") ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        #mission-section {
            margin-bottom: 30px;
        }

        #mission-section h3 {
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        #mission-section p {
            color: #666;
            line-height: 1.6;
        }

        #review-section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        #review-section h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        #review-form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        #review-form textarea,
        #review-form input[type="number"],
        #review-form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #review-form textarea {
            height: 100px;
        }

        #review-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        #review-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include_once("includes/navbar.php") ?>
    <main>
        <h2>About Us</h2>

        <div id="mission-section">
            <h3>Mission Statement</h3>
            <p>We are committed to providing high-quality and fashionable shoes to our customers. Our mission is to make every step you take a stylish one. At Shoe Emporium, we believe that your footwear should not only be comfortable but also a statement of your unique style.</p>
        </div>

        <div id="review-section">
            <h2>Leave a Review</h2>
            <form id="review-form" action="submit_review.php" method="post">
                <label for="review">Your Review:</label><br>
                <textarea id="review" name="review" rows="4" cols="50" required></textarea><br>
                <label for="rating">Rating:</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required><br>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </main>
    <?php include_once("includes/footer.php") ?>
</body>

</html>

