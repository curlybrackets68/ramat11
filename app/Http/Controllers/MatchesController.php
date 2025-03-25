<?php
namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\MyMatch;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function index()
    {
        $teams   = Team::all();
        $matches = Matches::all();
        return view('matches')->with(compact('teams', 'matches'));
    }

    public function addUpdate(Request $request)
    {
        $team1Id       = $request->team1Id;
        $team2Id       = $request->team2Id;
        $matchDateTime = date('Y-m-d H:i:s', strtotime($request->matchDateTime));

        $data = [
            'team1_id'   => $team1Id,
            'team2_id'   => $team2Id,
            'match_date' => $matchDateTime,
        ];

        $save = Matches::updateOrCreate(['id' => ''], $data);

        if ($save) {
            return redirect()->route('user.matches');
        } else {
            return redirect()->back()->withInput()->withError('Something went wrong');
        }
    }

    public function contestsDetails()
    {
        $today = Carbon::today()->format('Y-m-d');

        $matches = Matches::whereDate('match_date', $today)->get();

        return view('contests', compact('matches'));
    }

    public function matchDetails($id)
    {
        $matches = MyMatch::where('match_id', $id)->get();
        return view('match-details')->with(compact('matches', 'id'));
    }

    public function joinMatch($id)
    {
        $users = User::where('id', '!=', '1')->pluck('name', 'id');
        return view('join-match')->with(compact('id', 'users'));
    }
}
