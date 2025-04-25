@extends('admin::layouts.main')

@php use App\Models\User; @endphp
@section('title', 'Users Management')
@section('main-body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-md-flex justify-content-between">
                        <h4>Users Management</h4>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create User</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <tr>
                                        <th>{{ $user->id }}</th>
                                        <td>{{ $user->name ?? '' }}</td>
                                        <td>{{ $user->email ?? '' }}</td>
                                        <td>
                                            @switch($user->status)
                                                @case(User::STATUS_ACTIVE)
                                                    <span class="badge badge-success px-2">Active</span>
                                                    @break
                                                @case(User::STATUS_INACTIVE)
                                                    <span class="badge badge-secondary px-2">In Active</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-warning px-2">Pending Approve</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($user->role)
                                                @case(User::ADMIN)
                                                    <span class="badge badge-info px-2">Admin</span>
                                                    @break
                                                @case(User::STATUS_INACTIVE)
                                                    <span class="badge badge-primary px-2">System Admin</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-light px-2">User</span>
                                            @endswitch
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.users.edit', $user->uuid) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>

                                            <form action="{{ route('admin.users.destroy', $user->uuid) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else

                            @endif
                            </tbody>
                        </table>
                        <div class="bootstrap-pagination">
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
