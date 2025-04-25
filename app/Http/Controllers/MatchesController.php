<?php
namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\MyMatch;
use App\Models\Player;
use App\Models\Playing11;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatchesController extends Controller
{
    public function index()
    {
        $teams   = Team::all();
        $matches = Matches::orderByDesc('id')->get();
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

    public function matchDetails($id, $team1Id, $team2Id)
    {
        $matches = MyMatch::where('match_id', $id)
            ->select('user_id', DB::raw('GROUP_CONCAT(player_id) as player_ids'))
            ->groupBy('user_id')
            ->get();

        $matchInfo = Matches::find($id);
        $matchName = $matchInfo ? $matchInfo->team_1_name . ' vs ' . $matchInfo->team_2_name : 'N/A';
        $matchDate = $matchInfo ? date('d M, Y h:i A', strtotime($matchInfo->match_date)) : 'N/A';
        
        return view('match-details')->with(compact('matches', 'id', 'team1Id', 'team2Id', 'matchName', 'matchDate'));
    }

    public function joinMatch($id, $team1Id, $team2Id)
    {
        $team1Query = Team::find($team1Id, ['name']);
        $team2Query = Team::find($team2Id, ['name']);

        $team1 = Playing11::where('playing11.match_id', $id)->where('playing11.team_id', $team1Id)
        ->join('players', 'players.id', '=', 'playing11.player_id')
        ->leftJoin('my_matches', 'playing11.player_id', '=', 'my_matches.player_id')
        ->leftJoin('users', 'my_matches.user_id', '=', 'users.id')
        ->select('playing11.player_id', 'players.name as player_name', 'users.name as user_name')
        ->get();

        $team2 = Playing11::where('playing11.match_id', $id)->where('playing11.team_id', $team2Id)
            ->join('players', 'players.id', '=', 'playing11.player_id')
            ->leftJoin('my_matches', 'playing11.player_id', '=', 'my_matches.player_id')
            ->leftJoin('users', 'my_matches.user_id', '=', 'users.id')
            ->select('playing11.player_id', 'players.name as player_name', 'users.name as user_name')
            ->get();

        $selectedPlayers = [
            $team1Query->name => $team1,
            $team2Query->name => $team2,
        ];

        return view('join-match')->with(compact('id', 'selectedPlayers', 'team1Id', 'team2Id'));
    }

    public function getPlayers($team1Id, $team2Id, $matchId)
    {
        $data = [];
        if ($team1Id) {
            $team1         = Player::where('team_id', $team1Id)->pluck('name', 'id');
            $data['team1'] = $team1;
        }
        if ($team2Id) {
            $team2         = Player::where('team_id', $team2Id)->pluck('name', 'id');
            $data['team2'] = $team2;
        }

        $team1 = Playing11::where('match_id', $matchId)->where('team_id', $team1Id)->pluck('player_id');
        $team2 = Playing11::where('match_id', $matchId)->where('team_id', $team2Id)->pluck('player_id');

        $selectedPlayers = [
            'team1' => $team1,
            'team2' => $team2,
        ];

        $data['selectedPlayers'] = $selectedPlayers;

        return response()->json(['code' => '1', 'data' => $data]);
    }

    public function savePlaying11(Request $request)
    {
        $matchId = $request->match_id;
        $teamId1 = $request->team_id1;
        $teamId2 = $request->team_id2;

        $team1Players = json_decode($request->team1Players, true);
        $team2Players = json_decode($request->team2Players, true);

        Playing11::where('match_id', $matchId)->where('team_id', $teamId1)->delete();
        Playing11::where('match_id', $matchId)->where('team_id', $teamId2)->delete();

        if (! empty($team1Players)) {
            foreach ($team1Players as $player_id) {
                Playing11::create([
                    'match_id'  => $matchId,
                    'player_id' => $player_id,
                    'team_id'   => $teamId1,
                ]);
            }
        }

        if (! empty($team2Players)) {
            foreach ($team2Players as $player_id) {
                Playing11::create([
                    'match_id'  => $matchId,
                    'player_id' => $player_id,
                    'team_id'   => $teamId2,
                ]);
            }
        }

        return response()->json(['message' => 'Playing 11 saved successfully']);
    }

    public function saveContest(Request $request)
    {
        $matchId   = $request->matchId;
        $userId    = Auth::id();
        $playerId = $request->playerId;

        MyMatch::create([
            'user_id'   => $userId,
            'match_id'  => $matchId,
            'player_id' => $playerId,
        ]);

        return response()->json(['message' => 'Contest Added successfully']);
    }
}
