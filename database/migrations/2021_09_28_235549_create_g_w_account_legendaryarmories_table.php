<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGWAccountLegendaryarmoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gw_account_legendaryarmory', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gw_account_id')->unsigned();
            $table->foreign('gw_account_id')->references('id')->on('gw_accounts');
            $table->bigInteger('gw_id');
            $table->integer('count');
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
        Schema::dropIfExists('gw_account_legendaryarmory');
    }
}
