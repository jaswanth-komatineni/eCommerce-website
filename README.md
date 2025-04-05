
---


```markdown
# 🛒 PHP eCommerce Website

A complete, responsive **eCommerce web application** built with **PHP**, **MySQL**, and **HTML/CSS**.  
It includes full user functionality, a shopping cart system, and a secure admin dashboard for managing products.

> 🔗 **Live Demo**: [jaswanth.infinityfreeapp.com](http://jaswanth.infinityfreeapp.com/)

---

## 🚀 Key Features

### 👤 User Panel
- 📝 User registration & login
- 🛍️ View products with details and images
- ➕ Add to cart with quantity control
- 🧺 Manage cart (update/remove)
- ✅ Place order (simulated checkout)

### 🔐 Admin Panel
- 🔑 Admin login authentication
- ➕ Add new products (with image upload)
- ✏️ Edit existing products
- 🗑️ Delete products
- 📋 View/manage full product list

---

## 🛠️ Tech Stack

| Tool / Language | Purpose                              |
|-----------------|--------------------------------------|
| **PHP**         | Backend logic                        |
| **MySQL**       | Database management                  |
| **HTML/CSS**    | Frontend layout and design           |
| **Tailwind CSS**| (Optional) Responsive styling        |
| **InfinityFree**| Free hosting and MySQL DB support    |
| **Git + GitHub**| Version control and project hosting  |

---

## 📁 Project Folder Structure

```bash
htdocs/
├── index.php                  # Homepage (product catalog)
├── includes/
│   └── db.php                 # Database connection config
│
├── pages/
│   ├── login.php              # User login
│   ├── register.php           # User registration
│   ├── cart.php               # User cart page
│   ├── buy.php                # Order confirmation
│   └── logout.php             # User logout
│
├── admin/
│   ├── login.php              # Admin login
│   ├── dashboard.php          # Admin dashboard
│   ├── add_product.php        # Add products
│   ├── edit_product.php       # Edit products
│   ├── delete_product.php     # Delete products
│   └── manage_products.php    # Product list for admin
│
├── images/                    # Product images
├── css/
│   └── style.css              # Optional custom styles
├── ecommerce.sql              # MySQL database export
└── test_db.php                # DB connection test
```

---

## 🧪 Running the Project Locally

### ✅ 1. Clone the Repository
```bash
git clone https://github.com/jaswanth-komatineni/eCommerce-website.git
```

### ✅ 2. Move the project to your server directory:
- **MAMP**: `/Applications/MAMP/htdocs/eCommerce-website`
- **XAMPP**: `C:/xampp/htdocs/eCommerce-website`

### ✅ 3. Import the Database
- Open `http://localhost/phpmyadmin`
- Create a database named: `ecommerce`
- Click **Import** → choose `ecommerce.sql` from the project folder

### ✅ 4. Configure Database Connection
Edit the file `includes/db.php` to match your local MySQL settings:
```php
$host = 'localhost';
$dbname = 'ecommerce';
$user = 'root';
$password = 'root'; // or your password
```

---

## 🌐 Deployment Info

- **Hosting Provider**: [InfinityFree](https://infinityfree.net)
- **Live URL**: [jaswanth.infinityfreeapp.com](http://jaswanth.infinityfreeapp.com)
- **Database Host**: `sql113.infinityfree.com`


---

## 👨‍💻 Author

**Jaswanth Komatineni**  
📧 [jaswanthkomatineni@gmail.com](mailto:jaswanthkomatineni@gmail.com)  
🔗 [GitHub Profile](https://github.com/jaswanth-komatineni)

---

## 📄 License

This project is licensed under the **MIT License**.  
