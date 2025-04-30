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
        Schema::table('user_manuals', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->after('id');

            // Add foreign key if desired
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_manuals', function (Blueprint $table) {
            //
        });
    }
};
