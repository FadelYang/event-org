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
            // $table->unsignedBigInteger('organizer');
            $table->string('slug')->unique();
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
            $table->date('start_time')->nullable();
            $table->date('end_time')->nullable();
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
