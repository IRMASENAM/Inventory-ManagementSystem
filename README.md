<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<h2 align="center">💼 Eksis Sistem Inventaris</h2>

<p align="center">
  Sistem berbasis website untuk mengelola data barang, pemasok, dan transaksi keluar-masuk barang di ruang Eksis.
  <br>
  <b>Dibangun menggunakan Laravel Framework</b>
</p>

---

## 🚀 Tentang Project

**Sistem Inventaris Barang Ruang Eksis** merupakan aplikasi manajemen inventaris yang dirancang untuk membantu pencatatan barang-barang di ruang Eksis secara digital, cepat, dan efisien.  
Melalui sistem ini, pengguna dapat mencatat **barang masuk**, **barang keluar**, serta **melihat laporan lengkap** dalam bentuk PDF atau Excel.

---

## ✨ Fitur Utama

- 🔑 **Login Pengguna**
- 📦 **Manajemen Data Barang**
  - Create, Read, Update, Delete data barang
  - Upload foto barang
- 🏢 **Manajemen Supplier**
  - Data pemasok barang lengkap
- 🧾 **Transaksi Barang Masuk & Barang Keluar**
  - Pencatatan otomatis nomor transaksi
  - Filter berdasarkan tanggal
- 📊 **Laporan**
  - Export ke PDF dan Excel
  - Filter berdasarkan periode
- 🔍 **Fitur Pencarian Cepat**
  - Cari barang berdasarkan nama atau kode
- 🖼️ **Upload & Tampilkan Gambar Barang**
- 🧰 **CRUD Lengkap** di seluruh modul
- 🛡️ **Validasi & Error Handling** user-friendly

---

## 🧱 Teknologi yang Digunakan

| Komponen | Teknologi |
|-----------|------------|
| Backend | [Laravel 10](https://laravel.com) |
| Frontend | Blade Template + Bootstrap |
| Database | MySQL |
| Export File | DomPDF & Maatwebsite/Excel |
| Server-side | PHP >= 8.1 |

---

## ⚙️ Instalasi

Berikut langkah-langkah untuk menjalankan project ini di lokal:

```bash
# 1️⃣ Clone repository
git clone https://github.com/irmasena.m/eksintas.git

# 2️⃣ Masuk ke folder project
cd eksintas

# 3️⃣ Install dependencies
composer install
npm install && npm run dev

# 4️⃣ Copy file environment
cp .env.example .env

# 5️⃣ Konfigurasi database di file .env
DB_DATABASE=laraveldb
DB_USERNAME=root
DB_PASSWORD=

# 6️⃣ Generate key dan migrasi database
php artisan key:generate
php artisan migrate --seed

# 7️⃣ Jalankan server lokal
php artisan serve