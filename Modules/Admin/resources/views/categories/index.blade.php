@extends('admin::layouts.main')

@section('title', 'Categories Management')
@section('main-body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-md-flex justify-content-between">
                        <h4>Categories Management</h4>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create Category</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name ?? '' }}</td>
                                        <td>{{ $category->user->name ?? '' }}</td>
                                        <td>{{ $category->created_at ?? '' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.categories.edit', $category->uuid) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>

                                            <form action="{{ route('admin.categories.destroy', $category->uuid) }}" method="post">
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
                            {!! $categories->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
