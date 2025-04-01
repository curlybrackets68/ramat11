@extends('master')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            @forelse ($matches as $match)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-dark text-white text-center py-4">
                            <h5 class="mb-0">Match of the Day</h5>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary mb-3">
                                <strong>{{ $match->team_1_name }}</strong> vs <strong>{{ $match->team_2_name }}</strong>
                            </h5>
                            <p class="text-muted mb-3">
                                <i class="fas fa-calendar-day"></i>
                                <strong>Date&Time:</strong>
                                {{ $match->display_match_date_time }}
                            </p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('user.match-details', ['id' => $match->id, 'team1' => $match->team1_id, 'team2' => $match->team2_id]) }}" class="btn btn-info btn-sm mx-2">Bet</a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">Stay tuned for an exciting match!</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No matches scheduled for today.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
