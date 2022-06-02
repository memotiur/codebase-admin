<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->string('slug')->nullable();
            $table->longText('post_details');
            $table->string('featured_image')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedInteger('author_id');
            $table->integer('publish_status')->default(1);  //Publish=1, Unpublish=0; Draft=2, Scheduled=3
            $table->boolean('pin_post')->default(false);
            $table->dateTime('schedule_time')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references("id")->on("categories");
/*            $table->foreign('author_id')->references("id")->on("users");*/
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
};
