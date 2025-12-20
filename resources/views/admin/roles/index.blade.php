


@extends('admin.layouts.app')

@section('title', 'Role Management')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Role Management</h1>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create New User</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table id="rolesTable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'editor' ? 'warning' : 'secondary') }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.roles.edit', $user) }}" class="btn btn-sm btn-outline-primary">Edit Role</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<script>
$(document).ready(function() {
    $('#rolesTable').DataTable({
        pageLength: 10,
        responsive: true,
        order: [[0, 'desc']]
    });
});
</script>
@endsection