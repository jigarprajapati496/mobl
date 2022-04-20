@extends('layouts.frontend')
@section('content')

<section class="masthead bg-section">
    {{-- <div class="row gx-5 justify-content-center">
        <div class="container px-5">
            <h1>{{$status}}</h1>
            <div class="col-xl-8">
                <div class="h2 fs-1 text-white mb-4">"An intuitive solution to a common problem that we all face, wrapped up in a single app!"</div>
                <img src="assets/img/tnw-logo.svg" alt="..." style="height: 3rem">
            </div>
        </div>
    </div> --}}
    <aside class="text-center ">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xl-8">
                    <div class="h2 fs-1 mb-4">Your payment status is {{$status}}</div>
                </div>
                
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-xl-2">
                    <a href="{{route("home")}}" class="btn btn-primary">back to home</a>   
                </div>
            </div>
        </div>
    </aside>
   
</section>
@endsection