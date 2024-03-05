<header>
    <h1>Shoe Emporium</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="products-page.php">Products</a>
        <a href="contact-us.php">Contact Us</a>
        <a href="about-us.php">About Us</a>
        <?php
        if (!isset($_SESSION["user"])) { ?>
            <a href="register.php">Register</a>
            <a href="login.php">Log In</a>
        <?php } else { ?>
            <a href="user.php">User</a>
            ?>
        <?php } ?>
        <a href="basket-page.php">Basket</a>
    </nav>
    <div id="top-right">
        <div id="user-account">User Account</div>
    </div>
</header>