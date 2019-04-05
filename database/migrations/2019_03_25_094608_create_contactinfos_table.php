<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactinfos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->string('phonenumber');
            $table->string('email');
            $table->string('name');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('gmail');
            $table->string('youtube');
            $table->string('linkedin');
            $table->string('about_us');
            $table->string('office_info');
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
        Schema::dropIfExists('contactinfos');
    }
}
