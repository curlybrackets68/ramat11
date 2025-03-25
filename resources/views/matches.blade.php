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
                        <button type="submit" class="btn btn-primary">Submit</button>
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
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
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

        $("#matchForm").on("submit", function(event) {
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

            event.preventDefault();


        });
    </script>
@endsection
