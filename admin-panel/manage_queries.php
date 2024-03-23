<?php
include 'connection.php';

try {
    $stmt = $conn->prepare("SELECT q.query_id, u.username, q.query_text, q.status FROM customer_queries q JOIN users u ON q.user_id = u.user_id");
    $stmt->execute();
    $queries = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Customer Queries</title>
    <!-- Add CSS as needed -->
</head>
<body>
    <h1>Customer Queries</h1>
    <table>
        <tr>
            <th>Query ID</th>
            <th>Username</th>
            <th>Query</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($queries as $query): ?>
        <tr>
            <td><?php echo $query['query_id']; ?></td>
            <td><?php echo htmlspecialchars($query['username']); ?></td>
            <td><?php echo htmlspecialchars($query['query_text']); ?></td>
            <td><?php echo $query['status']; ?></td>
            <td>
                <a href="respond_query.php?query_id=<?php echo $query['query_id']; ?>">Respond</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
