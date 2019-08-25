<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->primary('id');
            $table->uuid('id');
            $table->unique('id');
            $table->integer('transaction_number');
            $table->integer('ongkir');
            $table->integer('total');
            $table->string('laba');
            $table->uuid('customer_id');
            $table->uuid('user_id');
            $table->uuid('transaction_status_id');
            $table->uuid('transaction_address_id');


            $table->string('no_resi')->nullable();
            $table->timestamp('transfer_date')->nullable();
            $table->timestamp('send_date')->nullable();
            $table->uuid('bank_id')->nullable();


//            $table->tinyInteger('quantity');
            $table->timestamps();
        });


        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('transaction_status_id')->references('id')->on('transaction_statuses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transaction_address_id')->references('id')->on('transaction_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
