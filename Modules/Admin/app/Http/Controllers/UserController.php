<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Modules\Admin\Http\Requests\User\StoreRequest;
use Modules\Admin\Http\Requests\User\UpdateRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('admin::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $dataRequest = $request->validated();
            $dataRequest = array_merge($dataRequest, [
                'password' => Hash::make($dataRequest['password']),
            ]);

            $result = User::create($dataRequest);

            return redirect()->route('admin.users.index')->with('success', 'User created with id:' . $result->id . ' successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->route('admin.users.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid): View|RedirectResponse
    {
        $detailUser = User::where('uuid', $uuid)->with('address')->first();

        if (empty($detailUser)) {
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        return view('admin::users.edit', compact('detailUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $uuid)
    {
        try {
            $detailUser = User::where('uuid', $uuid)->first();
            if (empty($detailUser)) {
                return redirect()->route('admin.users.index')->with('error', 'User not found');
            }

            $dataRequest = $request->validated();

            DB::beginTransaction();

            // Update information user by uuid
            $detailUser->update($dataRequest);

            // Remove address default
            Address::where('user_id', $detailUser->id)->update(['is_default' => 0]);
            // Add address default
            Address::where('id', $dataRequest['address'])->where('user_id', $detailUser->id)->update([
                'is_default' => 1,
            ]);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return redirect()->route('admin.users.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        try {
            $detailUser = User::where('uuid', $uuid)->first();
            if (empty($detailUser)) {
                return redirect()->route('admin.users.index')->with('error', 'User not found');
            }

            $getAllAddressByUser = Address::where('user_id', $detailUser->id);
            DB::beginTransaction();
            if (count($getAllAddressByUser->get()) > 0) {
                $getAllAddressByUser->delete();
            }

            $detailUser->delete();

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return redirect()->route('admin.users.index')->with('error', 'Something went wrong');
        }
    }
}
