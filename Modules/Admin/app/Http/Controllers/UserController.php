<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\User\CreateRequest;
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
    public function store(CreateRequest $request)
    {
        $dataRequest = $request->validated();
        $dataRequest = array_merge($dataRequest, [
            'password' => Hash::make($dataRequest['password']),
        ]);

        $result = User::create($dataRequest);
        if (!$result) {
            $status = 'error';
            $message = 'Something went wrong';
        } else {
            $status = 'success';
            $message = 'User created with id:' . $result->id . ' successfully';
        }

        return redirect()->route('admin.users.index')->with($status, $message);
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
        $detailUser = User::where('uuid', $uuid)->first();
        if (empty($detailUser)) {
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        return view('admin::users.edit', compact('detailUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $detailUser = User::where('uuid', $uuid)->first();
        if (empty($detailUser)) {
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        $dataRequest = $request->only(['name', 'email', 'status', 'role']);

        $result = $detailUser->update($dataRequest);

        if (!$result) {
            $status = 'error';
            $message = 'Something went wrong';
        } else {
            $status = 'success';
            $message = 'User updated successfully';
        }

        return redirect()->route('admin.users.index')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $detailUser = User::where('uuid', $uuid)->first();
        if (empty($detailUser)) {
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        $result = $detailUser->delete();
        if (!$result) {
            $status = 'error';
            $message = 'Something went wrong';
        } else {
            $status = 'success';
            $message = 'User deleted successfully';
        }

        return redirect()->route('admin.users.index')->with($status, $message);
    }
}
