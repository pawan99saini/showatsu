@extends('layouts.admin-layout')

@section('content')

<div class="page-wrapper">
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Page</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Page</li>
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
                                <form class="form-control-line m-t-40" action="{{route('page.store')}}" method="post">
                                @csrf    
                                <div class="row">
                                    <div class="form-group form-md-line-input col-6">
                                        <label class="form-control-label" for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                                        @if($errors->has('title'))
                                <div class="error text-danger fs-5">{{ $errors->first('title') }}</div>
                            @endif
                                    </div>
                                    <div class="form-group form-md-line-input col-6">
                                        <label class="form-control-label" for="name">Status</label>
                                        <input type="checkbox" class="switch" checked data-on-color="primary" data-off-color="info" name="status">

                                    </div>
</div>
<div class="row">
<div class="form-group form-md-line-input col-12">
                                        <label class="form-control-label" for="title">Content</label>
                                        
                                        <textarea class="ckeditor" name="content"></textarea>
                                        @if($errors->has('content'))
                                <div class="error text-danger fs-5">{{ $errors->first('content') }}</div>
                            @endif
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
        @endsection