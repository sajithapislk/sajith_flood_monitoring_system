@extends('layouts.admin')
@section('title', 'Dashboard -  Flood Monitoring System')
@section('content')
    <div class="container-fluid p-5">
        <div class="row">
            @foreach ($filter as $row)
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="media widget-media p-4 rounded bg-white border">
                        <i class="mdi mdi-diamond text-success mr-4"></i>
                        <div class="media-body align-self-center">
                            <h4 class="text-primary mb-2">{{ $row["status"]["water_level"]}}</h4>
                            <p>{{ $row["place"]["name"] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card card-default table-borderless">
            <div class="card-header justify-content-between">
                <h2>Flood Status List</h2>
            </div>
            <div class="card-body  py-0">
                <table class="table page-view-table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Monitor Place</th>
                            <th>Water lavel</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                            <tr>
                                <td style="width: 5%">{{ $row->id }}</td>
                                <td style="width: 10%">{{ $row->monitor_place->name }}</td>
                                <td style="width: 55%">{{ $row->water_level }}</td>
                                <td style="width: 10%">{{ $row->created_at }}</td>
                                <td style="width: 10%">{{ $row->updated_at }}</td>
                                <td style="width: 5%">
                                    <button type="button" class="btn btn-primary btn-pill delete-btn" data-toggle="modal"
                                        data-target="#deleteModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/flood-status') }}" method="post" id="editForm">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputName">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-pill">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/flood-status') }}" method="post" id="deleteForm">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <p class="mb-5">
                            Are you sure that want to delete
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-pill">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("table").on("click", ".delete-btn", function() {
                var id = $(this).parents('tr').find("td:eq(0)").text();
                $('#deleteForm').attr('action', website + "/admin/flood-status/" + id);
            });
            $("table").on("click", ".edit-btn", function() {
                var id = $(this).parents('tr').find("td:eq(0)").text();
                var name = $(this).parents('tr').find("td:eq(1)").text();
                $('#editForm').attr('action', website + "/admin/flood-status/" + id);
                $('#editForm input[name="name"]').val(name);
            });
        });
    </script>
@endsection
