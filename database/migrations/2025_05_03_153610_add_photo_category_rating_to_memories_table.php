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
           if (!Schema::hasColumn('memories', 'location_name')) {
               $table->string('location_name')->nullable()->after('description');
           }
           if (!Schema::hasColumn('memories', 'photo')) {
               $table->string('photo')->nullable();
           }
           if (!Schema::hasColumn('memories', 'category')) {
               $table->string('category')->nullable();
           }
           if (!Schema::hasColumn('memories', 'rating')) {
               $table->integer('rating')->nullable();
           }
       });
   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memories', function (Blueprint $table) {
            if (Schema::hasColumn('memories', 'location_name')) {
                $table->dropColumn('location_name');
            }
            if (Schema::hasColumn('memories', 'photo')) {
                $table->dropColumn('photo');
            }
            if (Schema::hasColumn('memories', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('memories', 'rating')) {
                $table->dropColumn('rating');
            }
        });
    }
};
