<?php
include 'connection.php'; // Make sure this points to your database connection file

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviewID = $_POST['review_id'];

    if (isset($_POST['delete'])) {
        // Delete review logic
        $deleteStmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
        $deleteStmt->execute([$reviewID]);
    } elseif (isset($_POST['approve'])) {
        // Approve review logic
        $updateStmt = $conn->prepare("UPDATE reviews SET is_approved = 1 WHERE review_id = ?");
        $updateStmt->execute([$reviewID]);
    } elseif (isset($_POST['respond'])) {
        // Respond to review logic
        $response = $_POST['admin_response'];
        $responseStmt = $conn->prepare("UPDATE reviews SET admin_response = ? WHERE review_id = ?");
        $responseStmt->execute([$response, $reviewID]);
    }

    // Redirect to avoid form resubmission
    header("Location: manage_reviews.php");
    exit;
}

// Pagination settings
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

// Get total number of reviews and calculate total pages
$total = $conn->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
$pages = ceil($total / $perPage);

// Fetch reviews with limit for pagination
$stmt = $conn->prepare("SELECT r.*, u.username, p.product_name FROM reviews r JOIN users u ON r.user_id = u.user_id JOIN products p ON r.product_id = p.product_id LIMIT {$start}, {$perPage}");
$stmt->execute();
$reviews = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
    </style>

</head>
<body>
    <h1>Product Reviews Management</h1>

    <?php foreach ($reviews as $review): ?>
        <div>
            <p><strong>User:</strong> <?php echo htmlspecialchars($review['username']); ?></p>
            <p><strong>Product:</strong> <?php echo htmlspecialchars($review['product_name']); ?></p>
            <p><strong>Rating:</strong> <?php echo htmlspecialchars($review['rating']); ?></p>
            <p><strong>Review:</strong> <?php echo htmlspecialchars($review['review_text']); ?></p>
            <?php if ($review['is_approved']): ?>
                <p><em>Approved</em></p>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                    <input type="submit" name="approve" value="Approve">
                </form>
            <?php endif; ?>
            <?php if ($review['admin_response']): ?>
                <p><strong>Response:</strong> <?php echo htmlspecialchars($review['admin_response']); ?></p>
            <?php endif; ?>
            <form method="post">
                <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                <textarea name="admin_response"></textarea>
                <input type="submit" name="respond" value="Respond">
                <input type="submit" name="delete" value="Delete">
            </form>
        </div>
    <?php endforeach; ?>

    <!-- Pagination Links -->
    <div>
        <?php for ($x = 1; $x <= $pages; $x++): ?>
            <a href="?page=<?php echo $x; ?>"><?php echo $x; ?></a>
        <?php endfor; ?>
    </div>

</body>
</html>
