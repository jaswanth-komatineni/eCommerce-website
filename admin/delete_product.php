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

// Get the image file before deletion
$stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Delete product
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

// Delete the image file from the server (optional but recommended)
if ($product && !empty($product['image'])) {
    $imagePath = "../images/" . $product['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath); // Deletes the file
    }
}

header("Location: manage_products.php");
exit();
?>
