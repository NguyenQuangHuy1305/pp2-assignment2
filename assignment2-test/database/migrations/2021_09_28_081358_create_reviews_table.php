<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->references('id')->on('products'); // foreign key
            $table->integer('user_id')->references('id')->on('users'); // foreign key
            $table->integer('user_name')->references('name')->on('users'); // foreign key
            $table->integer('review_rating');
            $table->string('review_content');
            $table->integer('like_count');
            $table->integer('dislike_count');
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
        Schema::dropIfExists('reviews');
    }
}
