@extends('layouts.app')

@section('title', 'Tentang Sistem')

@section('contents')
<div class="container py-4">
    <div class="card shadow-lg rounded-3 p-4">
        <h2 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="mb-3 text-info text-center">Tentang Form Pengambilan Material / Barang / Part</h2>

        <p class="text-justify">
            Sistem informasi ini dibuat untuk mendukung kegiatan operasional di 
            <b>PT PLN Indonesia Power UPB Jawa Tengah 2 Adipala</b>. 
            Sebelumnya, proses pengambilan material/barang masih dilakukan secara manual menggunakan form kertas, 
            yang sering kali memakan waktu, berisiko hilang, dan menyulitkan dalam pelacakan data.
        </p>

        <h5 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="mt-4"><b>Tujuan Sistem</b></h5>
        <ol>
            <li>Meningkatkan efisiensi pencatatan material/barang.</li>
            <li>Mengurangi risiko kehilangan data akibat pencatatan manual.</li>
            <li>Menyediakan laporan otomatis yang dapat diakses kapan saja.</li>
            <li>Mendukung transparansi dan akurasi data material.</li>
        </ol>

        <h5 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="mt-4"><b>Manfaat Sistem</b></h5>
        <p class="text-justify">
            Dengan sistem informasi ini, proses pencatatan barang sebagai inventaris menjadi lebih cepat, 
            mudah dicari, dan aman tersimpan dalam database. 
            Hal ini diharapkan mendukung kinerja dan efisiensi operasional perusahaan terutama ruang penyimpanan.
        </p>

        <h5 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="mt-4"><b>Fitur Utama</b></h5>
        <ol>
            <li>Pencatatan pengambilan barang secara digital.</li>
            <li>Manajemen data barang, supplier, dan rekapan laporan otomatis.</li>
            <li>Export laporan ke format Excel / PDF.</li>
            <li>QR Code untuk identifikasi barang.</li>
            <li>Autentikasi pengguna untuk keamanan akses.</li>
        </ol>

        <h5 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="mt-4"><b>Alur Penggunaan Sistem</b></h5>
        <p class="text-justify">
            Pengguna masuk ke sistem menggunakan akun pribadi atau akun baru, 
            kemudian melakukan pencatatan pengambilan barang melalui form digital. 
            Data otomatis tersimpan dalam database, dan laporan dapat diakses atau diekspor tanpa perlu rekap manual.
        </p>

        <h5 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="mt-4"><b>Teknologi yang Digunakan</b></h5>
        <ol>
            <li>Server Portable : Laragon</li>
            <li>Framework : Laravel Version 10.48.29</li>
            <li>Database : phpMyAdmin</li>
            <li>Bahasa Pemrograman : PHP V 8.1.10, JavaScript, HTML, CSS</li>
            <li>Library Tambahan : SB Admin 2, Bootstrap 5, Font Awesome, QR Code Generator</li>
        </ol>

        <div class="mt-4 text-muted small text-center" style="font-style: italic;">
            <i class="fa-solid fa-circle-info"></i> Sistem ini dikembangkan untuk mendukung efisiensi operasional 
            di PT PLN Indonesia Power UPB Jawa Tengah 2 Adipala.
        </div>
    </div>
</div>
@endsection