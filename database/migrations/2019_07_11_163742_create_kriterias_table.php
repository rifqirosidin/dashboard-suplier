<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('metode_pembayaran');
            $table->tinyInteger('kualitas');
            $table->tinyInteger('waktu_pengiriman');
            $table->tinyInteger('harga_barang');
            $table->float('total_nilai');
            $table->bigInteger('suplier_id')->unsigned();
            $table->foreign('suplier_id')->references('id')->on('supliers')->onDelete('CASCADE');
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
        Schema::dropIfExists('kriterias');
    }
}
