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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('dish_name');
            $table->decimal('price', 10, 2);
            $table->string('url');
            $table->decimal('rate_dish', 4, 2)->nullable();
            $table->unsignedBigInteger('rate_dish_sum')->default(0);
            $table->unsignedBigInteger('rate_dish_count')->default(0);
            $table->text('votes')->nullable();
            $table->unsignedBigInteger('restaurant_id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
