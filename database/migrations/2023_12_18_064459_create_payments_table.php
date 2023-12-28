<?php

use App\Enum\PaymentStatusEnum;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('snap_token')->nullable();
            $table->enum('status', PaymentStatusEnum::toArray());
            $table->unsignedBigInteger('user_id');
            // item detail will container key value item of order detail like ticket quantity and ticket
            $table->json('item_detail');
            $table->json('customer_detail');
            $table->string('checkout_link')->nullable();
            $table->bigInteger('total_price');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
