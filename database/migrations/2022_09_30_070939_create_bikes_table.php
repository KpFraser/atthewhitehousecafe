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
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name')->length(100);
            $table->string('slug');
            $table->string('mobile')->nullable(true);
            $table->string('leader')->nullable(true);
            $table->string('assistant')->nullable(true);
            $table->string('image_name')->nullable(true);
            $table->tinyInteger('rating')->nullable(true)->comment('1 for one star rating so on upto 5');
            $table->string('system_name')->nullable(true);
            $table->integer('estimated_cost')->nullable(true);
            $table->integer('actual_cost')->nullable(true);
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
        Schema::dropIfExists('bikes');
    }
};
