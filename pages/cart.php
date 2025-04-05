<?php
session_start();
include '../includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle Adding to Cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
        $stmt->execute([$user_id, $product_id]);
    }

    header("Location: cart.php");
    exit();
}

// Handle Updating Quantity
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity > 0) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND id = ?");
        $stmt->execute([$quantity, $user_id, $product_id]);
    }
    header("Location: cart.php");
    exit();
}

// Handle Removing Item
if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND id = ?");
    $stmt->execute([$user_id, $product_id]);

    header("Location: cart.php");
    exit();
}

// Fetch Cart Items
$stmt = $conn->prepare("SELECT cart.id AS cart_id, products.name, products.price, cart.quantity 
                        FROM cart 
                        JOIN products ON cart.product_id = products.id 
                        WHERE cart.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .cart-container {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        table th, table td {
            padding: 14px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        table th {
            background-color: #e9ecef;
        }

        table td {
            background-color: #fff;
        }

        .cart-container a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3b82f6;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
            text-align: center;
        }

        .cart-container a:hover {
            background-color: #2563eb;
        }

        .cart-container form {
            display: inline-block;
        }

        .cart-container input[type="number"] {
            width: 60px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        button {
            padding: 8px 12px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c0392b;
        }

        h3 {
            text-align: right;
            margin-top: 20px;
            font-size: 1.2em;
            color: #2d3436;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .continue-buy {
            background-color: #10b981;
        }

        .continue-buy:hover {
            background-color: #059669;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2>Your Shopping Cart</h2>

        <?php if (empty($cart_items)) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_cost = 0; ?>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']); ?></td>
                            <td>$<?= number_format($item['price'], 2); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?= $item['cart_id']; ?>">
                                    <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1">
                                    <button type="submit" name="update_quantity">Update</button>
                                </form>
                            </td>
                            <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?= $item['cart_id']; ?>">
                                    <button type="submit" name="remove_from_cart">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php $total_cost += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total Cost: $<?= number_format($total_cost, 2); ?></h3>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="../index.php">Continue Shopping</a>
            <a href="buy.php" class="continue-buy">Continue Buy</a>
        </div>
    </div>
</body>
</html>
