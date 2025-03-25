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
        </div>
    </div>
@endsection
