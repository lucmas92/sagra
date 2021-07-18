<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receipt_id')->references('id')->on('receipts');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->double('quantity');
            $table->double('price');
            $table->double('discount');
            $table->timestamps();
            $table->unique(['receipt_id', 'product_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_products');
    }
}
