<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 20)->default('post');

            $table->text('title');
            $table->text('slug')->nullable();
            $table->text('content')->nullable();
            $table->text('source')->nullable();
            $table->text('excerpt')->nullable();

            $table->integer('author')->default(0);
            $table->tinyInteger('publish')->default(0);
            $table->integer('parent_id')->nullable();
            $table->integer('order')->default(0);
            $table->integer('comment_status')->default(0);
            $table->integer('comment_count')->default(0);
            $table->integer('pinned')->default(0);
            $table->string('layout')->nullable();
            $table->datetime('published_at')->nullable();
            
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
        Schema::dropIfExists('posts');
    }
}
