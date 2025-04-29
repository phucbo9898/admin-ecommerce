@extends('admin::layouts.main')

@section('title', 'Address Edit')

@section('main-body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Address Edit: <span class="text-green">{{ $address->address ?? '' }}</span></h4>
                    </div>
                    <div class="basic-form">
                        <form action="{{ route('admin.address.update', $address->uuid) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10 col-form-label">
                                    <input type="text" class="form-control" value="{{ $user->name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10 col-form-label">
                                    <input type="text" name="address" class="form-control" value="{{ old('address') ?? ($address->address ?? '') }}">
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
                                    <button type="submit" class="btn btn-primary">Update</button>
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
