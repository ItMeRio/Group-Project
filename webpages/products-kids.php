<?php
require_once('connect.php');

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // Modify the SQL query to include a WHERE clause for searching
    $sql = "SELECT products_ID, product_name, price, img, color, brand, categories, section FROM products WHERE product_name LIKE '%$search%' AND categories = 'Kids Clothing'";

} else {
    // Default query without search filter
    $sql = "SELECT products_ID, product_name, price, img, color, brand, categories, section FROM products WHERE categories = 'Kids Clothing'";
}

$result_products = $conn->query($sql); // Store the result in a different variable

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("includes/include.php") ?>

</head>

<body>

    <?php include_once("includes/navbar.php") ?>

    <main>

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
                                        <input type="checkbox" class="form-check-input product_check"
                                            value="<?= $row['brand']; ?>" id="brand<?= $row['brand']; ?>">
                                        <?= $row['brand']; ?>
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
                                        <input type="checkbox" class="form-check-input color_check"
                                            value="<?= $row['color']; ?>" id="color<?= $row['color']; ?>">
                                        <?= $row['color']; ?>
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
                            echo '<div class="product" data-brand="' . $row["brand"] . '" data-color="' . $row["color"] . '" data-categories="' . $row["categories"] . '">';
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '"/>';
                            echo '<h5 class="name">' . $row["product_name"] . '</h5>';
                            echo '<p class="details">' . $row["brand"] . ', ' . $row["color"] . '</p>';
                            echo '<p>£' . $row["price"] . '</p>';
                            echo '<form method="POST" action="insert_order_item.php">';
                            echo '<input type="hidden" name="product_ID" value="' . $row["products_ID"] . '">';
                            echo '<button class="add-to-cart" data-product-id=" ' . $row["products_ID"] . ' " data-quantity="1">Add to Cart</button>';
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
    </main>


    <?php include_once("includes/footer.php") ?>
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