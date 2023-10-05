@extends('layouts.admin-layout')
@section('content')

<link rel="stylesheet" type="text/css"
        href="{{asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
<div class="page-wrapper" style="min-height: 483px;">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Orders</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Orders</li>
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
                    <!-- column -->
                    
                    
                    <!-- column -->
                    
                    <!-- column -->
                    
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Orders</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Vechile</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Country</th>
                                                <th>Zip</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                      
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <div id="responsive-modal" class="modal" tabindex="-1" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Order Info</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                    
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
        <script src="{{asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>

        <script type="text/javascript">
  $(function () {
    
    var table = $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'vehicle_id', name: 'vehicle_id'},
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'city', name: 'city'},
            {data: 'state', name: 'state'},
            {data: 'country', name: 'country'},
            {data: 'zip', name: 'zip'},
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });
  });

  function viewOrder(order_id)
  {
    var html = '';
    $.ajax({
                    url: "{{url('orders')}}/"+order_id,
                    type: "GET",
                    dataType: 'json',
                    success: function (res) 
                    {
                        console.log()
                        html += `<div class="row"><div class="form-group col-6"><label for="recipient-name" class="form-label">Vehicle: `+res.vehicle.vehicle_name.name+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Name: `+res.name+`</label></div>
                       </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Address: `+res.address+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">City: `+res.city+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">State: `+res.state+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Country: `+res.country+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Zip: `+res.zip+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Email: `+res.email+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Work Phone: `+res.work_phone+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Home Phone: `+res.home_phone+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Cellular Phone: `+res.cellular_phone+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Fax: `+res.fax+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Consignee Name: `+res.consignee_name+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Consignee Address: `+res.consignee_address+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Consignee City: `+res.consignee_city+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Consignee State: `+res.consignee_state+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Consignee Country: `+res.consignee_country+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Consignee Zip: `+res.consignee_zip+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Consignee EMail: `+res.consignee_email+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Consignee Work Phone: `+res.consignee_work_phone+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Consignee Home Phone: `+res.consignee_home_phone+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Consignee Fax: `+res.consignee_fax+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Permit No: `+res.permit_no+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Payment Mode: `+res.payment_mode+`</label></div>
                        </div><div class="row"><div class="form-group col-6"><label for="message-text" class="form-label">Destination Port: `+res.destination_port+`</label></div>
                        <div class="form-group col-6"><label for="message-text" class="form-label">Destination Country: `+res.destination_country+`</label></div></div>`;
                        $(".modal-body").html(html)
                        var myModal = new bootstrap.Modal(document.getElementById('responsive-modal'))
                         myModal.show()  
                    }
                });
  }
</script>
@endsection
