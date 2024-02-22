<?php
require_once('connect.php');

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // Modify the SQL query to include a WHERE clause for searching
    $sql = "SELECT products_ID, product_name, price, img, color, brand FROM products WHERE product_name LIKE '%$search%'";

} else {
    // Default query without search filter
    $sql = "SELECT products_ID, product_name, price, img, color, brand FROM products";
}

$result_products = $conn->query($sql); // Store the result in a different variable

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>

    <style>
       body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    font-size: 16px;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1em 0;
}

nav {
    display: flex;
    justify-content: flex-start;
    background-color: #333;
    padding: 1em 0;
}

nav a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    margin-right: 20px;
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

/* Add a media query for smaller screens */
@media only screen and (max-width: 768px) {
    #top-right {
        flex-direction: column; /* Stack items vertically */
        align-items: flex-end; /* Align items to the right */
    }

    #basket-icon,
    #user-account {
        margin-left: 0; /* Remove margin to avoid escaping the page */
        margin-top: 5px; /* Add some top margin for separation */
    }
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
    width: 100%; /* Full width */
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

#product-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    min-height: 300px;
    margin: 0 auto;
    max-width: 1200px;
}

.product {
    width: calc(33.33% - 20px);
    height: 300px;
    margin: 10px;
    padding: 10px;
    border: 1px solid #000;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: #000;
    color: #fff;
    box-sizing: border-box;
}

.product img {
    max-width: 100%;
    max-height: 50%;
    margin-bottom: 10px;
}

.product h5,
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
    width: 100%;
}


        @media only screen and (max-width: 1200px) {
            .product {
                width: calc(50% - 20px);
            }
        }

        @media only screen and (max-width: 768px) {
            #product-container {
                justify-content: center;
            }

            .product {
                max-width: 80%;
            }

            .product img {
                max-height: 40%;
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
        <form method="GET" action="">
            <input type="text" id="search-bar" name="search" class="input" placeholder="Search...">
            <button type="submit" id="search-btn">Search</button>
        </form>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <h5>Filter Products</h5>
                <hr>
                <h6 class="text-info">Select Brand</h6>
                <ul class="list-group">
                    <?php
                    $sql_brands = "SELECT DISTINCT brand FROM products ORDER BY brand";
                    $result_brands = $conn->query($sql_brands);

                    while ($row = $result_brands->fetch_assoc()) {
                    ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check" value="<?= $row['brand']; ?>" id="brand<?= $row['brand']; ?>"> <?= $row['brand']; ?>
                                </label>
                            </div>
                        </li>
                    <?php } ?>
                </ul>

                <h6 class="text-info">Select Color</h6>
                <ul class="list-group">
                    <?php
                    $sql_color = "SELECT DISTINCT color FROM products ORDER BY color";
                    $result_color = $conn->query($sql_color);

                    while ($row = $result_color->fetch_assoc()) {
                    ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input color_check" value="<?= $row['color']; ?>" id="color<?= $row['color']; ?>"> <?= $row['color']; ?>
                                </label>
                            </div>
                        </li>
                    <?php } ?>
                </ul>

            </div>
            <div class="col-lg-9">

                <section>
                    <h2>Featured Products</h2>
                    <?php
echo '<div id="product-container">'; // Start the container outside the loop

$counter = 0;

while ($row = mysqli_fetch_assoc($result_products)) {
    // Product inside a row
    echo '<div class="product" data-brand="' . $row["brand"] . '" data-color="' . $row["color"] . '">';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '"/>';
    echo '<h5 class="name">' . $row["product_name"] . '</h5>';
    echo '<p class="details">' . $row["brand"] . ', ' . $row["color"] . '</p>';
    echo '<p>' . $row["price"] . ' £</p>';
    echo '<form method="POST" action="insert_order_item.php">';
    echo '<input type="hidden" name="product_ID" value="' . $row["products_ID"] . '">';
    echo '<button class="add-to-cart" data-product-id=" '. $row["products_ID"] .' " data-quantity="1">Add to Cart</button>';
    echo '</form>';
    echo '</div>'; 

    $counter++;

    // Check if three products are displayed, then start a new row
    if ($counter % 3 == 0) {
        echo '</div><div id="product-container">'; // Close and reopen the container
    }
}

echo '</div>'; // Close the container after the loop
?>

                </section>
            </div>
        </div>
    </div>
 
    <script>
    $(document).ready(function () {
        // Function to filter products based on selected checkboxes
        function filterProducts() {
            var selectedBrands = $('.product_check:checked').map(function () {
                return $(this).val();
            }).get();

            var selectedColors = $('.color_check:checked').map(function () {
                return $(this).val();
            }).get();

            // Hide all products
            $('.product').hide();

            // Show only products that match the selected filters
            $('.product').each(function () {
                var brand = $(this).data('brand');
                var color = $(this).data('color');

                if ((selectedBrands.length === 0 || selectedBrands.includes(brand)) &&
                    (selectedColors.length === 0 || selectedColors.includes(color))) {
                    $(this).show();
                }
            });
        }

        // Call the filter function on checkbox change
        $('.product_check, .color_check').change(function () {
            filterProducts();
        });

        // Call the filter function on page load
        filterProducts();
    });

    $(document).ready(function () {
    $(document).on('click', '.add-to-cart', function () {
        var products_ID = $(this).data('product_ID');
        var quantity = $(this).data('quantity');

        console.log('Adding to cart:', products_ID, 'Quantity:', quantity);

        // Increment the quantity
        quantity++;

        // Update the data-quantity attribute
        $(this).data('quantity', quantity);

        // Send an AJAX request to update the quantity on the server
        $.ajax({
            type: 'POST',
            url: 'update_quantity.php', // Replace with the actual URL of your server-side script
            data: {
                products_ID: products_ID,
                quantity: quantity
            },
            success: function (response) {
                console.log('Server response:', response);
                // You can update the UI or perform additional actions based on the server response
            },
            error: function (error) {
                console.error('Error updating quantity:', error);
            }
        });
    });
});



</script>

</body>

</html>
