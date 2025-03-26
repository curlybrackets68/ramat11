@extends('master')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h5>Add Matches</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.add-update-match') }}" id="matchForm">
                @csrf
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="team1Id">Select Team 1:</label>
                            <select id="team1Id" class="form-control select2" name="team1Id">
                                <option value="">Select Team 1</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="team2Id">Select Team 2:</label>
                        <select id="team2Id" class="form-control select2" name="team2Id">
                            <option value="">Select Team 2</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="matchDateTime">Date and Time:</label>
                        <input type="text" id="matchDateTime" class="form-control" name="matchDateTime"
                            placeholder="Select Date and Time">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="addMatch">Submit</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>List</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Team 1</th>
                        <th>Team 2</th>
                        <th>Date and Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $serialNo = 1;
                    @endphp
                    @forelse ($matches as $row)
                        <tr>
                            <td>{{ $serialNo++ }}</td>
                            <td>{{ $row->team_1_name }}</td>
                            <td>{{ $row->team_2_name }}</td>
                            <td>{{ $row->display_match_date_time }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm open-modal"
                                    data-match-id="{{ $row->id }}" data-team1-id="{{ $row->team1_id }}"
                                    data-team2-id="{{ $row->team2_id }}" data-team1="{{ $row->team_1_name }}"
                                    data-team2="{{ $row->team_2_name }}">
                                    Add Playing 11
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Matches Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="playing11Modal" tabindex="-1" aria-labelledby="playing11ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Playing 11 for <span id="matchTitle"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="playing11Form">
                        @csrf
                        <input type="hidden" name="match_id" id="matchId">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 id="team1Title"></h6>
                                <div id="team1Players"></div>
                                <p class="text-danger"><small>Selected: <span id="team1Count">0</span>/11</small></p>
                            </div>
                            <div class="col-md-6">
                                <h6 id="team2Title"></h6>
                                <div id="team2Players"></div>
                                <p class="text-danger"><small>Selected: <span id="team2Count">0</span>/11</small></p>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-success">Save Playing 11</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            flatpickr("#matchDateTime", {
                enableTime: true,
                dateFormat: "d-m-Y h:i K",
                minDate: "today",
            });
        });

        $("#addMatch").on("click", function(event) {
            event.preventDefault();

            var team1Selected = $('#team1Id').val() != '';
            var team2Selected = $('#team2Id').val() != '';

            if (!team1Selected) {
                alert("Please select Team 1.");
                return false;
            }

            if (!team2Selected) {
                alert("Please select Team 2.");
                return false;
            }

            $('#matchForm').submit();

        });

        $('.open-modal').click(function() {
            let matchId = $(this).data('match-id');
            let team1 = $(this).data('team1');
            let team2 = $(this).data('team2');

            $('#matchTitle').text(team1 + ' vs ' + team2);
            $('#matchId').val(matchId);
            $('#team1Title').text(team1).attr('data-team-id', $(this).data('team1-id'));
            $('#team2Title').text(team2).attr('data-team-id', $(this).data('team2-id'));

            let team1Players = ['Player 1', 'Player 2', 'Player 3', 'Player 4', 'Player 5', 'Player 6', 'Player 7',
                'Player 8', 'Player 9', 'Player 10', 'Player 11', 'Player 12', 'Player 13'
            ];
            let team2Players = ['Player A', 'Player B', 'Player C', 'Player D', 'Player E', 'Player F', 'Player G',
                'Player H', 'Player I', 'Player J', 'Player K', 'Player L', 'Player M'
            ];

            $('#team1Players').html(team1Players.map(player =>
                `<div><input type="checkbox" class="player-checkbox team1-checkbox" name="players[]" value="${player}"> ${player}</div>`
            ).join(''));
            $('#team2Players').html(team2Players.map(player =>
                `<div><input type="checkbox" class="player-checkbox team2-checkbox" name="players[]" value="${player}"> ${player}</div>`
            ).join(''));

            $('#team1Count').text(0);
            $('#team2Count').text(0);

            $('#playing11Modal').modal('show');
        });

        $(document).on('change', '.team1-checkbox', function() {
            let team1Selected = $('.team1-checkbox:checked').length;
            $('#team1Count').text(team1Selected);

            if (team1Selected > 11) {
                this.checked = false;
                alert('You can select only 11 players from Team 1.');
                $('#team1Count').text(11);
            }
        });

        $(document).on('change', '.team2-checkbox', function() {
            let team2Selected = $('.team2-checkbox:checked').length;
            $('#team2Count').text(team2Selected);

            if (team2Selected > 11) {
                this.checked = false;
                alert('You can select only 11 players from Team 2.');
                $('#team2Count').text(11);
            }
        });

        $('#playing11Form').submit(function(e) {
            e.preventDefault();

            let matchId = $('#matchId').val();
            let team1Players = $('.team1-checkbox:checked').map(function() {
                return this.value;
            }).get();
            let team2Players = $('.team2-checkbox:checked').map(function() {
                return this.value;
            }).get();

            if (team1Players.length !== 11 || team2Players.length !== 11) {
                alert('Please select exactly 11 players for each team.');
                return;
            }

            let playersTeamWise = {
                team1: team1Players,
                team2: team2Players,
            };


            let playing11Data = [{
                match_id: matchId,
                players: playersTeamWise,
                team_id1: $('#team1Title').data('team-id'),
                team_id2: $('#team2Title').data('team-id'),
                _token: "{{ csrf_token() }}"
            }];

            console.log(playing11Data);
            return false;
        });
    </script>
@endsection
