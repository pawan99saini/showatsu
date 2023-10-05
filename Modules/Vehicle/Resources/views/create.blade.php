@extends('layouts.admin-layout')

@section('content')
<link rel="stylesheet" href="{{asset('assets/node_modules/dropify/dist/css/dropify.min.css')}}">
<div class="page-wrapper">
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Vehicle</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Vehicle</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add</h4>
                                <form class="form-control-line m-t-40" action="{{route('vehicle.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="name">Name</label>
                                    <select class="form-control" name="name">
                                        <option value="">Select</option>
                                        @foreach($vehicle_name as $name)
                                        <option value="{{$name->id}}">{{$name->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('name'))
                                    <div class="error text-danger fs-5">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="make">Make</label>
                                    <select class="form-control" name="make" onchange="getModal(this)">
                                        <option value="">Select</option>
                                        @foreach($makes as $make)
                                        <option value="{{$make->id}}">{{$make->name}}</option>
                                        @endforeach
                                    </select>                                    @if($errors->has('make'))
                                    <div class="error text-danger fs-5">{{ $errors->first('make') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                            <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="model">Modal</label>
                                    <select class="form-control" name="model" id="model">
                                        <option value="">Select</option>
                                        
                                    </select>                                    @if($errors->has('model'))
                                    <div class="error text-danger fs-5">{{ $errors->first('model') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="grade">Grade</label>
                                    <input type="text" name="grade" value="{{old('grade')}}"
                                        class="form-control">
                                    @if($errors->has('grade'))
                                    <div class="error text-danger fs-5">{{ $errors->first('grade') }}</div>
                                    @endif
                                </div>

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="fuel_type">Fuel Type</label>
                                    <select class="form-control" name="fuel_type">
                                        <option value="">Select</option>
                                        @foreach($fuel_type as $fuel)
                                        <option value="{{$fuel->id}}">{{$fuel->name}}</option>
                                        @endforeach
                                    </select> 
                                    @if($errors->has('fuel_type'))
                                    <div class="error text-danger fs-5">{{ $errors->first('fuel_type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="engine_cc">Engine CC</label>
                                    <select class="form-control" name="engine">
                                        <option value="">Select</option>
                                        @foreach($engine as $eng)
                                        <option value="{{$eng->id}}">{{$eng->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('engine'))
                                    <div class="error text-danger fs-5">{{ $errors->first('engine') }}</div>
                                    @endif
                                </div>

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="transmission">Transmission</label>
                                    <select class="form-control" name="transmission">
                                        <option value="">Select</option>
                                        @foreach($transmission as $trans)
                                        <option value="{{$trans->id}}">{{$trans->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('transmission'))
                                    <div class="error text-danger fs-5">{{ $errors->first('transmission') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="year">Year</label>
                                    <select name="year" class="form-control">
                                    <option value=""></option>
                                    @for($y=1991; $y< 2023; $y++)
                                    <option value="{{$y}}">{{$y}}</option>
                                    @endfor
                                    </select>
                                    @if($errors->has('year'))
                                    <div class="error text-danger fs-5">{{ $errors->first('year') }}</div>
                                    @endif
                                </div>

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="price">Price</label>
                                    <input type="text" name="price" value="{{old('price')}}"
                                        class="form-control">
                                    @if($errors->has('price'))
                                    <div class="error text-danger fs-5">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="exterior_color">Exterior Color</label>
                                    <select class="form-control" name="exterior_color">
                                        <option value="">Select</option>
                                        @foreach($ext_color as $ext)
                                        <option value="{{$ext->id}}">{{$ext->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('exterior_color'))
                                    <div class="error text-danger fs-5">{{ $errors->first('exterior_color') }}</div>
                                    @endif
                                </div>

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="interior_color">Interior Color</label>
                                    <select class="form-control" name="interior_color">
                                        <option value="">Select</option>
                                        @foreach($int_color as $int)
                                        <option value="{{$int->id}}">{{$int->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('interior_color'))
                                    <div class="error text-danger fs-5">{{ $errors->first('interior_color') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="wheel_style">Wheel Style</label>
                                    <input type="text" name="wheel_style" value="{{old('wheel_style')}}"
                                        class="form-control">
                                    @if($errors->has('wheel_style'))
                                    <div class="error text-danger fs-5">{{ $errors->first('wheel_style') }}</div>
                                    @endif
                                </div>

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="chassis_no">Chassis No</label>
                                    <input type="text" name="chassis_no" value="{{old('chassis_no')}}"
                                        class="form-control">
                                    @if($errors->has('chassis_no'))
                                    <div class="error text-danger fs-5">{{ $errors->first('chassis_no') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="interior_type">Interior Type</label>
                                    <select class="form-control" name="interior_type">
                                        <option value="">Select</option>
                                        @foreach($int_type as $intty)
                                        <option value="{{$intty->id}}">{{$intty->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('interior_type'))
                                    <div class="error text-danger fs-5">{{ $errors->first('interior_type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="recipient_address">Kilometers</label>
                                    <input type="text" name="kilometers" value="{{old('kilometers')}}"
                                        class="form-control">
                                    @if($errors->has('kilometers'))
                                    <div class="error text-danger fs-5">{{ $errors->first('kilometers') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group form-md-line-input col-6">
                                    <label class="form-control-label" for="drive">Drive</label>
                                    <input type="text" name="drive" value="{{old('drive')}}"
                                        class="form-control">
                                    @if($errors->has('drive'))
                                    <div class="error text-danger fs-5">{{ $errors->first('drive') }}</div>
                                    @endif
                                </div>
                                <div class="form-group form-md-line-input col-6">
                                        <label class="form-control-label" for="name">Status</label>
                                        <input type="checkbox" class="switch" checked data-on-color="primary" data-off-color="info" name="status">

                                    </div>



                            </div>
                            <div class="row">
                            <div class="form-group form-md-line-input col-12">
                                    <label class="form-control-label" for="image">Image</label>
                                    <input type="file" id="image" name="image" class="dropify" />

                                </div>
                            </div>
                            <div class="row">
                            <div class="form-group form-md-line-input col-12">
                            <label class="form-control-label" for="image">Accessories</label>
@php 
$accessories = ['Power Steerings','Center Locking','Power Mirror','Power Window','Air Conditioner','AC Front','Air Bag','Cassette Player','AntiLock Brakes','CD Player','Dual Airbag'];
@endphp
@foreach($accessories as $k=>$acc)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$acc}}" id="{{$k}}" name="accessories[]">
                                            <label class="form-check-label" for="{{$k}}">
                                            {{$acc}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                            </div>
                            <div class="row">
                            <div class="form-group form-md-line-input col-6">
                                        <label class="form-label">Gallary</label>
                                        <input type="file" name="galarry[]" multiple>
                                    </div>
                                    <div class="form-group form-md-line-input col-6">
                                        <label class="form-label">Comment</label>
                                        <textarea name="comments" class="form-control"></textarea>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-info my-4 btn-block waves-effect waves-light">Submit</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
        </div>

                            <script src="{{asset('assets/node_modules/dropify/dist/js/dropify.min.js')}}"></script>
                            <script>
                            $(document).ready(function() {
                                $('.dropify').dropify();
                            });

function getModal(st)
{
var make_id = st.value;
var model = "{{ old('model')}}";
$("#model").html('');
                $.ajax({
                    url: "{{url('fetch-model')}}",
                    type: "POST",
                    data: {
                        make_id: make_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#model').html('<option value="">-- Select Model --</option>');
                        $.each(res.models, function (key, value) {
                            var selected = (model==value.id) ? 'selected' : '';
                            $("#model").append('<option value="' + value
                                .id + '" '+selected+'>' + value.name + '</option>');
                        });
                    }
                });
}
                            </script>
                            @endsection
