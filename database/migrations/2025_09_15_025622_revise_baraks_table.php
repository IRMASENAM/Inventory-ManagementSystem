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
    Schema::table('baraks', function (Blueprint $table) {
        // Cek dulu, kalau belum ada baru tambahkan
        if (!Schema::hasColumn('baraks', 'barang_id')) {
            $table->unsignedBigInteger('barang_id')->after('tgl_keluar');
            
            $table->foreign('barang_id')
                  ->references('id')->on('dabrangs')
                  ->onDelete('cascade');
        }

        // Hapus kolom nama_barang kalau masih ada
        if (Schema::hasColumn('baraks', 'nama_barang')) {
            $table->dropColumn('nama_barang');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baraks', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->dropColumn('barang_id');

            // kembalikan kolom lama kalau rollback
            $table->string('nama_barang')->after('tgl_keluar');
        });
    }
};