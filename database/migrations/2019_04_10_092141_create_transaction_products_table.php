<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_products', function (Blueprint $table) { $table->primary('id');
            $table->uuid('id');
            $table->unique('id');
            $table->integer('transaction_number');
            $table->uuid('product_log_id');
            $table->tinyInteger('quantity');
            $table->timestamps();
        });


        Schema::table('transaction_products', function (Blueprint $table) {
            $table->foreign('product_log_id')->references('id')->on('product_logs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_products');
    }
}
