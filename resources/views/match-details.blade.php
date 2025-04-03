@extends('master')

@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <span style="font-weight: bold;">{{ $matchName }} </span>
                <span style="font-weight: bold;">Time: {{ $matchDate }}</span>
                <a href="{{ route('user.join-match', ['id' => $id, 'team1' => $team1Id, 'team2' => $team2Id]) }}"
                    class="btn btn-primary btn-sm">Join Other</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>User Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $serialNo = 1; @endphp
                    @forelse ($matches as $match)
                        <tr>
                            <th>{{ $serialNo++ }}</th>
                            <th>{{ Str::ucfirst($match->user_name) }}</th>
                            <th><a href="" class="btn btn-primary btn-sm" data-match-id="{{ $id }}"
                                    data-user-id="{{ $match->user_id }}">Completed</a></th>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
