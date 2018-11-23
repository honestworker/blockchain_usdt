<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWmethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wmethods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('minamo')->default(0);
            $table->string('maxamo')->default(0);
            $table->string('fixed_charge')->default(0);
            $table->string('percent_charge')->default(0);
            $table->string('rate')->default(0);
            $table->string('val1')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('wmethods');
    }
}
