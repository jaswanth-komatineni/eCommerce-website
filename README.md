# 🛒 PHP eCommerce Website

A fully functional **eCommerce Web Application** built using **PHP**, **MySQL**, **HTML/CSS**, and **Tailwind CSS**.  
It supports complete **user shopping experience**, including product browsing, cart management, order placement, and a secure **admin dashboard** for product management.

> 🔗 **Live Demo:** [jaswanth.infinityfreeapp.com](http://jaswanth.infinityfreeapp.com)  
> 🗂️ **GitHub Repo:** [eCommerce-website](https://github.com/jaswanth-komatineni/eCommerce-website)

---

## 🚀 Features

### 👤 User Module
- User registration & secure login
- Add/remove items to cart
- Quantity updates & real-time cart totals
- Place orders with dynamic order summary
- View order history on **My Orders** page
- Session-based cart tracking

### 🧑‍💼 Admin Module
- Admin login with role-based access
- Add new products with image upload
- Edit existing product details
- Delete products
- Manage product inventory via dashboard

---

## 📦 Tech Stack

| Layer           | Tools / Frameworks              |
|------------------|----------------------------------|
| **Frontend**     | HTML5, CSS3, Tailwind CSS        |
| **Backend**      | PHP (Procedural)                 |
| **Database**     | MySQL (phpMyAdmin)               |
| **Authentication** | PHP Sessions & password hashing |
| **Hosting**      | InfinityFree (Free PHP Hosting)  |
| **Version Control** | Git & GitHub                   |

---

## 📁 Project Structure

ecommerce/
├── admin/
│   ├── add_product.php
│   ├── dashboard.php
│   ├── edit_product.php
│   ├── delete_product.php
│   ├── login.php
│   └── logout.php
├── css/
│   └── style.css
├── includes/
│   └── db.php
│   └── header.php
├── images/
│   └── (product images)
├── pages/
│   ├── cart.php
│   ├── buy.php
│   ├── my_orders.php
│   ├── login.php
│   ├── register.php
│   └── order_success.php
├── index.php
├── test_db.php
└── ecommerce.sql

---


## 🧪 How to Run Locally

1. **Clone the Repository**:
   git clone https://github.com/jaswanth-komatineni/eCommerce-website.git

2. **Setup in Local Server** (XAMPP/MAMP):
   - Move folder into:  
     C:/xampp/htdocs (Windows)  
     /Applications/MAMP/htdocs (Mac)

3. **Import Database**:
   - Open phpMyAdmin
   - Create new database `ecommerce`
   - Import `ecommerce.sql` from the project

4. **Update Database Connection**:
   - File: includes/db.php
   - Update with your host, username, password, and database name

5. **Run on Browser**:
   - Visit: http://localhost/ecommerce/index.php

---

## 🌍 Deployment Details

- **Hosting**: InfinityFree
- **Live URL**: http://jaswanth.infinityfreeapp.com
- **MySQL Host**: sql113.infinityfree.com

---

## 🛡️ Security Features

- Passwords hashed using `password_hash()`
- Input sanitized using `htmlspecialchars()`
- Session-based access control
- Role separation between user and admin

---

## 📜 License

This project is open-source and available under the **MIT License**.

---

## 🙋‍♂️ Author

**Jaswanth Komatineni**  
📧 jaswanthkomatineni@gmail.com  
🔗 https://github.com/jaswanth-komatineni
