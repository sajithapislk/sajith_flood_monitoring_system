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
                            <th>Monitor Place</th>
                            <th>Monitor Place</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $row)
                            <tr>
                                <td style="width: 5%">{{ $row->id }}</td>
                                <td style="width: 10%">{{ $row->risk_user->user->name }}</td>
                                <td style="width: 10%">{{ $row->safety_place->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
