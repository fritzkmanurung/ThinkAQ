<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id('ans_id');
            $table->unsignedBigInteger('qa_id');
            $table->unsignedBigInteger('user_id');
            $table->text('isi');
            $table->integer('nilai')->nullable(); // Nilai nullable jika belum dinilai
            $table->timestamps();

            $table->foreign('qa_id')->references('qa_id')->on('pasangan_qa')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jawaban');
    }
}
