<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pods', function (Blueprint $table) {
            $table->string('kategori_perawatan')->nullable()->after('jenis_pod');
            $table->string('tipe_pod')->nullable()->after('kategori_perawatan');
        });
    }

    public function down(): void
    {
        Schema::table('pods', function (Blueprint $table) {
            $table->dropColumn(['kategori_perawatan', 'tipe_pod']);
        });
    }
};