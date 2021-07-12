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
                        <p class="mb-4 opacity-60">Enter your phone number to recover your password</p>
                        <form method="POST" class="form-default" action="{{ route('password.phone') }}">
                            @csrf
                            <div class="form-group">
                                <input id="phone_no" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required placeholder="Phone">
                               
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mb-5">
                                <button class="btn btn-primary btn-block fw-600 border-0" type="submit">
                                   Send OTP
                                </button>
                            </div>
                        </form>
                        <div class="mt-3">
                            <a class="back-to-login" href="{{route('login')}}" class="text-reset opacity-60"><i class="fas fa-chevron-left"></i>Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection