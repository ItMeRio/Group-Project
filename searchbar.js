<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* Responsive Search Bar Styles */
        #search-bar {
            margin: 20px;
            text-align: center;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        .responsive-search {
            display: none;
        }

        @media only screen and (max-width: 600px) {
            .search {
                display: none;
            }

            .responsive-search {
                display: block;
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

    <section>
        <h2>Featured Products</h2>

        <!-- Responsive Search Bar -->
        <div id="search-bar" class="responsive-search">
            <input type="text" placeholder="Search...">
        </div>

        <!-- Normal Search Bar -->
        <div id="search-bar" class="search">
            <input type="text" placeholder="Search...">
        </div>

        <div id="product-container">
            <!-- Product Boxes... -->
        </div>
    </section>

</body>

</html>
