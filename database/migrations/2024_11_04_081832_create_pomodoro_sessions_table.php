<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePomodoroSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('pomodoro_sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('duration'); // Duration in minutes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pomodoro_sessions');
    }
};
