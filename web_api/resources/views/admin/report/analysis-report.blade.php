@extends('layouts.admin')
@section('title', 'Dashboard - Flood Monitoring System')
@section('content')
    <div class="container-fluid p-5">
        <div class="card card-default table-borderless">
            <div class="card-header justify-content-between d-flex">
                <h2>Flood Status List</h2>

                <!-- Print Button -->
                <button onclick="window.print()" class="btn btn-outline-primary d-print-none">
                    Print
                </button>
            </div>

            <!-- Filter Form -->
            <form method="GET" action="{{ url()->current() }}" class="form-inline d-print-none px-3">
                <div class="form-group mb-2">
                    <label for="start_date" class="mr-2">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>

                <div class="form-group mx-sm-3 mb-2">
                    <label for="end_date" class="mr-2">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>

                <div class="form-group mb-2">
                    <label for="month" class="mr-2">Month:</label>
                    <select name="month" id="month" class="form-control">
                        <option value="">Select Month</option>
                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $month, 10)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mx-sm-3 mb-2">
                    <label for="year" class="mr-2">Year:</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">Select Year</option>
                        @foreach (range(date('Y'), date('Y') - 10) as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mb-2">Filter</button>
                <a href="{{ url()->current() }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
            </form>
            <!-- End Filter Form -->

            <div class="card-body py-0">
                <table class="table page-view-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Risk User Count</th>
                            <th>Risk Confirmation Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                            <tr>
                                <td>{{ $row['date'] }}</td>
                                <td>{{ $row['risk_user_count'] }}</td>
                                <td>{{ $row['risk_confirmation_count'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Trigger the print dialog when the print button is clicked
        function printPage() {
            window.print();
        }
    </script>
@endsection
