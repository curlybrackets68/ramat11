<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playing11 extends Model
{
    use HasFactory;

    protected $table = 'playing11';

    protected $fillable = ['match_id', 'player_id', 'team_id'];
    
}
