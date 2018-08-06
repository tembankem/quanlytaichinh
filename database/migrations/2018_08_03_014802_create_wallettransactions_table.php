<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWallettransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallettransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('exchange')->unsigned();
            $table->string('note')->nullable();
            $table->unsignedInteger('receive_wallet_id');
            $table->unsignedInteger('wallet_id');
            $table->timestamps();

            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('restrict');
            $table->foreign('receive_wallet_id')->references('id')->on('wallets')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallettransactions');
    }
}
