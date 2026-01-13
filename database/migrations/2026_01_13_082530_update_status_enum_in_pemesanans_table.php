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
        // Ubah enum status dari 'pending' menjadi 'menunggu'
        DB::statement("ALTER TABLE pemesanans MODIFY COLUMN status ENUM('menunggu', 'proses', 'selesai', 'dibatalkan') DEFAULT 'menunggu'");
        
        // Update data yang ada dari 'pending' menjadi 'menunggu'
        DB::statement("UPDATE pemesanans SET status = 'menunggu' WHERE status = 'pending'");
    }

    public function down(): void
    {
        // Update data kembali ke 'pending'
        DB::statement("UPDATE pemesanans SET status = 'pending' WHERE status = 'menunggu'");
        
        // Kembalikan enum
        DB::statement("ALTER TABLE pemesanans MODIFY COLUMN status ENUM('pending', 'proses', 'selesai', 'dibatalkan') DEFAULT 'pending'");
    }
};
