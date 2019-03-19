<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('Title');
            $table->string('Description');
            $table->string('Author');
            $table->integer('main_id')->unsigned();
            $table->integer('sub_id')->unsigned();
            $table->integer('mini_id')->unsigned();
            $table->integer('Main_price')->unsigned();
            $table->integer('Discount_price')->unsigned();
            $table->string('Image');
            $table->string('file');
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
}
