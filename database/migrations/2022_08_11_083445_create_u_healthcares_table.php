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
        Schema::create('u_healthcares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false)->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('emergency_name')->nullable(true);
            $table->string('emergency_contact')->nullable(true);
            $table->string('dr_name')->nullable(true);
            $table->string('dr_contact')->nullable(true);
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
        Schema::dropIfExists('u_healthcares');
    }
};
