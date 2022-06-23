<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /**
     * # Create a migration that creates all tables for the following user stories
     *
     * For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
     * To not introduce additional complexity, please consider only one cinema.
     *
     * Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.
     *
     * ## User Stories
     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out
     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different locations
     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat
     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        Schema::create('movies', function ($table) {
            $table->increments('id');
            $table->string('movie_name');
            $table->timestamps();
        });

        Schema::create('pricing', function ($table) {
            $table->increments('id');
            $table->BigInt('amount');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('discount_percentage')->default(0);
            $table->integer('premium_percentage')->default(0);
            $table->integer('movie_id')->unsigned();
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('seatings', function ($table) {
            $table->increments('id');
            $table->BigInt('amount');
            $table->enum('seat_type', ['vip', 'couple', 'super vip', 'regular'])->default('regular');
            $table->dateTime('book_start_time');
            $table->dateTime('book_end_time');
            $table->BigInt('seat_number');
            $table->integer('movie_id')->unsigned();
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
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
    }
}
