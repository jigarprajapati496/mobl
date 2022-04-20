
@extends('layouts.backend')
@section('title',"Merchant")
@section('headSection')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contains')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Delivery Request</h1>
</div>
@if(Session::has('message'))
<div class="form-group row">
    <div class="col-12">
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
          Session::get('message') }}</p>
    </div>
</div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="deliveryRequest" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        {{-- <th>Type</th> --}}
                        <th>Status</th>
                        <th>Location</th>
                        <th>Pickup date and time</th>
                        {{-- <th>Pickup time</th> --}}
                        <th>Estimate time</th>
                        <th>Amount</th>
                        
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('bodyscript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(() => {
        
        var table = $('#deliveryRequest').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('delivery.request')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false,},
                {data: 'user', name: 'user',orderable: false,},
                {data: 'is_approve', name: 'is_approve',orderable: false,},
               // {data: 'percletype', name: 'percletype',orderable: false,searchable: false},
               // {data: 'phone_number', name: 'phone_number',orderable: false,},
                {data: 'location', name: 'location',orderable: false,},
                //{data: 'drop_address', name: 'drop_address',orderable: false,},
                {data: 'pickup_date', name: 'pickup_date',orderable: false,},
                //{data: 'pickup_time', name: 'pickup_time',orderable: false,},
                //{data: 'payment_mode', name: 'payment_mode',orderable: false,},
                {data: 'estimate_time', name: 'estimate_time',orderable: false,},
                {data: 'cost', name: 'cost',orderable: false,},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('#deliveryRequest').on('click','.action',function(e) {
            e.preventDefault();
            const url = $(this).attr('href')
            const token = $("meta[name='csrf-token']").attr("content");
            const id = $(this).attr('data-id');
            const action = $(this).attr('data-action');
            console.log({
                         "_token": token,
                         "id":$(this).attr("data-id"),
                         "action":$(this).attr("data-action")
                        })
            bootbox.confirm({ 
            size: "small",
            message: "Are you sure?",
            callback: function(result){ 
                if (result) {
                    $.ajax({
                        url,
                        type: 'POST',
                        data:{
                         "_token": token,
                         id,
                         action
                        },
                        success:function(data) {
                            if (data.success) {
                                bootbox.alert({
                                    message: data.message,
                                    callback: function(){
                                        location.reload();
                                    }
                                })     
                            } else {

                                bootbox.alert(data.message)     
                            }
                        }
                    })
                }
             }
            })
        })
       
    })
</script>
@endsection
