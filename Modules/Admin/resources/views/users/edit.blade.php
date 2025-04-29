@extends('admin::layouts.main')

@php use App\Models\User; @endphp
@section('title', 'Users Edit')
@section('main-body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Users Edit: <span class="text-green">{{ $detailUser->name ?? '' }}</span></h4>
                    </div>
                    <div class="basic-form">
                        <form action="{{ route('admin.users.update', $detailUser->uuid) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $detailUser->name ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $detailUser->email ?? '' }}">
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <label class="col-form-label col-sm-2 pt-0">Status</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1" {{ $detailUser->status === User::STATUS_ACTIVE ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="2" {{ $detailUser->status === User::STATUS_INACTIVE ? 'checked' : '' }}>
                                            <label class="form-check-label">In Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="3" {{ $detailUser->status === User::STATUS_PENDING ? 'checked' : '' }} disabled>
                                            <label class="form-check-label">Pending Approve</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <div class="row">
                                    <label class="col-form-label col-sm-2 pt-0">Role</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" value="1" {{ $detailUser->role === User::ADMIN ? 'checked' : '' }} {{ Auth::user()->isSystemAdmin() ? 'disabled' : '' }}>
                                            <label class="form-check-label">Admin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" value="2" {{ $detailUser->role === User::SYSTEM_ADMIN ? 'checked' : '' }}>
                                            <label class="form-check-label">System Admin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" value="3" {{ $detailUser->role === User::USER ? 'checked' : '' }}>
                                            <label class="form-check-label">User</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <div class="row">
                                    <label class="col-form-label col-sm-2 pt-0">Address</label>
                                    <div class="col-sm-10">
                                        @dump(old())
                                        @if(count($detailUser->address) > 0)
                                            @foreach($detailUser->address as $address)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="address" value="{{ $address->id }}" {{ old('address') == $address->id || $address->is_default === 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $address->address }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
