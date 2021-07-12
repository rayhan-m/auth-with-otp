
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signin | {{getSetting()->site_name}}</title>
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
                    <div class="p-4" style="margin: 0px 110px;">
                    <div class="auth-logo text-center mb-4"><img src="{{asset('/')}}{{getSetting()->logo}}" alt=""></div>
                        <h1>Welcome To {{ getSetting()->site_name }}</h1>

                        <div class="mt-6 text-center" style="margin-bottom:40px;margin-top:40px;">
                            <a class="btn btn-primary btn-block mt-2" href="{{ route('login') }}">Sign In</a>
                            <a class="btn btn-primary btn-block mt-2" href="{{ route('register') }}">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>