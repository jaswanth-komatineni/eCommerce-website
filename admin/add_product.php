<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

$message = '';

if (isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    $image = $_FILES['image']['name'];

    // Upload image
    $imagePath = "../images/" . basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $price, $description, $image]);
        $message = "✅ Product added successfully!";
    } else {
        $message = "❌ Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 60px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin: 10px 0 5px;
        }
        input, textarea {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        button {
            background-color: #28a745;
            color: white;
            font-size: 1rem;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        .message {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Add Product</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Price ($):</label>
        <input type="number" step="0.01" name="price" id="price" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required>

        <button type="submit" name="add_product">Add Product</button>
    </form>

    <div class="back-link">
        <a href="manage_products.php">← Back to Manage Products</a>
    </div>
</div>
</body>
</html>
