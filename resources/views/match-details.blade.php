@extends('master')

@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5>My Matches</h5>
                <a href="{{ route('user.join-match', ['id' => $id]) }}" class="btn btn-primary btn-sm">Join Other</a>
            </div>
        </div>
        <div class="card-body">

        </div>
    </div>
@endsection
