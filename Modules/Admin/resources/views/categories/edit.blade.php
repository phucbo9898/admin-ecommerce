@extends('admin::layouts.main')

@section('title', 'Categories Edit')

@section('main-body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Categories Edit: <span class="text-green">{{ $detailCategory->name ?? '' }}</span></h4>
                    </div>
                    <div class="basic-form">
                        <form action="{{ route('admin.categories.update', $detailCategory->uuid) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $detailCategory->name ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
