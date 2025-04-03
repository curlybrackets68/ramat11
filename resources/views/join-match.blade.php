@extends('master')

@section('content')
    <div class="card mt-1 mb-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5>Join Matches</h5>
                <span class="countdown-timer" style="font-weight: bold">Please select any player in 10 seconds</span>
            </div>
        </div>
        <div class="card-body">
            <div id="players-container">
                <div class="row player-row">
                    @foreach ($selectedPlayers as $teamName => $players)
                        <div class="col-md-6">
                            <h4>{{ $teamName }}</h4>
                            @foreach ($players as $player)
                                <div>
                                    <input type="checkbox" class="player-checkbox team1-checkbox" name="players[]"
                                        value="{{ $player->player_id }}" id="player_{{ $player->player_id }}"
                                        {{ !empty($player->user_name) ? 'disabled' : '' }}>
                                    <label for="player_{{ $player->player_id }}">
                                        {{ $player->player_name }}
                                        @if (!empty($player->user_name))
                                            (Selected by: {{ $player->user_name }})
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-footer text-left">
            <button type="submit" class="btn btn-success btn-sm" id="saveContest">Add</button>
            <a href="{{ route('user.join-match', ['id' => $id, 'team1' => $team1Id, 'team2' => $team2Id]) }}"
                class="btn btn-danger btn-sm">Cancel</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            const maxTotalSelection = 1;

            $(document).on('change', '.player-checkbox', function() {
                let selectedCount = $('.player-checkbox:checked').length;

                if (selectedCount > maxTotalSelection) {
                    alert('You can select only 1 players at time.');
                    $(this).prop('checked', false);
                }
            });

            let countdown = 10;

            function updateCountdown() {
                $(".countdown-timer").text(`Please select any player in ${countdown} seconds`);
                if (countdown === 0) {
                    location.reload();
                } else {
                    countdown--;
                    setTimeout(updateCountdown, 1000);
                }
            }

            updateCountdown();
        });

        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });

        $(document).on('click', '#saveContest', function() {
            let matchId = '{{ @$id }}';

            let selectedCount = $('.player-checkbox:checked').length;

            let selectedPlayer = $('.player-checkbox:checked').val();

            if (selectedCount !== 1) {
                alert('Please select exactly 1 player.');
                return;
            }

            let data = {
                matchId: matchId,
                playerId: selectedPlayer,
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
