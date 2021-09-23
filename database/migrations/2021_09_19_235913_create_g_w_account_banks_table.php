<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGWAccountBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gw_account_banks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gw_account_id')->unsigned();
            $table->foreign('gw_account_id')->references('id')->on('gw_accounts');
            $table->bigInteger('gw_id')->nullable();
            $table->integer('count')->nullable();
            $table->integer('charges')->nullable();
            $table->integer('skin')->nullable();
            $table->text('dyes')->nullable();
            $table->string('upgrades')->nullable();
            $table->string('upgrade_slot_indices')->nullable();
            $table->text('infusions')->nullable();
            $table->string('bindings')->nullable();
            $table->string('binding_to')->nullable();
            $table->text('stats')->nullable();
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
        Schema::dropIfExists('gw_account_banks');
    }
}
