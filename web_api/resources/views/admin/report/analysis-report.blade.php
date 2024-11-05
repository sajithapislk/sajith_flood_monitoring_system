@extends('layouts.admin')
@section('title', 'Dashboard -  Flood Monitoring System')
@section('content')
    <div class="container-fluid p-5">
        <div class="card card-default table-borderless">
            <div class="card-header justify-content-between">
                <h2>Flood Status List</h2>
            </div>
            <div class="card-body  py-0">
                <table class="table page-view-table ">
                    <thead>
                        <tr>
                            <th>date</th>
                            <th>risk_user_count</th>
                            <th>risk_confirmation_count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                            <tr>
                                <td>{{ $row["date"] }}</td>
                                <td>{{ $row["risk_user_count"] }}</td>
                                <td>{{ $row["risk_confirmation_count"] }}</td>
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

    </script>
@endsection
