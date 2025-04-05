<?php
$host = 'localhost:8889';
$dbname = 'ecommerce';
$user = 'root';
$password = 'root';  // Replace with the actual password if different

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
