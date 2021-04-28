<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseOfStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_of_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('header');
            $table->string('title');
            $table->enum('class', ['First Grade','Second Grade','Third Grade','Fourth Grade','Fifth Grade','Sixth Grade']);
            $table->text('description')->nullable();
            $table->text('path');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_of_studies');
    }
}
