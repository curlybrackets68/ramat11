@extends('master')

@section('content')
    <div class="card mt-5 mb-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5>Join Matches</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="user_id">User</label>
                        <select id="user_id" class="form-control select2" name="user_id">
                            <option value="">Select User</option>
                            @foreach ($users as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="players-container">
                <div class="row mt-3 player-row">
                    @foreach ($selectedPlayers as $teamName => $players)
                        <div class="col-md-6">
                            <h4>{{ $teamName }}</h4>
                            @foreach ($players as $playerId => $playerName)
                                <div>
                                    <input type="checkbox" class="player-checkbox team1-checkbox" name="players[]"
                                        value="{{ $playerId }}" id="player_{{ $playerId }}">
                                    <label for="player_{{ $playerId }}">{{ $playerName }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-footer text-left">
            <button type="submit" class="btn btn-success" id="saveContest">Save</button>
            <a href="{{ route('user.join-match', ['id' => $id, 'team1' => $team1Id, 'team2' => $team2Id]) }}"
                class="btn btn-danger">Cancel</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            const maxTotalSelection = 5;

            $(document).on('change', '.player-checkbox', function() {
                let selectedCount = $('.player-checkbox:checked').length;

                if (selectedCount > maxTotalSelection) {
                    alert('You can select only 5 players in total.');
                    $(this).prop('checked', false);
                }
            });
        });

        $(document).on('click', '#saveContest', function() {
            let matchId = '{{ @$id }}';
            let userId = $('#user_id').val();

            let teamPlayers = $('.player-checkbox:checked').map(function() {
                return parseInt(this.value);
            }).get();

            if (teamPlayers.length !== 5) {
                alert('Please select exactly 5 players.');
                return;
            }

            if (userId == '') {
                alert('Please select user.');
                return;
            }

            let data = {
                matchId: matchId,
                userId: userId,
                playerIds: JSON.stringify(teamPlayers),
                _token: "{{ csrf_token() }}"
            };

            let url = '{{ route('user.save-contest') }}';

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(response) {
                    location.reload();
                    alert(response.message);
                },
                error: function(xhr) {
                    console.error("Error saving contest:", xhr.responseText);
                }
            });            
        });
    </script>
@endsection
