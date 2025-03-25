<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $table = 'matches';

    protected $fillable = ['team1_id', 'team2_id', 'match_date'];

    protected $appends = ['team_1_name', 'team_2_name', 'display_match_date_time'];

    function getTeam1NameAttribute()
    {
        $name = '';
        $team = Team::find($this->team1_id);
        if ($team) {
            $name = $team->name;
        }
        return $name;
    }

    function getTeam2NameAttribute()
    {
        $name = '';
        $team = Team::find($this->team2_id);
        if ($team) {
            $name = $team->name;
        }
        return $name;
    }

    function getDisplayMatchDateTimeAttribute() 
    {
        return !empty($this->match_date) ? date('d M, Y h:i A', strtotime($this->match_date)) : '';
    }
}
