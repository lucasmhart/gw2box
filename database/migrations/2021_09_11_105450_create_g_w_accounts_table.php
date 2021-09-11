<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGWAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gw_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('gw_id');
            $table->bigInteger('age');
            $table->string('name');
            $table->integer('world');
            $table->string('created');
            $table->boolean('commander');
            $table->integer('fractal_level');
            $table->integer('daily_ap');
            $table->integer('monthly_ap');
            $table->integer('wvw_rank');
            $table->string('last_modified');
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
        Schema::dropIfExists('gw_accounts');
    }
}
