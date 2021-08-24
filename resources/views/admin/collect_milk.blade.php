@extends('admin.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://unpLtr..com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
@section('mainContent')

    
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Expenses</a></li>
            <li>Expense List</li>
        </ul>
    </div>
    <div class=" border-top"></div>
    <div class="mt-20 mb-20">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> <span>+</span> Collect Milk</button>
    </div>

     <!-- Table row-->
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%; font-size:12px;">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Cow ID</th>
                                                <th>Cow Name</th>
                                                <th>Date & Time</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1;
                                            @endphp
                                            @foreach ($collect_milks as $item)
                                                <tr>
                                                    <td>{{ @$count++ }}</td>
                                                    <td>{{@$item->cow_id}}</td>
                                                    <td>{{@$item->name}}</td>
                                                    <td>{{@$item->date_time}}</td>
                                                    <td>{{@$item->quantity}}</td>
                                                    <td>@if (@$item->active_status==1)
                                                        <label class="badge badge-info">Collected</label>
                                                        @else
                                                         <label class="badge badge-danger">Pending</label>
                                                        @endif
                                                    </td>
                                                    <td style="text-align:center;">
                                                        @if ($item->active_status==0)
                                                            <a data-toggle="modal" data-target="#editModal{{$item->id}}" href="#"><i class="fa fa-pencil-square-o" title="Edit" aria-hidden="true"></i></a>
                                                            <a data-toggle="modal" data-target="#deleteModal{{$item->id}}" href="#"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i> </a>
                                                            <a class="btn btn-primary" href="{{ url('admin/milk-stock-updated/'.$item->id.'/'.$item->quantity)}}">Collect</a>
                                                        @else
                                                            <a class="btn btn-primary" href="#">Done</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <!-- Edit Modal starts -->       
                                                <div class="modal fade" id="editModal{{@$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel-2">Edit Milk Collection</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <form method="POST" action="{{url('admin/collect-milk-update')}}" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        @csrf 
                                                        <div class="modal-body">
                                                            <div class="row mb-20">
                                                            <div class="col-lg-10 col-lg-offset-1" style="margin-left: 40px;">
                                                                {{-- jhg --}}
                                                                <div class="input-effect mt-20">
                                                                    <label>Select Cow</label>
                                                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('cow_id') ? ' is-invalid' : '' }}"
                                                                            name="cow_id" id="cow_id">
                                                                            <option data-display="Select Category *" value="">Select</option>
                                                                            @foreach($cows as $key=>$value)
                                                                                <option value="{{$value->id}}" {{$value->id == $item->cow_id? 'selected':''}} >{{$value->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('cow_id'))
                                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                                                <strong>{{ $errors->first('cow_id') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="input-effect mt-20 mb-20">
                                                                        <label>Quantity/Ltr.</label>
                                                                        <input class="primary-input form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" type="text" onkeyup="isNumberKeyDecimal(this);" value="{{$item->quantity}}"   name="quantity" >
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('quantity'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('quantity') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">Submit</button>
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                              <!-- Edit Modal Ends -->
                                                {{-- Delete Modal--}}
                                            <div id="deleteModal{{@$item->id}}"  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Collect Milk</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>Are You Sure To Delete Item ?</h4>
                                                            </div>

                                                            <div class="mt-20 d-flex justify-content-between">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>

                                                                <a href="{{url('admin/collect-milk-delete/'.@$item->id)}}"><button class="btn btn-danger" type="submit">Delete</button></a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <script>

                                               
                                            </script>
                                            {{-- Delete Modal--}}
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal starts -->
         
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Collect Milk Info</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{route('collect_milk_submit')}}" enctype="multipart/form-data">
                          @csrf 
                          <div class="modal-body">
                            <div class="row mb-20">
                              <div class="col-lg-10 col-lg-offset-1" style="margin-left: 40px;">
                                {{-- jhg --}}
                                <div class="input-effect mt-20">
                                      <label>Select Cow</label>
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('cow_id') ? ' is-invalid' : '' }}"
                                            name="cow_id" id="cow_id">
                                            <option data-display="Select Category *" value="">Select</option>
                                            @foreach($cows as $key=>$value)
                                                <option value="{{$value->id}}" {{old('cow_id')!=''? (old('cow_id') == $value->id? 'selected':''):''}} >{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('cow_id'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('cow_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    

                                  <div class="input-effect mt-20 mb-20">
                                    <label>Quantity/Ltr.</label>
                                    <input class="primary-input form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" type="text" onkeyup="isNumberKeyDecimal(this);"  name="quantity" >
                                    <span class="focus-border"></span>
                                    @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
                  
@endsection