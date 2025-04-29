<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Admin\Http\Requests\Address\StoreRequest;
use Modules\Admin\Http\Requests\Address\UpdateRequest;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address = Address::with('user')->orderBy('user_id')->paginate(10);

        return view('admin::address.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $uuid = null)
    {
        if (!empty($uuid)) {
            $users = User::where('uuid', $uuid)->with('address')->get();

            if (count($users) < 0) {
                return redirect()->route('admin.users.index')->with('error', 'User not found');
            }

            if (count($users->first()->address) >= 3) {
                return redirect()->route('admin.address.index')->with('error', 'User: ' . $users->first()->name . ' đã tạo tối đa địa chỉ');
            }
        } else {
            $users = User::where('status', User::STATUS_ACTIVE)->get();
        }

        return view('admin::address.create', compact('uuid', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            $detailUser = User::where('uuid', $data['user_uuid'])->where('status', User::STATUS_ACTIVE)->with('address')->first();
            if (empty($detailUser)) {
                return redirect()->route('admin.address.index')->with('error', 'User not found');
            }

            $hasDefaultAddress = $detailUser->address->contains('is_default', 1);
            if (!empty($data['is_default']) && $data['is_default'] == 1 && $hasDefaultAddress) {
                return back()->withInput()->with('error', 'User: ' . $detailUser->name . ' đã setup address default!!! Vui lòng bỏ setup default hoặc bỏ address default trước khi tạo mới address default');
            }

            if (count($detailUser->address) >= 3) {
                return redirect()->route('admin.address.index')->with('error', 'User: ' . $detailUser->name . ' đã tạo tối đa địa chỉ');
            }

            $data = array_merge($data, [
                'user_id' => $detailUser->id,
                'last_modified_by' => Auth::guard('admin')->id(),
            ]);
            unset($data['user_uuid']);

            Address::create($data);

            return redirect()->route('admin.address.index')->with('success', 'Address successfully created');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->route('admin.address.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the specified resource.
     */
    public function listAddressByUser($uuid)
    {
        $userDetail = User::where('uuid', $uuid)->first();
        if (empty($userDetail)) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $getAddressByUser = Address::where('user_id', $userDetail->id)->orderByRaw('is_default desc, id desc')->get();

        return view('admin::address.listAddressByUser', compact('getAddressByUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $address = Address::where('uuid', $uuid)->first();
        if (empty($address)) {
            return redirect()->route('admin.address.index')->with('error', 'Address not found');
        }

        $user = User::where('status', User::STATUS_ACTIVE)->where('id', $address->user_id)->first();
        if (empty($user)) {
            return redirect()->route('admin.address.index')->with('error', 'User not found');
        }

        return view('admin::address.edit', compact('address', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $uuid)
    {
        try {
            $data = $request->validated();

            $detailAddress = Address::where('uuid', $uuid)->with('user')->first();
            if (empty($detailAddress)) {
                return redirect()->route('admin.address.index')->with('error', 'Address not found');
            }
            $userHasAddress = User::where('id', $detailAddress->user_id)->where('status', User::STATUS_ACTIVE)->with('address')->first();
            $hasDefaultAddress = $userHasAddress->address->contains('is_default', 1);
            if (!empty($data['is_default']) && $data['is_default'] == 1 && $hasDefaultAddress) {
                return back()->withInput()->with('error', 'User: ' . $userHasAddress->name . ' đã setup address default!!! Vui lòng bỏ setup default hoặc bỏ address default trước khi tạo mới address default');
            }

            $detailAddress->update([
                'address' => $data['address'],
                'last_modified_by' => Auth::guard('admin')->id(),
            ]);

            return redirect()->route('admin.address.index')->with('success', 'Address successfully updated');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->route('admin.address.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        try {
            $detailAddress = Address::where('uuid', $uuid)->with('user')->first();
            if (empty($detailAddress)) {
                return redirect()->route('admin.address.index')->with('error', 'Address not found');
            }

            $detailAddress->delete();

            return redirect()->route('admin.address.index')->with('success', 'Address successfully deleted');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->route('admin.address.index')->with('error', 'Something went wrong');
        }
    }
}
