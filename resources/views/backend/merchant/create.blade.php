@extends('layouts.backend')
@section('title',"Create Merchant")

@section('contains')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Merchants</h1>
</div>
<div class="card mb-4">
   
    <div class="card-body">
        <form method="POST" id="merchant" action="{{ route('merchant.store') }}" class="merchant">
            @csrf
           @include('backend.merchant.form')
        </form>
    </div>
</div>
@endsection