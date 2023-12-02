<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::create('comments', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedInteger('user_id');
    //         $table->foreign('user_id')->references('id')->on('users');
    //         $table->unsignedInteger('comment_id');
    //         $table->foreign('comment_id')->references('id')->on('comments');
    //         $table->string('comment_text');
    //         $table->timestamps();
    //     });
    // }

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            
            // Change the type from unsignedInteger to bigInteger to match the id type in the referenced tables
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users');
            
            // Change the type from unsignedInteger to bigInteger to match the id type in the referenced tables
            $table->unsignedBigInteger('comment_id')->nullable(); // Allow null to represent top-level comments
            $table->foreign('comment_id')->references('id')->on('comments');
            
            $table->string('comment_text');
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
        Schema::dropIfExists('comments');
    }
}