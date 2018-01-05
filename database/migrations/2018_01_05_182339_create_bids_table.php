<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('bid_id');
            $table->integer('user_id')->unsigned();
            $table->integer('auction_id')->unsigned();
            $table->float('bidPrice');
            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('auction_id')->references('auction_id')
            ->on('auctions')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
}