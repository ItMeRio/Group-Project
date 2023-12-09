<?php

require_once ('connect.php');

$sql = "SELECT product_name, price, img FROM products";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page - Shoe Emporium</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em 0;
        }

        nav {
            display: flex;
            justify-content: flex-start; /* Align headers to the left */
            background-color: #333;
            padding: 1em 0;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            margin-right: 20px; /* Adjust the right margin as needed */
        }

        #top-right {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
        }

        #basket-icon,
        #user-account {
            margin-left: 10px;
        }

        #search-container {
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }

        #search-bar {
            width: 80%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        #search-btn {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        section {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #product-container {
            display: flex;
            overflow: hidden;
            justify-content: space-around;
            flex-wrap: wrap;
            height: 22vh; /* Adjust the height as needed */
        }

        .product {
            width: 200px;
            height: 250px; /* Adjusted height for more content */
            margin: 10px;
            padding: 10px;
            border: 1px solid #000; /* Black border */
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Added space between content */
            background-color: #000; /* Black background */
            color: #fff; /* White text color */
        }

        .product img {
            max-width: 100%;
            max-height: 60%; /* Adjusted height for the image */
            margin-bottom: 10px; /* Added margin below the image */
        }

        .product h3,
        .product p {
            margin: 0;
        }

        .product button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media only screen and (max-width: 768px) {
        #product-container {
            flex-direction: column; /* Change to a column layout on smaller screens */
            align-items: center;
        }

        .product {
            width: 80%; /* Adjust the width for better responsiveness on smaller screens */
        }
    }
    </style> 
        
</head>

<body>

    <header>
        <h1>Shoe Emporium</h1>
        <nav>
            <a href="#">Home</a>
            <a href="#">Products</a>
            <a href="#">Contact Us</a>
            <a href="#">About Us</a>
            <a href="#">Log In</a>
            <a href="#">User</a>
            <a href="#">Basket</a>
        </nav>
        <div id="top-right">
            <div id="basket-icon">🛒</div>
            <div id="user-account">User Account</div>
        </div>
    </header>

    <div id="search-container">
        <input type="text" id="search-bar" class="input" placeholder="Search...">
        <button id="search-btn">Search</button>
    </div>

    <section>
        <h2>Featured Products</h2>
        
        <?php
echo '<div id="product-container">'; // Start the container outside the loop

$counter = 0;

while($row = mysqli_fetch_assoc($result)) {
    // Product inside a row
    echo '<div class="product">';
    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'"/>';
    echo '<h3 class="name">'.$row["product_name"].'</h3>';
    echo '<p>'.$row["price"].'</p>';
    echo '<button>Add to Cart</button>';
    echo '</div>'; // Close the product div

    $counter++;

    // Check if four products are displayed, then start a new row
    if ($counter % 4 == 0) {
        echo '</div><div id="product-container">'; // Close and reopen the container
    }
}

echo '</div>'; // Close the container after the loop
?>
    </section>

</body>

</html>