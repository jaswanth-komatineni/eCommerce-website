<?php
session_start();

// Restrict access to authenticated admins only
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 60px auto;
            background-color: #fff;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            padding: 12px 30px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #388e3c;
        }

        .logout {
            background-color: #f44336;
        }

        .logout:hover {
            background-color: #e53935;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #777;
        }

        @media (max-width: 500px) {
            nav {
                flex-direction: column;
                align-items: center;
            }

            nav a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Admin Dashboard</h2>
        <nav>
            <a href="add_product.php">Add Product</a>
            <a href="manage_products.php">Manage Products</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Admin Dashboard</p>
    </footer>

</body>
</html>
