<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyMatch extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['user_name', 'match_name', 'match_date_time'];

    function getUserNameAttribute()
    {
        $name = '';
        $query = User::find($this->user_id);
        if ($query) {
            $name = $query->name;
        }
        return $name;
    }

    function getMatchNameAttribute()
    {
        $name = '';
        $query = Matches::find($this->match_id);
        if ($query) {
            $name = $query->team_1_name. ' vs '.$query->team_2_name;
        }
        return $name;
    }

    function getMatchDateTimeAttribute()
    {
        $date = '';
        $query = Matches::find($this->match_id);
        if ($query) {
            $date = date('d M, Y h:i A', strtotime($query->match_date));
        }

        return $date;
    }
}
