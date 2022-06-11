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
        Schema::create('imags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('pathOne')->default('0');
            $table->string('pathTwo')->default('0');
            $table->string('pathThree')->default('0');
            $table->unsignedInteger('products_id')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imags');
    }
};
