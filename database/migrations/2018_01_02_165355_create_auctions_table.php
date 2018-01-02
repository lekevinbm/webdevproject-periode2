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
            $table->date('year')->nullable();
            $table->string('artist')->nullable();
            $table->string('style');
            $table->string('description');
            $table->string('condition');
            $table->string('origin');
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->float('depth')->nullable();
            $table->datetime('startDateTime');
            $table->datetime('endDateTime');
            $table->float('minEstimatePrice');
            $table->float('maxEstimatePrice');
            $table->integer('owner_id')->unsigned();
            $table->timestamps();

            $table->foreign('owner_id')->references('user_id')
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
