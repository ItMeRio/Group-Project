<?php
include 'connection.php';
$queryID = $_GET['query_id'];
$response = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = $_POST['response'];

    try {
        $stmt = $conn->prepare("UPDATE customer_queries SET response_text = ?, response_date = NOW(), status = 'resolved' WHERE query_id = ?");
        $stmt->execute([$response, $queryID]);

        header('Location: manage_queries.php');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Fetch the query details
    $stmt = $conn->prepare("SELECT query_text FROM customer_queries WHERE query_id = ?");
    $stmt->execute([$queryID]);
    $query = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Respond to Query</title>
    <!-- Add CSS as needed -->
</head>
<body>
    <h1>Respond to Query</h1>
    <p>Query: <?php echo htmlspecialchars($query['query_text']); ?></p>
    <form method="post">
        <textarea name="response" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Submit Response">
    </form>
</body>
</html>
