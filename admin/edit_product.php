<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

if (!isset($_GET['id'])) {
    header("Location: manage_products.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit();
}

$message = '';

if (isset($_POST['update_product'])) {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/$image");

        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $image, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $id]);
    }

    $message = "✅ Product updated successfully!";
    // Refresh product data
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, textarea {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        img {
            max-width: 100px;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        button {
            background-color: #007bff;
            color: white;
            font-size: 1rem;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            font-weight: bold;
            color: green;
            margin-bottom: 20px;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?= $message; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']); ?>" required>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="<?= $product['price']; ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required><?= htmlspecialchars($product['description']); ?></textarea>

        <label>Current Image:</label><br>
        <img src="../images/<?= htmlspecialchars($product['image']); ?>" alt="Product Image"><br>

        <label for="image">Upload New Image (optional):</label>
        <input type="file" name="image" id="image">

        <button type="submit" name="update_product">Update Product</button>
    </form>

    <div class="back-link">
        <a href="manage_products.php">← Back to Manage Products</a>
    </div>
</div>
</body>
</html>
