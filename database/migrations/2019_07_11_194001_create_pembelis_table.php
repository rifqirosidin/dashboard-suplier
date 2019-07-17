<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tgl_pembelian');
            $table->string('no_sop');
            $table->bigInteger('suplier_id')->unsigned();
            $table->string('nama_barang');
            $table->tinyInteger('jumlah');
            $table->string('satuan');
            $table->integer('harga');

            $table->foreign('suplier_id')->references('id')->on('supliers')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
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
        Schema::dropIfExists('pembelis');
    }
}
