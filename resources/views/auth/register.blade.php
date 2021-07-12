
@php
    $setting=App\GeneralSetting::findorfail(1);
@endphp
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signin | {{@$setting->site_name}}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('public/backend/css/themes/lite-purple.css') }}" rel="stylesheet" />
    

</head>
<style>
    .bgImage{
        background-image: url({{asset('/')}}public/backend/images/bg.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<div class="auth-layout-wrap bgImage">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4" style="margin: 0px 130px;">
                    <div class="auth-logo text-center mb-4"><img src="{{asset('/')}}{{@$setting->logo}}" alt=""></div>
                        <h1 class="mb-3 text-18">Sign Up</h1>

                        <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }} *</label>

                                <input id="name" type="text" class="form-control-rounded form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                            <div class="form-group">
                                <label for="phone">Phone No *</label>
                                <input id="phone_no" type="text" class="form-control-rounded form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                <p class="_custom_error_message text-danger phone_no"></p>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="password">{{ __('Password') }} *</label>

                                    <input id="password" type="password" class="form-control-rounded form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>

                            <div class="form-group ">
                                <label for="password-confirm">{{ __('Confirm Password') }} *</label>

                                    <input id="password-confirm" type="password" class="form-control-rounded form-control" name="password_confirmation" required autocomplete="new-password">
                                
                            </div>

                            <button class="btn btn-rounded btn-primary btn-block mt-2" type="submit">Sign Up</button>
                        </form>
                        <div class="mt-3 text-center" >
                            <a class="text-muted" href="{{ route('login') }}"><u>Sign In</u></a>
                        </div>
                        <div class="mt-1 text-center" style="margin-bottom:40px;" >
                            <a class="text-muted" href="{{ url('password/reset') }}"><u>Forgot Password?</u></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/backend/js/plugins/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/custom.js') }}"></script>