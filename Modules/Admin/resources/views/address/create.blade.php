@extends('admin::layouts.main')

@section('title', 'Address Create')

@section('main-body')
    <style>
        .alert-warning {
            border-left: 6px solid #ffeb3b;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Address Create</h4>
                    </div>
                    <div class="basic-form">
                        <form action="{{ route('admin.address.store') }}" method="POST">
                            @csrf

                            <div class="alert alert-warning">
                                <strong>Warning!</strong> Mỗi user chỉ được đăng kí tối đa 3 địa chỉ <br>
                                Những user đã đăng kí 3 địa chỉ sẽ không thể chọn đẻ đăng kí
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10 col-form-label">
                                    @if(!empty($uuid))
                                        <input type="text" class="form-control" value="{{ $users->first()->name ?? '' }}" readonly>
                                        <input type="hidden" name="user_uuid" value="{{ $uuid ?? '' }}">
                                    @else
                                        <select name="user_uuid" class="form-control">
                                            <option value="">Choose User</option>
                                            @if(count($users) > 0)
                                                @foreach($users as $user)
                                                    <option value="{{ $user->uuid }}" {{ count($user->address) >= 3 ? 'disabled' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10 col-form-label">
                                    <input type="text" name="address" class="form-control" value="{{ old('address') ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address Default</label>
                                <div class="col-sm-10 col-form-label">
                                    <input type="checkbox" name="is_default" value="1" {{ old('is_default') == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="{{ route('admin.address.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
