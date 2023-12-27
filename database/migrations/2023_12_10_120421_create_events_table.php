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
            $table->string('organizer_name');
            $table->string('PIC_email');
            $table->string('PIC_phone_number');
            $table->enum('type', EventTypeEnum::toArray());
            $table->longText('description');
            $table->string('location');
            $table->boolean('is_premium');
            $table->boolean('is_publish');
            $table->boolean('is_online');
            $table->string('potrait_banner')->nullable();
            $table->string('landscape_banner')->nullable();
            $table->date('start_date');
            $table->integer('total_day');
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
