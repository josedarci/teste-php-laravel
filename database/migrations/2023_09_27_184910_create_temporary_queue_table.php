<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryQueueTable extends Migration
{
    public function up()
    {
        Schema::create('temporary_queue', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->string('titulo');
            $table->text('conteudo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('temporary_queue');
    }
}
