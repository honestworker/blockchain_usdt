<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('gateimg')->nullable();
            $table->string('minamo')->default(0);
            $table->string('maxamo')->default(0);
            $table->string('chargefx')->default(0);
            $table->string('chargepc')->default(0);
            $table->string('rate')->default(0);
            $table->string('val1')->nullable();
            $table->string('val2')->nullable();
            $table->string('currency')->nullable();
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
        Schema::dropIfExists('gateways');
    }
}
