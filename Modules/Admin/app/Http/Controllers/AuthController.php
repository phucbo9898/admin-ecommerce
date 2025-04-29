<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\Auth\LoginRequest;
use Modules\Admin\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('admin::auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $getInfoUser = User::where([
            'email' => $credentials['email'],
        ])->first();

        if (empty($getInfoUser)) {
            return back()->withInput()->with('error', 'Account not found');
        }

        if (!in_array($getInfoUser->role, [User::ADMIN, User::SYSTEM_ADMIN])) {
            return back()->withInput()->with('error', 'Access denied');
        }

        if ($getInfoUser->status !== User::STATUS_ACTIVE) {
            if ($getInfoUser->status === User::STATUS_INACTIVE) {
                return back()->withInput()->with('error', 'Your account is not active');
            }

            if ($getInfoUser->status === User::STATUS_PENDING) {
                return back()->withInput()->with('error', 'Your account is not active. Please contact administrator');
            }
        }

        if (!Auth::guard('admin')->attempt($credentials)) {
            return back()->withInput()->with('error', 'Incorrect password account!!! Please try again');
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(): View
    {
        return view('admin::auth.register');
    }

    /**
     * Show the specified resource.
     */
    public function postRegister(RegisterRequest $request)
    {
        $dataRequest = $request->only('name', 'email', 'password');

        $getInfoUser = User::where('email', $dataRequest['email'])->first();
        if (!empty($getInfoUser)) {
            return back()->withInput()->with('error', 'Account exists with email: ' . $dataRequest['email']);
        }

        $dataRequest = array_merge($dataRequest, [
            'password' => Hash::make($dataRequest['password']),
            'role' => User::ADMIN,
            'status' => User::STATUS_PENDING,
        ]);

        $result = User::create($dataRequest);

        if (!$result) {
            return back()->withInput()->with('error', 'Error!!! Please try again');
        }

        return redirect()->route('admin.login');
    }
}
