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
        Schema::create('deleted_reasons', function (Blueprint $table) {
            $table->id();
            $table->text('reason');
            $table->foreignId('admin_id')->cascadeOnDelete(
                table: 'users', indexName: 'admin_id'
            );
            $table->foreignId('user_id')->cascadeOnDelete(
                table: 'users', indexName: 'user_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deleted_reasons');
    }
};
