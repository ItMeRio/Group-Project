<?php
require('connect.php');

if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $img = $_POST['product_img'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "Select * from `cart` where name = '$product_name'");
    if(mysqli_num_rows($select_cart)>0){
        $display_message[] = "Product already added to cart!";
    }else{
        $insert_products = mysqli_query($conn, "INSERT INTO cart (name, price, image, quantity) VALUES ('$product_name', '$price', '$img', $product_quantity)");
        $display_message[] = "Product added to cart!";
    }   

       
    

    


}

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // Modify the SQL query to include a WHERE clause for searching
    $sql = "SELECT products_ID, product_name, price, img, color, brand, categories, section FROM products WHERE product_name LIKE '%$search%'";

} else {
    // Default query without search filter
    $sql = "SELECT products_ID, product_name, price, img, color, brand, categories, section FROM products";
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

                    <h6 class="text-info">Select Category</h6>
                    <ul class="list-group">
                        <?php
                        $sql_categories = "SELECT DISTINCT categories FROM products ORDER BY categories";
                        $result_categories = $conn->query($sql_categories);

                        while ($row = $result_categories->fetch_assoc()) {
                            ?>
                            <li class="list-group-item">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input categories_check"
                                            value="<?= $row['categories']; ?>" id="categories<?= $row['categories']; ?>">
                                        <?= $row['categories']; ?>
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
    if(isset($display_message)){
        foreach($display_message as $display_message){
        echo "<div class='display_message'>
        <span>$display_message</span>
        <i class = 'fas fa-times' onClick='this.parentElement.style.display=`none`'; ></i>
        </div>";
        }
    }
    
    ?>
    <div id="product-container">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products`");
        if(mysqli_num_rows($select_products) > 0) {
            while($fetch_product = mysqli_fetch_assoc($select_products)) {
                // Product inside a row
                echo '<div class="product" data-brand="' . $fetch_product["brand"] . '" data-color="' . $fetch_product["color"] . '" data-categories="' . $fetch_product["categories"] . '">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($fetch_product['img']) . '"/>';
                echo '<h5 class="name">' . $fetch_product["product_name"] . '</h5>';
                echo '<p class="details">' . $fetch_product["brand"] . ', ' . $fetch_product["color"] . '</p>';
                echo '<p>£' . $fetch_product["price"] . '</p>';
                echo '<form method="POST">';
                echo '<input type="hidden" name="product_ID">';
                echo '<input type="hidden" name="price" value="' . $fetch_product['price'] . '">';
                echo '<input type="hidden" name="product_name" value="' . $fetch_product['product_name'] . '">';
                echo '<input type="hidden" name="brand" value="' . $fetch_product['brand'] . '">';
                echo '<input type="hidden" name="product_img" value="' . base64_encode($fetch_product['img']) . '">';
                echo '<input value="Add to Cart" type="submit" class="add-to-cart" name="add_to_cart">';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "No products";
        }
        ?>
    </div>
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

                var selectedCategories = $('.categories_check:checked').map(function () {
                    return $(this).val();
                }).get();

                // Hide all products
                $('.product').hide();

                // Show only products that match the selected filters
                $('.product').each(function () {
                    var brand = $(this).data('brand');
                    var color = $(this).data('color');
                    var categories = $(this).data('categories');

                    if ((selectedBrands.length === 0 || selectedBrands.includes(brand)) &&
                        (selectedColors.length === 0 || selectedColors.includes(color)) &&
                        (selectedCategories.length === 0 || selectedCategories.includes(categories))) {
                        $(this).show();
                    }
                });
                
            }

            // Call the filter function on checkbox change
            $('.product_check, .color_check, .categories_check').change(function () {
                filterProducts();
            });

            // Call the filter function on page load
            filterProducts();
        });

        

    </script>

</body>

</html>

