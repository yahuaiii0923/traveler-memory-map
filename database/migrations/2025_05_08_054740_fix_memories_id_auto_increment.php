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
        Schema::table('memories', function (Blueprint $table) {
            // Drop the existing id column if it is not auto-incrementing
            $table->dropColumn('id');

            // Re-add the id column as an auto-incrementing primary key
            $table->id()->first();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memories', function (Blueprint $table) {
            // Rollback to the previous state (just drop the id column to avoid errors)
            $table->dropColumn('id');

            // Optionally, you can restore the id column without auto-increment
            $table->bigInteger('id')->first();
        });
    }
};
