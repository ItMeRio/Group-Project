<?php

if (!isset($_SESSION['account_type']) || $_SESSION['account_type'] != 'admin' OR 'customer') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
    <h1>Welcome you have signed in!</h1>
    <a href ="logout.php" class="btn btn-warning"> Logout</a>
    </div>
</body>
</html>