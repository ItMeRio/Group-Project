<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("includes/include.php") ?>
    <link rel="stylesheet" href="../css/login.css">
</head>


<body>
    <?php include_once("includes/navbar.php") ?>

    <main>
        <!-- Signup Form -->
        <div class="form signup">
            <header>Sign Up!</header>
            <form action="#">
                <div class="field input-field">
                    <input type="email" placeholder="Email" class="input">
                </div>

                <div class="field input-field">
                    <input type="password" placeholder="Password" class="input">
                    <i class='bx bxs-hide eye-icon'></i>
                </div>

                <div class="field input-field">
                    <input type="password" placeholder="Retype Password" class="input">
                    <i class='bx bxs-hide eye-icon'></i>
                </div>

                <div class="form-link">
                    <a href="#" class="forgot-pass">Forgot Password?</a>
                </div>

                <div class="field button-field">
                    <button class="button">Signup</button>
                </div>



            </form>
            <div class="form-link">
                <span>Already have an account? <a href="\login.php" class="link signup-link">Log in</a></span>
            </div>
            <div class="line"></div>

            <div class="media-options">
                <a href="#" class="field facebook">
                    <i class='bx bxl-facebook facebook-icon'></i>
                    <span>Sign up with Facebook</span>
                </a>
            </div>
            <div class="media-options">
                <a href="#" class="field google">
                    <i class='bx bxl-google google-icon'></i>
                    <span>Sign Up with Google</span>
                </a>
            </div>
        </div>
    </main>

    <!--JS-->
    <?php include_once("includes/footer.php") ?>

    <script src="registration.js"></script>

</body>

</html>