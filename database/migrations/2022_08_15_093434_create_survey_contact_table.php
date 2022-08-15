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
        Schema::create('survey_contact', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false)->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->string('email')->nullable(true);
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
        Schema::dropIfExists('survey_contact');
    }
};
