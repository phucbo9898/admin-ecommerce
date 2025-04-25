@extends('admin::layouts.auth-template')

@section('title', 'Login')
@section('content')
    <div class="card login-form mb-0">
        <div class="card-body pt-5">
            <a class="text-center" href="index.html"> <h4>Rosella</h4></a>
            <form class="mt-5 mb-5 login-input" action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                @include('admin::layouts.includes.alert-messages')

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password" value="{{ old('password') }}">
                </div>
                <button class="btn login-form__btn submit w-100">Sign In</button>
            </form>
            <p class="mt-5 login-form__footer">Dont have account? <a href="{{ route('admin.register') }}" class="text-primary">Sign Up</a> now</p>
        </div>
    </div>
@endsection
