<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('auction_id');
            $table->string('status');
            $table->string('title');
            $table->integer('year')->nullable();
            $table->string('artist')->nullable();
            $table->string('style');
            $table->string('description');
            $table->string('condition');
            $table->string('origin');
            $table->float('width');
            $table->float('height');
            $table->float('depth')->nullable();
            $table->datetime('endDateTime');
            $table->float('minEstimatePrice');
            $table->float('maxEstimatePrice');
            $table->float('buyOutPrice')->nullable();
            $table->integer('owner_id')->unsigned();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')
            ->on('users')
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
        Schema::dropIfExists('auctions');
    }
}
