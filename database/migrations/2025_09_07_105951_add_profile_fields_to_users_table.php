<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_telepon', 20)->nullable()->after('email');
            $table->string('jabatan', 100)->nullable()->after('no_telepon');
            $table->string('divisi', 100)->nullable()->after('jabatan');
            $table->string('alamat', 255)->nullable()->after('divisi');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_telepon', 'jabatan', 'divisi', 'alamat']);
        });
    }
};
