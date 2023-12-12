<?php
// Delete product logic here (delete from database)
function deleteProduct($id) {
  global $conn;

  $sql = "DELETE FROM products WHERE id=$id";

  return $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
</head>
<body>
    <h2>Delete Product</h2>

    <p>Are you sure you want to delete this product?</p>

    <!-- Add confirmation button -->
    <form method="post">
        <button type="submit">Yes, Delete Product</button>
    </form>
</body>
</html>
