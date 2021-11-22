<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGWAccountUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gw_account_updates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gw_account_id')->unsigned();
            $table->foreign('gw_account_id')->references('id')->on('gw_accounts');
            $table->dateTime('account')->nullable();
            $table->dateTime('achievements')->nullable();
            $table->dateTime('bank')->nullable();
            $table->dateTime('dailycrafting')->nullable();
            $table->dateTime('dungeons')->nullable();
            $table->dateTime('dyes')->nullable();
            $table->dateTime('emotes')->nullable();
            $table->dateTime('finishers')->nullable();
            $table->dateTime('gliders')->nullable();
            $table->dateTime('home_cats')->nullable();
            $table->dateTime('home_nodes')->nullable();
            $table->dateTime('inventory')->nullable();
            $table->dateTime('legendaryarmory')->nullable();
            $table->dateTime('luck')->nullable();
            $table->dateTime('mailcarriers')->nullable();
            $table->dateTime('mapchests')->nullable();
            $table->dateTime('masteries')->nullable();
            $table->dateTime('mastery_points')->nullable();
            $table->dateTime('materials')->nullable();
            $table->dateTime('minis')->nullable();
            $table->dateTime('mounts_skins')->nullable();
            $table->dateTime('mounts_types')->nullable();
            $table->dateTime('novelties')->nullable();
            $table->dateTime('outfits')->nullable();
            $table->dateTime('pvp_heroes')->nullable();
            $table->dateTime('raids')->nullable();
            $table->dateTime('recipes')->nullable();
            $table->dateTime('skins')->nullable();
            $table->dateTime('titles')->nullable();
            $table->dateTime('wallet')->nullable();
            $table->dateTime('worldbosses')->nullable();
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
        Schema::dropIfExists('gw_account_updates');
    }
}
