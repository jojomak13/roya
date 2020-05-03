<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('barcode')->uniquie();
            $table->string('reference_number')->nullable();
            $table->string('merchant_ref_number')->nullable();
            $table->double('total_price', 8, 2);
            $table->enum('status', ['unpaid', 'payment_pending', 'preparing', 'shipping', 'completed', 'error']);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
