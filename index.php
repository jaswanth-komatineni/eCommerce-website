<?php
session_start();
include 'includes/db.php';

// Logout logic
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Fetch products
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count cart items
$cartCount = 0;
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ?");
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $cartCount = $result['total'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Jaswanth Store</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Header -->
<header class="bg-white shadow sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
    <a href="index.php" class="text-2xl font-bold text-indigo-600">Jaswanth Store</a>

    <div class="flex items-center space-x-4">
      <!-- Hamburger (mobile) -->
      <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

      <!-- Desktop Nav -->
      <nav id="menu" class="hidden md:flex space-x-6 text-gray-700 font-medium items-center">
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="pages/cart.php" class="relative inline-flex items-center hover:text-indigo-600">
            <img src="images/cart-icon.png" alt="Cart" class="w-5 h-5 mr-1"> Cart
            <?php if ($cartCount > 0): ?>
              <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs font-semibold rounded-full px-2 py-0.5"><?= $cartCount ?></span>
            <?php endif; ?>
          </a>
          <form method="POST" class="inline">
            <button type="submit" name="logout" class="text-red-500 hover:underline">Logout</button>
          </form>
          <?php if (!empty($_SESSION['user_name'])): ?>
            <span class="text-sm text-gray-500">Welcome, <?= htmlspecialchars($_SESSION['user_name']); ?> 👋</span>
          <?php endif; ?>
        <?php else: ?>
          <a href="pages/login.php" class="hover:text-indigo-600">Login</a>
          <a href="pages/register.php" class="hover:text-indigo-600">Register</a>
        <?php endif; ?>
      </nav>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
    <nav class="flex flex-col gap-3 text-gray-700 font-medium">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="pages/cart.php" class="relative flex items-center hover:text-indigo-600">
          <img src="images/cart-icon.png" alt="Cart" class="w-5 h-5 mr-2"> Cart
          <?php if ($cartCount > 0): ?>
            <span class="absolute -top-2 left-16 bg-red-500 text-white text-xs font-semibold rounded-full px-2 py-0.5"><?= $cartCount ?></span>
          <?php endif; ?>
        </a>
        <form method="POST" class="inline">
          <button type="submit" name="logout" class="text-red-500 hover:underline text-left">Logout</button>
        </form>
        <?php if (!empty($_SESSION['user_name'])): ?>
          <span class="text-sm text-gray-500">Welcome, <?= htmlspecialchars($_SESSION['user_name']); ?> 👋</span>
        <?php endif; ?>
      <?php else: ?>
        <a href="pages/login.php" class="hover:text-indigo-600">Login</a>
        <a href="pages/register.php" class="hover:text-indigo-600">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<!-- Products Section -->
<main class="max-w-6xl mx-auto px-4 py-10">
  <h2 class="text-3xl font-bold mb-8 text-center">Featured Products</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    <?php if (empty($products)) : ?>
      <p>No products available.</p>
    <?php else : ?>
      <?php foreach ($products as $product) : ?>
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
          <?php if (!empty($product['image'])) : ?>
            <img src="images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="w-full h-48 object-cover rounded-t-lg">
          <?php endif; ?>
          <div class="p-4">
            <h3 class="text-lg font-semibold"><?= htmlspecialchars($product['name']); ?></h3>
            <p class="text-green-600 font-bold mt-1">$<?= number_format($product['price'], 2); ?></p>
            <p class="text-sm text-gray-600 mt-2"><?= htmlspecialchars($product['description']); ?></p>
            <form method="POST" action="pages/cart.php" class="mt-4">
              <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
              <button type="submit" name="add_to_cart" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">
                Add to Cart
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</main>

<!-- Footer -->
<footer class="bg-white text-center text-gray-500 text-sm py-6 border-t mt-10">
  &copy; <?= date('Y'); ?> Jaswanth Online Store. All rights reserved.
</footer>

<!-- Mobile Menu Script -->
<script>
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>

</body>
</html>
