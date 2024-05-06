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
        Schema::table('data', function (Blueprint $table) {
            // Remove unique constraint from email field
            $table->dropUnique('data_email_unique');

            // Modify columns to disallow null except user_image
            $table->string('email', 255)->nullable(false)->change();
            $table->string('name', 255)->nullable(false)->change();
            $table->string('password', 255)->nullable(false)->change();
            $table->date('birthdate')->nullable(false)->change();
            $table->string('phone', 20)->nullable(false)->change(); // Adjust length to match your data
            $table->string('address', 255)->nullable(false)->change();
            $table->string('user_image', 255)->nullable()->change();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data', function (Blueprint $table) {
            // Restore unique constraint on email field
            $table->unique('email');

            // Restore columns to allow null (except user_image)
            $table->string('email',255)->nullable(true)->change();
            $table->string('name',255)->nullable(true)->change();
            $table->string('password',255)->nullable(true)->change();
            $table->date('birthdate')->nullable(true)->change();
            $table->string('phone',20)->nullable(true)->change();
            $table->string('address',255)->nullable(true)->change();
            $table->string('user_image')->nullable(true)->change();
        });
    }
};
