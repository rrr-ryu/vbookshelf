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
        Schema::create('book_shelves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('shelf_id')
            ->constrained()
            ->onDelete('cascade');
            $table->integer('place_num');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_shelves');
    }
};
