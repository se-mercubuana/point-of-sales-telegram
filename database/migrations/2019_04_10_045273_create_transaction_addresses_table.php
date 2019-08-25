<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_addresses', function (Blueprint $table) {
            $table->primary('id');
            $table->uuid('id');
            $table->unique('id');
            $table->string('full_name');
            $table->text('address');
            $table->string('city');
            $table->uuid('customer_id');
            $table->uuid('customer_address_id');
            $table->timestamps();
        });

        Schema::table('transaction_addresses', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('customer_address_id')->references('id')->on('customer_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_addresses');
    }
}
