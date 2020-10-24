<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->string('slug')->unique();
            $table->string('title');

            $table->text('excerpt')->nullable();

            $table->text('content_raw');
            $table->text('content_html');

            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();


            $table->timestamps();
            $table->softDeletes();

            $table->index('is_published');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('news_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}