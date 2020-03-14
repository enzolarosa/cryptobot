<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArbitrageDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arbitrage_data', function (Blueprint $table) {
            $table->id();
            $table->uuid('execution');

            $table->string('coin')->nullable();
            $table->string('buy_exchange')->nullable();
            $table->string('buy_price')->nullable();
            $table->string('sell_exchange')->nullable();
            $table->string('sell_price')->nullable();
            $table->decimal('profit')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arbitrage_data');
    }
}
