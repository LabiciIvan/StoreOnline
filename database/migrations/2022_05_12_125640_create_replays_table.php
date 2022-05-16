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
        Schema::create('replays', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->text('content');
            $table->string('userName');
            $table->string('user_Id');

            $table->unsignedInteger('reviews_id')->nullable();
            $table->foreign('reviews_id')->references('id')->on('reviews');

            $table->unsignedInteger('products_id')->nullable();
            $table->foreign('products_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replays');
    }
};
