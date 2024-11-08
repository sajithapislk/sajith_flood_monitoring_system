@extends('layouts.admin')
@section('title', 'Dashboard - Flood Monitoring System')

@section('content')
    <div class="container-fluid p-5">
        <div class="card card-default table-borderless">
            <div class="card-header justify-content-between">
                <h2>DM List</h2>
                <button type="button" class="btn btn-primary btn-pill" data-toggle="modal" data-target="#insertModal">
                    Add DM
                </button>
            </div>
            <div class="card-body py-0">
                <table class="table page-view-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>TP</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->tp }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>{{ $row->updated_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-pill edit-btn"
                                        data-id="{{ $row->id }}"
                                        data-name="{{ $row->name }}"
                                        data-email="{{ $row->email }}"
                                        data-tp="{{ $row->tp }}"
                                        data-area-id="{{ $row->area_id }}"
                                        data-toggle="modal" data-target="#editModal">
                                        Edit
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-pill delete-btn"
                                        data-id="{{ $row->id }}" data-toggle="modal" data-target="#deleteModal">
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

    <!-- Insert Modal -->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Add New DM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.dm.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tp">TP</label>
                            <input type="text" name="tp" class="form-control" required>
                            @error('tp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="area_id">Area</label>
                            <input type="number" name="area_id" class="form-control" required>
                            @error('area_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-pill">Add DM</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit DM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" name="email" id="editEmail" class="form-control" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editTp">TP</label>
                            <input type="text" name="tp" id="editTp" class="form-control" required>
                            @error('tp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editAreaId">Area</label>
                            <input type="number" name="area_id" id="editAreaId" class="form-control" required>
                            @error('area_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete DM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure you want to delete this DM?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-pill">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var baseUrl = "{{ url('admin/dm') }}";

        // Delete Action
        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            $('#deleteForm').attr('action', baseUrl + '/' + id);
        });

        // Edit Action
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var tp = $(this).data('tp');
            var areaId = $(this).data('area-id');

            $('#editForm').attr('action', baseUrl + '/' + id);
            $('#editForm #editName').val(name);
            $('#editForm #editEmail').val(email);
            $('#editForm #editTp').val(tp);
            $('#editForm #editAreaId').val(areaId);
        });
    });
</script>
@endsection
