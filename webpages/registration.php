<?php
session_start();
if(isset($_SESSION["user"])) {
    header("Location: index.php");
    exit; // Add an exit after the redirect to stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/include.php") ?>


    <title>Registration form</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
<?php include_once("includes/navbar.php") ?>
    <div class="container">
        <?php
       if(isset($_POST["submit"])) {
        $fullName = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];
        
        $passwordHash= password_hash($password,PASSWORD_DEFAULT);

        $errors = array();


        if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            array_push($errors,"Email is not valid");
        }
        if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 characters long");
        }
        if($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
        }
        require_once "connect.php";
        $sql = "SELECT * FROM users WHERE email =  '$email'";
        $result = mysqli_query($conn,$sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount>0) {
            array_push($errors,"Email already exists!");
        }


        if (count($errors)>0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            
            $sql = "INSERT INTO users(fullName ,email,password) VALUES (?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName,$email,$passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                header("Location: login.php"); // Redirect to login.php after successful registration
                exit; // Stop further execution
            } else {
                die("Something went wrong");
            }
        }
       }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control"  name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
             <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
             </div>
        </form>
        <div>
            <div><p>Already registered <a href ="login.php">Login Here</a></p></div>
        </div>
    </div>
</main>
<?php include_once("includes/footer.php") ?>
</body>
</html>
