
@extends('layouts.backend')
@section('title',"Dashboard")

@section('contains')
@if(Session::has('success'))
<div class="form-group row">
    <div class="col-12">
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
          Session::get('success') }}</p>
    </div>
</div>
@endif
@endsection

