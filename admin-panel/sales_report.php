<?php
include 'connection.php'; // Ensure this points to your database connection file
$reportData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    try {
        // SQL query to fetch sales data
        $stmt = $conn->prepare("SELECT COUNT(order_id) as total_orders, SUM(price) as total_sales FROM order_items WHERE created_at BETWEEN ? AND ?");
        $stmt->execute([$startDate, $endDate]);
        $reportData = $stmt->fetch();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <!-- Add CSS as needed -->
</head>
<body>
    <h1>Sales Report</h1>
    <form method="post">
        Start Date: <input type="date" name="start_date" required><br>
        End Date: <input type="date" name="end_date" required><br>
        <input type="submit" value="Generate Report">
    </form>

    <?php if ($reportData): ?>
        <h2>Report from <?php echo $startDate; ?> to <?php echo $endDate; ?>:</h2>
        <p>Total Orders: <?php echo $reportData['total_orders']; ?></p>
        <p>Total Sales: $<?php echo number_format($reportData['total_sales'], 2); ?></p>
    <?php endif; ?>
</body>
</html>
