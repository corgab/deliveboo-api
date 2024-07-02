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
        Schema::table('dishes', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->after('id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dishes', function (Blueprint $table) {
            // Rimozione vincolo
            $table->dropForeign(['restaurant_id']);
            // Eliminazione colonna
            $table->dropColumn('restaurant_id');  
        });
    }
};
