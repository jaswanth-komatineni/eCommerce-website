<?php
session_start();
include '../includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$stmt = $conn->prepare("SELECT cart.id AS cart_id, products.name, products.price, cart.quantity 
                        FROM cart 
                        JOIN products ON cart.product_id = products.id 
                        WHERE cart.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total
$total_cost = 0;
foreach ($cart_items as $item) {
    $total_cost += $item['price'] * $item['quantity'];
}

// Optional: clear cart after purchase (uncomment when payment is successful)
// $conn->prepare("DELETE FROM cart WHERE user_id = ?")->execute([$user_id]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Buy Now</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 0;
        }

        .checkout-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #1e293b;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            border-bottom: 1px solid #e2e8f0;
            padding: 10px 0;
        }

        .item-name {
            font-weight: 600;
        }

        .total {
            margin-top: 20px;
            font-size: 1.2em;
            text-align: right;
            color: #2563eb;
        }

        .complete-button {
            margin-top: 30px;
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #10b981;
            color: white;
            text-align: center;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s;
        }

        .complete-button:hover {
            background-color: #059669;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h2>Order Summary</h2>
        <?php if (empty($cart_items)) : ?>
            <p>Your cart is empty. <a href="../index.php">Start Shopping</a></p>
        <?php else : ?>
            <ul>
                <?php foreach ($cart_items as $item) : ?>
                    <li>
                        <span class="item-name"><?= htmlspecialchars($item['name']); ?></span><br>
                        Quantity: <?= $item['quantity']; ?> × $<?= number_format($item['price'], 2); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="total">
                Total: $<?= number_format($total_cost, 2); ?>
            </div>
            <form method="POST" action="order_success.php">
                <button type="submit" class="complete-button">Place Order</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
