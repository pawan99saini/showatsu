@extends('layouts.admin-layout')

@section('content')

<div class="page-wrapper">
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">VehicleName</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">VehicleName</li>
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
                                <form class="form-control-line m-t-40" action="{{route('vehicle-name.store')}}" method="post">
                                @csrf    
                                <div class="row">
                                    <div class="form-group form-md-line-input col-6">
                                        <label class="form-control-label" for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                                        @if($errors->has('name'))
                                <div class="error text-danger fs-5">{{ $errors->first('name') }}</div>
                            @endif
                                    </div>
                                    <div class="form-group form-md-line-input col-6">
                                        <label class="form-control-label" for="name">Status</label>
                                        <input type="checkbox" class="switch" checked data-on-color="primary" data-off-color="info" name="status">

                                    </div>
</div>

                                    <button type="submit" class="btn btn-info my-4 btn-block waves-effect waves-light">Submit</button>               
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Make Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
        </div>
        @endsection