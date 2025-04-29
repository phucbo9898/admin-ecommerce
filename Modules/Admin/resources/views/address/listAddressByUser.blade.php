<div class="table-responsive modal-address">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @if(count($getAddressByUser) > 0)
                @foreach($getAddressByUser as $address)
                    <tr class="">
                        <td class="{{ $address->is_default === 1 ? 'text-info' : '' }}">{{ $address->address ?? '' }}</td>
                        <td class="d-flex">
                            <a href="{{ route('admin.address.edit', $address->uuid) }}"
                               class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>

                            <form action="{{ route('admin.address.destroy', $address->uuid) }}"
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-2"><i
                                        class="fa fa-trash"></i> Delete
                                </button>
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
</div>
