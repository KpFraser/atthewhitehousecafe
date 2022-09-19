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
        if(!Schema::hasTable('survey_submissions')) {
            Schema::create('survey_submissions', function (Blueprint $table) {
                $table->id();
                //            $table->foreignId('user_id')->nullable(true)->constrained('users')->onDelete('cascade')->onUpdate('cascade');
                $table->foreignId('survey_contact_id')->constrained()->onDelete('cascade');
                $table->string('session_id');
                $table->foreignId('project_id')->nullable(false)->constrained()->onDelete('cascade')->onUpdate('cascade');
                $table->tinyInteger('options')->comment("0 forNever, 1 for participant, 2 for assistant, 3 for Leader");
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_submissions');
    }
};
