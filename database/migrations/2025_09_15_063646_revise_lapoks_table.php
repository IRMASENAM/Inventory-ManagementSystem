<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lapoks', function (Blueprint $table) {
            // hapus kolom lama
            if (Schema::hasColumn('lapoks', 'nama_barang')) {
                $table->dropColumn('nama_barang');
            }
            if (Schema::hasColumn('lapoks', 'jenis_barang')) {
                $table->dropColumn('jenis_barang');
            }

            // relasi ke tabel dabrangs (data barang)
            if (!Schema::hasColumn('lapoks', 'dabrang_id')) {
                $table->foreignId('dabrang_id')
                    ->nullable()
                    ->after('no_transaksi')
                    ->constrained('dabrangs')
                    ->onDelete('cascade');
            }

            // relasi ke tabel jebrangs (jenis barang)
            if (!Schema::hasColumn('lapoks', 'jebrang_id')) {
                $table->foreignId('jebrang_id')
                    ->nullable()
                    ->after('dabrang_id')
                    ->constrained('jebrangs')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('lapoks', function (Blueprint $table) {
            if (Schema::hasColumn('lapoks', 'dabrang_id')) {
                $table->dropForeign(['dabrang_id']);
                $table->dropColumn('dabrang_id');
            }
            if (Schema::hasColumn('lapoks', 'jebrang_id')) {
                $table->dropForeign(['jebrang_id']);
                $table->dropColumn('jebrang_id');
            }

            // balikin lagi kalau rollback
            $table->string('nama_barang')->nullable();
            $table->string('jenis_barang')->nullable();
        });
    }
};
