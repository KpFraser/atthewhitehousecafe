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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('location')->nullable(true);
            $table->string('frequency')->nullable(true);
            $table->string('requirements')->nullable(true);
            $table->string('leadership')->nullable(true);
            $table->tinyInteger('module')->nullable(true);
            $table->boolean('is_approved')->nullable(true);
            $table->boolean('is_user')->nullable(true);
            $table->boolean('is_archieved')->nullable(true);
            $table->boolean('is_key')->nullable(true);
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
        Schema::dropIfExists('projects');
    }
};
