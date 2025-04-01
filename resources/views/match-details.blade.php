@extends('master')

@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5>My Matches</h5>
                <a href="{{ route('user.join-match', ['id' => $id, 'team1' => $team1Id, 'team2' => $team2Id]) }}"
                    class="btn btn-primary btn-sm">Join Other</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>Match</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $serialNo = 1; @endphp
                    @forelse ($matches as $match)
                        <tr>
                            <th>{{ $serialNo++ }}</th>
                            <th>{{ $match->match_date_time }}</th>
                            <th>{{ $match->user_name }}</th>
                            <th>{{ $match->match_name }}</th>
                            <th><a href="" class="btn btn-primary btn-sm">Completed</a></th>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
