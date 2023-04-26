<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku');
            $table->string('description');
            $table->integer('stock_alert')->default(10);
            // $table->integer('size_type_id')->nullable();
            $table->string('gender')->default('mix');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('size_type_id')->constrained('size_types');
            $table->unsignedBigInteger('discount_id');

            $table->timestamps();
            // $table->foreign('size_type_id')->references('id')->on('size_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
