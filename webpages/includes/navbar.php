<?php 
include 'connect.php';
?>
<header>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <h1>Shoe Emporium</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="products-page.php">Products</a>
        <a href="contact-us.php">Contact Us</a>
        <a href="about-us.php">About Us</a>
        <?php
        if (!isset($_SESSION["user"])) { ?>
            <a href="login.php">Sign in</a>
        <?php } else { ?>
            
            <a href="logout.php">Log Out</a>
        <?php } ?>
        
        <a href="myprofile.php"><i class="fas fa-user-circle" style="font-size:22px"></i></a>
        <?php
        if (!isset($_SESSION["user"])) { ?>
            <a href="registration.php">Register</a>
        <?php } else { ?>
            
        
        <?php } ?>
        <?php
        $select_product = mysqli_query($conn, "Select *from `cart` ") or die('query failed');
        $row_count=mysqli_num_rows($select_product);
        ?>
        <a href="basket-page.php"><i class="fas fa-shopping-cart"></i><span><sup><?php echo $row_count?></sup></span></a>
    </nav>

</header>