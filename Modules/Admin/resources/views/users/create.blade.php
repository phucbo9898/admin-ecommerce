@extends('admin::layouts.main')

@php
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
@endphp
@section('title', 'Users Create')
@section('main-body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Users Create</h4>
                    </div>
                    <div class="basic-form">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" name="password" class="form-control" placeholder="Password" value="{{ old('password') ?? '' }}">
                                </div>
                            </div>

                            <fieldset class="form-group">
                                <div class="row">
                                    <label class="col-form-label col-sm-2 pt-0">Status</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1" {{ old('status') === User::STATUS_ACTIVE ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="2" {{ old('status') === User::STATUS_INACTIVE ? 'checked' : '' }}>
                                            <label class="form-check-label">In Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="3" {{ old('status') === User::STATUS_PENDING ? 'checked' : '' }} disabled>
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
                                            <input class="form-check-input" type="radio" name="role" value="1" {{ old('role') === User::ADMIN ? 'checked' : '' }} {{ Auth::user()->isSystemAdmin() ? 'disabled' : '' }}>
                                            <label class="form-check-label">Admin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" value="2" {{ old('role') === User::SYSTEM_ADMIN ? 'checked' : '' }}>
                                            <label class="form-check-label">System Admin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" value="3" {{ old('role') === User::USER ? 'checked' : '' }}>
                                            <label class="form-check-label">User</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
