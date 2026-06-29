# 📦 Inventory Management System

Inventory Management System is a web-based application developed to help businesses manage inventory efficiently. The system allows users to monitor stock availability, manage products, suppliers, categories, purchase transactions, and generate inventory reports through an intuitive interface.

---

## 🚀 Features

### Authentication
- User Login
- Secure Authentication
- Role-based Access (if implemented)

### Dashboard
- Inventory overview
- Total products
- Total categories
- Total suppliers
- Stock summary

### Product Management
- Add new products
- Edit product information
- Delete products
- Product image upload
- Product stock management

### Category Management
- Create categories
- Update categories
- Delete categories

### Supplier Management
- Add suppliers
- Edit supplier information
- Delete suppliers

### Inventory Management
- Monitor stock
- Stock updates
- Product availability tracking

### Reports
- Inventory reports
- Stock information
- Transaction reports (if available)

---

# 🛠️ Built With

- Laravel
- PHP
- MySQL
- Blade Template Engine
- Bootstrap
- HTML5
- CSS3
- JavaScript
- Laragon (Development Environment)

---

# 📂 Project Structure

```
Inventory-ManagementSystem/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── .env.example
├── composer.json
└── README.md
```

---

# ⚙️ Installation Guide

## 1. Clone Repository

```bash
git clone https://github.com/IRMASENAM/Inventory-ManagementSystem.git
```

Move into the project directory.

```bash
cd Inventory-ManagementSystem
```

---

## 2. Install Dependencies

```bash
composer install
```

---

## 3. Create Environment File

Copy the environment file.

```bash
cp .env.example .env
```

If using Windows:

```bash
copy .env.example .env
```

---

## 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 5. Configure Database

Open the `.env` file and update the database configuration.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Create Database

Create a new MySQL database named

```
inventory_db
```

using phpMyAdmin or MySQL Workbench.

---

## 7. Import Database

If this repository includes an SQL file:

```
database/inventory.sql
```

Import it into MySQL using phpMyAdmin.

or

```sql
SOURCE database/inventory.sql;
```

---

## 8. Storage Link

If the application stores uploaded images:

```bash
php artisan storage:link
```

---

## 9. Run the Application

```bash
php artisan serve
```

Open

```
http://127.0.0.1:8000
```

---

# 🔑 Default Login

If your project provides demo credentials, add them here.

Example:

```
Email:
admin@example.com

Password:
password
```

If not available, remove this section.

---

# 📸 Screenshots

You can place screenshots inside

```
public/screenshots/
```

Example:

```
public/screenshots/dashboard.png
public/screenshots/products.png
public/screenshots/categories.png
```

Then display them:

## Dashboard

![Dashboard](public/screenshots/dashboard.png)

## Products

![Products](public/screenshots/products.png)

## Categories

![Categories](public/screenshots/categories.png)

---

# 📋 Requirements

- PHP 8.x
- Composer
- MySQL
- Laravel
- Apache / Nginx
- Laragon / XAMPP

---

# 📁 Database

This project uses MySQL.

If an SQL file is included:

```
database/inventory.sql
```

Import it before running the application.

---

# 🧩 Main Modules

- Authentication
- Dashboard
- Products
- Categories
- Suppliers
- Inventory
- Reports

---

# 👨‍💻 Author

**Irma Sena Marliyana**

GitHub

https://github.com/IRMASENAM

---

# 📄 License

This project is intended for educational and portfolio purposes.
