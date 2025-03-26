@extends('master')

@section('content')
    <div class="card mt-5">
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
                    <div class="col-md-3">
                        <label for="user_id">Select Player</label>
                        <select class="form-control select2 user-select" name="user_ids[]">
                            <option value="">Select Player</option>
                            @foreach ($users as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-primary add-player btn-sm ms-2">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
