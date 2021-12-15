<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currency_id')->unsigned();
            $table->decimal('buy_price', 5, 2);
            $table->decimal('sell_price', 5, 2);
            $table->string('office_id')->nullable();
            $table->dateTime('begins_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('currency_id')->references('id')->on('currencies');
            #$table->foreign('office_id')->references('id')->on('offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}
