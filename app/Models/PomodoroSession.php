<?php

namespace App\Models;
use App\Http\Controllers\Pomodoro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PomodoroSession extends Model
{
    use HasFactory;
    protected $fillable = ['duration'];
}
