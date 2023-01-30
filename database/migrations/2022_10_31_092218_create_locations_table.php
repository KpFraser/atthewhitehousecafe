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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('address_1');
            $table->string('address_2')->nullable(true);
            $table->string('city');
            $table->string('postcode');
            $table->string('country');
            $table->string('repeat_time')->nullable(true);
            $table->string('repeat_every')->nullable(true);
            $table->string('repeat_on')->nullable(true);
            $table->boolean('never')->nullable(true);
            $table->date('on')->nullable(true);
            $table->integer('after')->nullable(true);
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
        Schema::dropIfExists('locations');
    }
};
