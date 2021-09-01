@extends('layouts.app')
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
<link href="{{ asset('public/backend/css/themes/lite-purple.css') }}" rel="stylesheet" />
<style>
    .card{
        top: -100px !important;
    }
    .btn-primary {
        color: #fff !important;
        background-color: #663399 !important;
        border-color: #663399 !important;
    }
    .bgImage{
        background-image: url({{asset('/')}}public/backend/images/bg.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@section('content')
    <div class="auth-layout-wrap bgImage">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">{{ __('Forgot Password?') }}</div>
                    <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                        @endif
                        <p class="mb-4 opacity-60">{{__('Enter your phone, code and new password and confirm password.')}} </p>
                        <form method="POST" class="form-default" action="{{ route('password.update') }}">
                            @csrf

                            <div class="form-group">
                                <input id="phone_no" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $email ?? old('phone') }}" placeholder="Phone" required autofocus>
                                <p class="_custom_error_message text-danger phone-message"></p>


                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input id="email" type="number" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ $code ?? old('code') }}" placeholder="Code" required autofocus>

                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-block fw-600 border-0">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('public/backend/js/plugins/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/backend/js/custom.js') }}"></script>
