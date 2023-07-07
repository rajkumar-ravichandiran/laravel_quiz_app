<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->unsignedBigInteger('category_id');
            $table->index('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->integer('level')->default(1);
            $table->text('choices');
            $table->integer('answer');
            $table->text('summary')->nullable()->default(NULL);
            $table->unsignedBigInteger('created_by');
            $table->index('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
