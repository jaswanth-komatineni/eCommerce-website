<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

// Fetch all products
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 15px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        td img {
            width: 50px;
            height: auto;
            border-radius: 4px;
        }

        .actions a {
            display: inline-block;
            margin: 0 6px;
            padding: 6px 12px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            border: 1px solid #007bff;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .actions a:hover {
            background-color: #007bff;
            color: white;
        }

        .btn-back {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #495057;
        }

        @media (max-width: 768px) {
            table, th, td {
                font-size: 13px;
            }

            .actions a {
                padding: 4px 8px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Products</h2>

    <?php if (empty($products)) : ?>
        <p style="text-align: center;">No products found.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price ($)</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['id']; ?></td>
                        <td><?= htmlspecialchars($product['name']); ?></td>
                        <td><?= number_format($product['price'], 2); ?></td>
                        <td><?= htmlspecialchars($product['description']); ?></td>
                        <td>
                            <?php if (!empty($product['image'])): ?>
                                <img src="../images/<?= htmlspecialchars($product['image']); ?>" alt="Product Image">
                            <?php else: ?>
                                No image
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <a href="edit_product.php?id=<?= $product['id']; ?>">Edit</a>
                            <a href="delete_product.php?id=<?= $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="dashboard.php" class="btn-back">⬅ Back to Dashboard</a>
</div>

</body>
</html>
