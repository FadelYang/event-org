<?php

use App\Enum\EventTypeEnum;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('slug')->unique();
            $table->enum('type', EventTypeEnum::toArray());
            $table->longText('description');
            $table->string('location');
            $table->boolean('is_premium');
            $table->integer('ticket_price')->nullable();
            $table->string('potrait_banner')->nullable();
            $table->string('landscape_banner')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
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
        Schema::dropIfExists('events');
    }
};
