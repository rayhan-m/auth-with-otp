@extends('admin.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('mainContent')

    
        <div class="breadcrumb">
            <ul>
                <li><a href="#">System Setting</a></li>
                <li>SMS Setting</li>
            </ul>
        </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
            {{-- Profile Info  --}}
            <div class="col-md-12" style="text-align: center;">
                <div class="col-md-12 grid-margin stretch-card mb-40">
                    <div class="card">
                        <div class="card-body">
                            <h4>Update SMS Setting</h4>

                            <!-- FORM -->
                            <form method="POST" action="{{ route('updateSmsSetting') }}">
                                @csrf
                            <ul style="list-style:none;">
                                <li class="col-sm-12 row mt-4" style="margin-left:0px;">
                                    <div class="col-sm-2">
                                        <label>TWILIO SID</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input id="sid" type="text" class="form-control @error('sid') is-invalid @enderror" name="sid" value="{{ @$data->sid }}" required autocomplete="name" autofocus>
                                    </div>
                                </li>
                                <li class="col-sm-12 row mt-4" style="margin-left:0px;">
                                    <div class="col-sm-2">
                                        <label>TWILIO TOKEN</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input id="token" type="token" class="form-control @error('token') is-invalid @enderror" name="token" value="{{ @$data->token }}" autocomplete="email">
                                    </div>
                                </li>
                                <li class="col-sm-12 row mt-4" style="margin-left:0px;">
                                    <div class="col-sm-2">
                                        <label>TWILIO FROM</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $data->from }}" class="form-control" name="from" placeholder="">
                                    </div>
                                </li>
                                <li class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary mt-20">Update</button>
                                </li>
                            </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    
    @endsection