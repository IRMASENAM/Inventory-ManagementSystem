# 📦 Inventory Management System

<p align="center">

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge\&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge\&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge\&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge\&logo=bootstrap)
![License](https://img.shields.io/badge/License-Educational-green?style=for-the-badge)

</p>

<p align="center">
Sistem Manajemen Inventaris berbasis web yang dikembangkan menggunakan <b>Laravel Framework</b> untuk membantu perusahaan atau toko dalam mengelola data persediaan barang secara efisien, mulai dari pengelolaan produk, kategori, supplier, hingga laporan stok.
</p>

---

# 📖 Deskripsi

**Inventory Management System** merupakan aplikasi berbasis web yang dirancang untuk mempermudah proses pengelolaan inventaris barang. Sistem ini menyediakan berbagai fitur yang mendukung pencatatan data produk, pemantauan stok, pengelolaan supplier, serta penyajian laporan inventaris secara cepat dan akurat.

Dengan antarmuka yang sederhana dan mudah digunakan, aplikasi ini dapat membantu meningkatkan efisiensi pengelolaan stok serta meminimalisir kesalahan pencatatan data.

---

# ✨ Fitur Utama

## 🔐 Authentication

* ✅ Login pengguna
* ✅ Autentikasi menggunakan Laravel Authentication
* ✅ Validasi akun
* ✅ Session Management
* ✅ Logout

---

## 📊 Dashboard

Dashboard menampilkan ringkasan informasi inventaris secara real-time, meliputi:

* 📦 Total Produk
* 🗂️ Total Kategori
* 🚚 Total Supplier
* 📈 Ringkasan Stok Barang
* 📉 Informasi Persediaan

---

## 📦 Manajemen Produk

Fitur untuk mengelola seluruh data produk.

* ➕ Menambahkan produk baru
* ✏️ Mengubah informasi produk
* 🗑️ Menghapus produk
* 🖼️ Upload gambar produk
* 📦 Mengelola stok produk
* 🔍 Pencarian produk

---

## 🗂️ Manajemen Kategori

Mengelola kategori produk agar lebih terorganisir.

* ➕ Tambah kategori
* ✏️ Edit kategori
* 🗑️ Hapus kategori

---

## 🚚 Manajemen Supplier

Mengelola data pemasok barang.

* ➕ Tambah supplier
* ✏️ Edit supplier
* 🗑️ Hapus supplier
* 📞 Informasi kontak supplier

---

## 📦 Manajemen Inventaris

Mengontrol seluruh stok barang.

* 📈 Monitoring stok
* 🔄 Update stok
* ⚠️ Informasi stok tersedia
* 📦 Riwayat perubahan stok

---

## 📑 Laporan

Menyediakan laporan inventaris yang dapat digunakan sebagai dokumentasi.

* 📋 Laporan data produk
* 📊 Laporan stok barang
* 📈 Ringkasan inventaris
* 🖨️ Cetak laporan *(jika tersedia)*

---

# 🛠️ Teknologi yang Digunakan

| Teknologi      | Keterangan         |
| -------------- | ------------------ |
| ⚙️ Laravel     | Framework Backend  |
| 🐘 PHP         | Bahasa Pemrograman |
| 🗄️ MySQL      | Database           |
| 🎨 Blade       | Template Engine    |
| 💙 Bootstrap 5 | Framework CSS      |
| 🌐 HTML5       | Struktur Website   |
| 🎨 CSS3        | Styling            |
| ⚡ JavaScript   | Interaktivitas     |
| 💻 Laragon     | Local Development  |

---

# 📂 Struktur Project

```text
Inventory-ManagementSystem/

├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── vendor/
├── .env.example
├── artisan
├── composer.json
└── README.md
```

---

# ⚙️ Cara Instalasi

## 1️⃣ Clone Repository

```bash
git clone https://github.com/IRMASENAM/Inventory-ManagementSystem.git
```

Masuk ke folder project

```bash
cd Inventory-ManagementSystem
```

---

## 2️⃣ Install Dependency

```bash
composer install
```

---

## 3️⃣ Buat File Environment

Linux / Mac

```bash
cp .env.example .env
```

Windows

```bash
copy .env.example .env
```

---

## 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

## 5️⃣ Konfigurasi Database

Edit file **.env**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6️⃣ Membuat Database

Buat database baru dengan nama

```text
inventory_db
```

Menggunakan:

* phpMyAdmin
* MySQL Workbench
* HeidiSQL

---

## 7️⃣ Import Database

Jika repository menyediakan file SQL

```text
database/inventory.sql
```

Import menggunakan phpMyAdmin atau terminal

```sql
SOURCE database/inventory.sql;
```

---

## 8️⃣ Membuat Storage Link

```bash
php artisan storage:link
```

---

## 9️⃣ Menjalankan Aplikasi

```bash
php artisan serve
```

Buka browser

```text
http://127.0.0.1:8000
```

---

# 👤 Akun Login

Apabila project menyediakan akun demo.

```text
Email
admin@example.com

Password
password
```

Jika tidak tersedia, bagian ini dapat dihapus.

---

# 🖼️ Tampilan Aplikasi

Simpan screenshot pada folder berikut

```text
public/screenshots/
```

Contoh

```text
public/screenshots/dashboard.png
public/screenshots/product.png
public/screenshots/category.png
public/screenshots/supplier.png
```

Kemudian tampilkan

## 📊 Dashboard

![Dashboard](public/screenshots/dashboard.png)

---

## 📦 Produk

![Produk](public/screenshots/product.png)

---

## 🗂️ Kategori

![Kategori](public/screenshots/category.png)

---

## 🚚 Supplier

![Supplier](public/screenshots/supplier.png)

---

# 📋 Persyaratan Sistem

* ✅ PHP 8.x
* ✅ Composer
* ✅ Laravel
* ✅ MySQL
* ✅ Apache / Nginx
* ✅ Laragon / XAMPP

---

# 🗄️ Database

Database yang digunakan adalah **MySQL**.

Apabila tersedia file SQL

```text
database/inventory.sql
```

Import terlebih dahulu sebelum menjalankan aplikasi.

---

# 🧩 Modul Aplikasi

* 🔐 Authentication
* 📊 Dashboard
* 📦 Produk
* 🗂️ Kategori
* 🚚 Supplier
* 📦 Inventaris
* 📑 Laporan

---

# 🎯 Tujuan Pengembangan

Aplikasi ini dikembangkan untuk:

* 📦 Mempermudah pengelolaan inventaris barang.
* 📈 Memantau stok secara efisien.
* 🗂️ Mengorganisasi data produk berdasarkan kategori.
* 🚚 Mengelola data supplier.
* 📊 Menyediakan laporan inventaris.
* ⚡ Mengurangi kesalahan pencatatan stok.

---

# 👨‍💻 Pengembang

**Irma Sena Marliyana**

🌐 GitHub

https://github.com/IRMASENAM

---

# 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran, pengembangan portofolio, dan referensi implementasi aplikasi berbasis Laravel.

Silakan digunakan sebagai bahan belajar dengan tetap mencantumkan sumber apabila melakukan modifikasi atau pengembangan lebih lanjut.
