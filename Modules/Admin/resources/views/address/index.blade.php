@extends('admin::layouts.main')

@section('title', 'Address Management')
@section('main-body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-md-flex justify-content-between">
                        <h4>Address Management</h4>
                        <a href="{{ route('admin.address.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create address</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Address</th>
                                <th>Owner of the user</th>
                                <th>Address Default</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($address) > 0)
                                @foreach($address as $item)
                                    <tr>
                                        <td>{{ $item->address ?? '' }}</td>
                                        <td>{{ $item->user->name ?? '' }}</td>
                                        <td>
                                            @if($item->is_default)
                                                <span class="label gradient-7 btn-rounded">Default</span>
                                            @else
                                                <span class="label gradient-2 btn-rounded">Not default</span>
                                            @endif

                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.address.edit', $item->uuid) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>

                                            <form action="{{ route('admin.address.destroy', $item->uuid) }}" method="post">
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
                            {!! $address->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
