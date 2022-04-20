
@extends('layouts.backend')
@section('title',"Merchant")
@section('headSection')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contains')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Merchants</h1>
    <a href="{{route("merchant.create")}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create</a>
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
            <table class="table table-bordered" id="merchant-list" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>FullName</th>
                        <th>Phone number</th>
                        <th>Merchant code</th>
                        <th>Pickup address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
               
                {{-- <tbody>
                    @if(!empty($data) && $data->count())
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$value->full_name}}</td>
                        <td>{{$value->phone_number}}</td>
                        <td>{{$value->merchant_code}}</td>
                        <td>{{$value->pickup_address}}</td>
                        <td>
                            <a href="{{route('merchant.edit',$value->id)}}">Edit</a> | 
                            <a href="{{route('merchant.destroy',$value->id)}}" class="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="10">There are no data.</td>
                        </tr>
                    @endif
                </tbody> --}}
            </table>
            {!! $data->links() !!}
        </div>
    </div>
</div>
@endsection
@section('bodyscript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(() => {
        var table = $('#merchant-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('merchant.index')}}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'full_name', name: 'full_name',orderable: false,},
                {data: 'phone_number', name: 'full_name',orderable: false,},
                {data: 'merchant_code', name: 'merchant_code',orderable: false,},
                {data: 'pickup_address', name: 'pickup_address',orderable: false,},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('#merchant-list').on('click','.delete',function(e) {
            e.preventDefault();
            const deleteUrl = $(this).attr('href')
            const token = $("meta[name='csrf-token']").attr("content");
            bootbox.confirm({ 
            size: "small",
            message: "Are you sure?",
            callback: function(result){ 
                if (result) {
                    $.ajax({
                        url:deleteUrl,
                        type: 'DELETE',
                        data:{
                         "_token": token,
                        },
                        success:function(data) {
                            if (data.success) {
                             location.reload();
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
