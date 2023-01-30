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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('title');
            $table->text('url');
            $table->foreignId('type_id')
            ->constrained();
            $table->foreignId('site_name_id')
            ->constrained();
            $table->foreignId('genre_id')
            ->constrained();
            $table->boolean('finish');
            $table->integer('read_page');
            $table->integer('all_page');
            $table->integer('assessment');
            $table->foreignId('book_color_id')
            ->constrained();
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
        Schema::dropIfExists('books');
    }
};
