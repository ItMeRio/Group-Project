<?php 
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("includes/include.php") ?>
  <style>
    .container {
      display: flex;
      align-items: flex-start; /* Align items at the start of the container */
    }

    .basket-left {
      flex: 1;
      padding-right: 20px;
    }

    .basket-right {
      flex: 1;
      padding-left: 20px;
    }

    .form-box {
      border: 1px solid #ccc; /* Adding border around the form box */
      padding: 20px; /* Adding padding inside the form box */
      margin-bottom: 20px; /* Adjusting margin to separate form boxes */
    }

    .form-box label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    .form-box input[type="text"],
    .form-box input[type="email"],
    .form-box input[type="password"] {
      width: calc(100% - 20px); /* Adjusted width to account for padding */
      padding: 5px;
      margin-bottom: 10px;
    }

    .btn {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <?php include_once("includes/navbar.php") ?>
  <main>
    <div class="container">
      <div class="basket-left">
        <div class="form-box"> <!-- Adding box around the form -->
          <h2>Sign In</h2>
          <form action="signin.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <button type="submit" class="btn">Sign In</button>
          </form>
        </div>
      </div>
      <div class="basket-right">
        <div class="form-box"> <!-- Adding box around the form -->
          <h2>Create Account</h2>
          <form action="signup.php" method="post">
            <label for="new_email">Email:</label>
            <input type="email" id="new_email" name="new_email" placeholder="Enter your email address">
            <label for="new_password">Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter your password">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
            <button type="submit" class="btn">Create Account</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php include_once("includes/footer.php") ?>
</body>
</html>
