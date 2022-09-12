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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('text1')->nullable(true);
            $table->string('text2')->nullable(true);
            $table->string('text3')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('ref1_email')->nullable(true);
            $table->string('ref2_email')->nullable(true);
            $table->foreignId('created_by')->nullable(true)->references('id')->on('users')->constrained()->onDelete('cascade')->nullable(true);
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
        Schema::dropIfExists('applications');
    }
};
