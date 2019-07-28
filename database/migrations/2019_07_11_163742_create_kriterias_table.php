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
            $table->tinyInteger('metode_pembayaran')->default('0');
            $table->tinyInteger('kualitas')->default('0');
            $table->tinyInteger('waktu_pengiriman')->default('0');
            $table->tinyInteger('harga_barang')->default('0');
            $table->float('total_nilai')->default('0');
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
