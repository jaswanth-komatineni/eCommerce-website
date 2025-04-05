# 🛒 PHP eCommerce Website

A complete, responsive eCommerce web application built using **PHP**, **MySQL**, and **HTML/CSS**. This project includes full user functionality, shopping cart system, and a secured admin dashboard for managing products.

> ✅ Deployed Live: [jaswanth.infinityfreeapp.com](https://jaswanth.infinityfreeapp.com)

---

## 🚀 Features

### 👥 User Features
- User registration & login with session handling
- Browse products with image, description, and pricing
- Add to cart (auto quantity management)
- Update cart quantity or remove items
- Checkout & order confirmation page

### 🧑‍💼 Admin Features
- Secure admin login
- Add new products with image upload
- Edit and delete existing products
- View/manage product list via dashboard

---

## 🛠️ Tech Stack

| Technology    | Description                      |
|---------------|----------------------------------|
| `PHP`         | Core server-side scripting       |
| `MySQL`       | Relational database management   |
| `HTML/CSS`    | Frontend structure and styling   |
| `Tailwind`    | (Optional) for utility-first CSS |
| `Git + GitHub`| Version control & collaboration  |
| `InfinityFree`| Free hosting platform            |

---

## 📁 Project Structure

htdocs/
├── index.php
├── includes/
│   └── db.php
├── pages/
│   ├── login.php
│   ├── register.php
│   ├── cart.php
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── manage_products.php
│   └── add_product.php
├── images/
│   └── (all product images)
├── css/
│   └── style.css (optional)
└── test_db.php (for initial testing only)


---

## 🧪 How to Run Locally

1. **Clone the repository:**
   ```bash
   git clone https://github.com/jaswanth-komatineni/eCommerce-website.git

2.Move to your server's root directory:

For MAMP: /Applications/MAMP/htdocs/

For XAMPP: C:/xampp/htdocs/

3.Import the database:

Open localhost/phpmyadmin

Create a new database: ecommerce

Import ecommerce.sql from the project folder

4.Update your local database connection in:

includes/db.php

🌐 Live Deployment
Hosting Provider: InfinityFree

Live URL: jaswanth.infinityfreeapp.com

Database Host: sql113.infinityfree.com

Project hosted using MAMP locally, deployed with free PHP hosting

📸 Screenshots (Optional)
Add homepage, cart, and admin dashboard screenshots here if desired

👨‍💻 Author
Jaswanth Komatineni
📧 jaswanthkomatineni@gmail.com
🔗 GitHub Profile

📝 License
This project is open-source and available under the MIT License.
