<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeksBacaanTable extends Migration
{
    public function up()
    {
        Schema::create('teks_bacaan', function (Blueprint $table) {
            $table->id('text_id');
            $table->string('judul');
            $table->text('isi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teks_bacaan');
    }
}
