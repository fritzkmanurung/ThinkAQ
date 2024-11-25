<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasanganQaTable extends Migration
{
    public function up()
    {
        Schema::create('pasangan_qa', function (Blueprint $table) {
            $table->id('qa_id');
            $table->unsignedBigInteger('text_id');
            $table->text('pertanyaan');
            $table->text('jawaban_guru');
            $table->timestamps();

            $table->foreign('text_id')->references('text_id')->on('teks_bacaan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pasangan_qa');
    }
}
