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
            $table->string('name');
            $table->string('slug');
            $table->string('location')->nullable(true);
            $table->string('frequency')->nullable(true);
            $table->string('requirements')->nullable(true);
            $table->boolean('is_approved')->nullable(true);
            $table->boolean('is_archived')->nullable(true);
            $table->boolean('is_survey')->nullable(true);
            $table->foreignId('created_by')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('updated_by')->nullable(true)->references('id')->on('users')->constrained();
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
