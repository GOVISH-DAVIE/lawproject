<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('date'); 
            $table->string('location');
            $table->integer('amount');
            $table->longText('des')->nullable();
            $table->string('email');
            $table->string('tel')->nullable();
            $table->longText('docs');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /** 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
