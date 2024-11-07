@extends('layouts.admin')
@section('title', 'Dashboard - Tess Lanka')

@section('content')
    <div class="container-fluid p-5">
        <div class="card card-default table-borderless">
            <div class="card-header justify-content-between d-flex">
                <h2>Risk Users</h2>

                <!-- Print Button -->
                <button onclick="window.print()" class="btn btn-outline-primary d-print-none">
                    Print
                </button>
            </div>

            <!-- Filter Form -->
            <form method="GET" action="{{ url()->current() }}" class="form-inline d-print-none">
                <div class="form-group mb-2">
                    <label for="start_date" class="mr-2">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>

                <div class="form-group mx-sm-3 mb-2">
                    <label for="end_date" class="mr-2">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>

                <button type="submit" class="btn btn-primary mb-2">Filter</button>
                <a href="{{ url()->current() }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
            </form>
            <!-- End Filter Form -->

            <div class="card-body py-0">
                <table class="table page-view-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>TP</th>
                            <th>Distance</th>
                            <th>Rain Gate Station ID</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $row)
                            <tr>
                                <td style="width: 5%">{{ $row->id }}</td>
                                <td style="width: 10%">{{ $row->user->name }}</td>
                                <td style="width: 10%">{{ $row->user->tp }}</td>
                                <td style="width: 55%">{{ $row->distance }}</td>
                                <td style="width: 10%">{{ $row->monitor_place_id }}</td>
                                <td style="width: 10%">{{ $row->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
