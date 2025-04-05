<?php
include 'includes/db.php';

if ($conn) {
    try {
        // Test if the connection is successful
        $conn->query('SELECT 1');
        echo "Database connected successfully!";
    } catch (PDOException $e) {
        echo "Failed to query the database: " . $e->getMessage();
    }
} else {
    echo "Failed to connect to the database.";
}
?>

