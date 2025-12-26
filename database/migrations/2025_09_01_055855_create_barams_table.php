<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barams', function (Blueprint $table) {
            $table->id(); // No (auto increment)
            $table->string('no_transaksi'); // No.Transaksi
            $table->date('tgl_masuk'); // Tgl Masuk
            $table->string('nama_supplier'); // Supplier
            $table->string('nama_barang'); // Nama Barang
            $table->string('jenis_barang'); // Jenis Barang
            $table->integer('jumlah_masuk'); // Jumlah Masuk
            $table->decimal('harga_beli', 15, 2); // Harga Beli
            $table->decimal('total_harga', 15, 2); // Total Harga (jumlah_masuk * harga_beli)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barams');
    }
};