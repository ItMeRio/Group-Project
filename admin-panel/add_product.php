<?php
include 'connection.php';

$error_message = '';
$success_message = '';

// Handle Add Product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'];
    $sectionId = $_POST['section_id']; // Ensure this field exists in your form
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stockQuantity = $_POST['stock_quantity'];
    $brand = $_POST['brand'];
    $color = $_POST['color'];
    $imageContent = null;

    // Image Upload Logic
    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
        // Read the file
        $tmpName = $_FILES['product_image']['tmp_name'];
        $imageContent = file_get_contents($tmpName);
    } else {
        $error_message = "Error in image upload.";
    }

    if (!$error_message) {
        try {
            // Insert product data into the database
            $stmt = $conn->prepare("INSERT INTO products (product_name, section_id, description, price, stock_quantity, brand, color, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$productName, $sectionId, $description, $price, $stockQuantity, $brand, $color, $imageContent]);
            $success_message = 'Product added successfully.';
        } catch(PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <!-- Add CSS here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"], 
        input[type="number"], 
        input[type="file"], 
        textarea, 
        select {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        textarea {
            resize: vertical;
        }
        button {
            padding: 10px 20px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error, .success {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
        }
    </style>

</head>
<body>
    <div class="container">
        <h1>Add New Product</h1>

        <!-- Display success/error messages -->
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <!-- Add Product Form -->
        <form method="post" enctype="multipart/form-data">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            
            <label for="section_id">Section ID:</label>
            <input type="number" id="section_id" name="section_id" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" id="stock_quantity" name="stock_quantity">

            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required>

            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image" required>

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>


