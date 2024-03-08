<?php
function deleteCustomer($id) {
  global $conn;

  $sql = "DELETE FROM customers WHERE id=$id";

  return $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Customer</title>
</head>
<body>
    <h2>Delete Customer</h2>

    <p>Are you sure you want to delete this customer?</p>

    <form method="post">
        <button type="submit">Yes, Delete Customer</button>
    </form>
</body>
</html>
