@extends('layouts.admin')
@section('headSection')
<style>
    .text-danger,.error {
  --bs-text-opacity: 1;
  color: rgba(var(--bs-danger-rgb), var(--bs-text-opacity)) !important;
}
</style>
@endsection
@section('container')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <form method="POST" action="{{ route('login.submit') }}" class="user">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control form-control-user" autofocus id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Remember
                                    Me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('bodyscript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" defer="true" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(() => {
        $(".user").validate({
            rules : {
               
                email : {
                    required : true,
                    email : true,
                },
                password : {
                    required : true
                },
            },
            messages : {
                full_name : {
                    required : "The full name is required"
                },
                phone_number : {
                    required : "The phone number is required"
                }
            }  
        })
    })
</script>

@endsection 