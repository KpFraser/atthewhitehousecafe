<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->nullable(true)->constrained()->onDelete('cascade');
            $table->integer('time_period')->nullable(true)->comment('1 for morning/cook, 2 for noon/clean, 3 for afternoon/stock');
            $table->string('comment')->nullable(true);
            $table->integer('status')->nullable(true)->comment('1 for true, 2 for false');
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
        Schema::dropIfExists('user_attendances');
    }
};
