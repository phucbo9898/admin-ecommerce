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
                        <table class="table table-striped user-list">
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
                                            <button
                                                type="button"
                                                class="btn btn-primary address-user"
{{--                                                data-toggle="modal"--}}
                                                data-user-uuid="{{ $user->uuid }}"
                                                data-user-name="{{ $user->name }}"
                                                data-url="{{ route('admin.users.listAddressByUser', $user->uuid) }}"
                                            >
                                                <i class="fa fa-map-marker"></i> View Address
                                            </button>

                                            <a href="{{ route('admin.users.edit', $user->uuid) }}" class="btn btn-primary ml-2"><i class="fa fa-edit"></i> Edit</a>

                                            <form action="{{ route('admin.users.destroy', $user->uuid) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ml-2"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No record</td>
                                </tr>
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

    <!-- Modal -->
    <div class="modal fade" id="address-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="user_uuid">
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-create-address-by-user">Create New</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.user-list').on('click', '.address-user', function () {
                let url = $(this).data('url')
                let user_uuid = $(this).data('user-uuid')
                let user_name = $(this).data('user-name')

                $('input[name=user_uuid]').val(user_uuid)
                $('#title-modal').text(`Address by user: ${user_name}`)

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        $('.modal-body').html(response)
                        $('#address-user').modal('show')
                    }
                })
            })

            $('.btn-create-address-by-user').on('click', function () {
                let user_uuid = $('input[name=user_uuid]').val();
                window.location = `{{ route('admin.address.create') }}/${user_uuid}`
            })
        })
    </script>
@endsection
