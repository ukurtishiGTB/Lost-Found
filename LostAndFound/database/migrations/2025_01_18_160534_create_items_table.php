<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('location');
        $table->string('category');
        $table->string('image')->nullable(); // Add this line if it's missing
        $table->string('status');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamp('date_found')->nullable();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};