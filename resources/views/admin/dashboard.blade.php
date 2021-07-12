@extends('admin.master')
@section('mainContent')


                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                    </ul>
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div id='calendar'></div>
                    </div>
                    <div class="col-md-6">
                                <div class="card o-hidden mb-4">
                                    <div class="card-header d-flex align-items-center border-0">
                                        <h3 class="w-50 float-left card-title m-0">New Users</h3>
                                    </div>
                                    <div>
                                        <div class="table-responsive">
                                            <table class="table text-center" id="user_table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">SL</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Avatar</th>
                                                        <th scope="col">Phone</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @php
                                                            $count=1;
                                                        @endphp
                                                        @foreach ($users as $item)
                                                            <th scope="row">{{ $count++ }}</th>
                                                            <td>{{$item->name}}</td>
                                                            <td><img class="rounded-circle m-0 avatar-sm-table" src="{{ file_exists(@$item->image) ? asset($item->image) : asset('public/backend/uploads/staff/customer.png') }}" alt="" /></td>
                                                            <td>{{$item->phone}}</td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div><!-- end of main-content -->

@endsection
    
   