@extends('admin::layouts.auth-template')

@section('title', 'Register')
@section('content')
    <div class="card register-form mb-0">
        <div class="card-body pt-5">
            <a class="text-center" href="index.html"> <h4>Rosella</h4></a>
            <form class="mt-5 mb-5 login-input" action="{{ route('admin.register.post') }}" method="POST">
                @csrf

                @include('admin::layouts.includes.alert-messages')

                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') ?? '' }}">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" value="{{ old('email') ?? '' }}">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="new-password" value="{{ old('password') ?? '' }}">
                </div>
                <button class="btn login-form__btn submit w-100">Sign in</button>
            </form>
            <p class="mt-5 login-form__footer">Have account <a href="{{ route('admin.login') }}" class="text-primary">Sign Up </a> now</p>
            </p>
        </div>
    </div>
    </div>
@endsection
