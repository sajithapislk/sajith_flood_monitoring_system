@extends('layouts.admin')
@section('title', 'Dashboard - Tess Lanka')
@section('content')
    <div class="container-fluid p-5">
        <div class="card card-default table-borderless">
            <div class="card-header justify-content-between">
                <h2>Risk Users</h2>
            </div>
            <div class="card-body  py-0">
                <table class="table page-view-table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Distance</th>
                            <th>Rain Gate Station ID</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $row)
                            <tr>
                                <td style="width: 5%">{{ $row->id }}</td>
                                <td style="width: 10%">{{ $row->user->name }}</td>
                                <td style="width: 55%">{{ $row->distance }}</td>
                                <td style="width: 10%">{{ $row->monitor_place_id  }}</td>
                                <td style="width: 10%">{{ $row->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
