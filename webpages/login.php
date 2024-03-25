<?php
include 'connect.php';
session_start();

// Redirect to index.php if user is already logged in
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit; // Terminate script execution after redirection
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("includes/include.php") ?>
</head>

<body>
    <?php include_once("includes/navbar.php") ?>

    <main>
        <div class="container">
            <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once("connect.php");
                $sql = "SELECT * FROM users WHERE email= '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        // Set user information in session
                        $_SESSION["user"] = $user;
                        header("Location: index.php");
                        exit; // Terminate script execution after redirection
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                }
            }
            ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Enter Email:" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter Password:" name="password" class="form-control">
                </div>
                <div class="form-btn">
                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                </div>
            </form>
            <div>
                <p>Not registered yet <a href="register.php"> Register Here</a></p>
            </div>
        </div>
    </main>

    <?php include_once("includes/footer.php") ?>

</body>

</html>
