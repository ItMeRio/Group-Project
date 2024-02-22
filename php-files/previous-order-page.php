<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = isset($_POST['product1']) ? $_POST['product1'] : '';
    $review = isset($_POST['reviewProduct1']) ? $_POST['reviewProduct1'] : '';

    // Validate inputs
    if ($product !== '' && $review !== '') {
        // Process and store the review 
        $response = ['success' => true, 'message' => 'Review submitted successfully'];
        echo json_encode($response);
        exit;
    }
}

$response = ['success' => false, 'message' => 'Invalid request'];
echo json_encode($response);
?>

