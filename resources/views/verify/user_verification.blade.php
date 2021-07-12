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
                    <div class="card-header">{{ __('Verify Your Phone Number') }}</div>
                    <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                        @endif
                        <p> Please enter the OTP sent to your number: <strong> +88{{ Auth::user()->phone }} </strong></p>
                        <form action="{{route('verification.submit')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="verification_code"
                                    class="col-md-4 col-form-label text-md-right">{{ __('OTP Code') }}</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="phone" value="{{session('phone')}}">
                                    <input id="verification_code" type="tel"
                                        class="form-control-rounded form-control @error('verification_code') is-invalid @enderror"
                                        name="verification_code" value="{{ old('verification_code') }}" required>
                                    @error('verification_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-rounded btn-primary mt-2 mb-2">
                                        {{ __('Verify Phone Number') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
