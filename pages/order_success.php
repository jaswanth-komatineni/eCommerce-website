<?php
session_start();
include '../includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Clear the cart for the user
$stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0fdf4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .success-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 128, 0, 0.2);
            text-align: center;
            max-width: 500px;
        }

        h1 {
            color: #16a34a;
            margin-bottom: 10px;
        }

        p {
            color: #374151;
            font-size: 1.1em;
        }

        .btn {
            margin-top: 20px;
            display: inline-block;
            background-color: #10b981;
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color: #059669;
        }
    </style>
</head>
<body>
    <div class="success-box">
        <h1>✅ Order Placed!</h1>
        <p>Thank you for your purchase. Your order has been successfully placed.</p>
        <a href="../index.php" class="btn">Continue Shopping</a>
    </div>
</body>
</html>
