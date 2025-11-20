<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('description');
            $table->string('client_name');
            $table->string('location');
            $table->date('completion_date');
            $table->json('images')->nullable(); // array gambar
            $table->string('category'); // contoh: "Residential", "Commercial", "Office"
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};