<?php

// app/Models/Pomodoro.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pomodoro extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'duration', 'completed_at'];
}
