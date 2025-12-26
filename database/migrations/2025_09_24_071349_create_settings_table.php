<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            // kolom pengaturan umum
            $table->string('theme')->default('light'); // light / dark
            $table->string('language')->default('id'); // id / en
            $table->boolean('notif')->default(true);   // email notif
            $table->string('dashboard')->default('statistik'); // halaman default
            
            $table->timestamps();

            // relasi ke users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};