<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBiayaUmrahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_biaya_umrahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->double('nominal')->nullable();
            $table->unsignedInteger('urutan')->nullable();
            $table->unsignedBigInteger('paket_tabungan_umrah_id')->nullable();
            $table->unsignedBigInteger('icon_file_id')->nullable();
            $table->timestamps();

            $table->foreign('paket_tabungan_umrah_id')->references('id')->on('paket_tabungan_umrahs')->onDelete('set null');
             $table->foreign('icon_file_id')->references('id')->on('files')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_biaya_umrahs');
    }
}
