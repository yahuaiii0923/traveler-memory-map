<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
   {
       Schema::table('memories', function (Blueprint $table) {
//            $table->string('photo')->nullable()->after('description');
//            $table->string('category')->nullable()->after('photo');
//            $table->unsignedTinyInteger('rating')->nullable()->after('category');
//
           $table->string('location_name')->nullable()->after('description');

       });
   }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memories', function (Blueprint $table) {
        });
    }
};
