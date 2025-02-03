<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('reporter_name');
            $table->string('reporter_email');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->dropColumn(['reporter_name', 'reporter_email']);
        });
    }
};