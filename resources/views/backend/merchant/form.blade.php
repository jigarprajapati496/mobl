<div class="row gx-3 mb-3 col-md-12">
    <!-- Form Group (first name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="fullname">Full name *</label>
        <input class="form-control cls" name="full_name" id="fullname" type="text" placeholder="Enter full name" value="{{ old('full_name',$merchant->full_name) }}">
        @if ($errors->has('full_name'))
            <span class="text-danger">{{ $errors->first('full_name') }}</span>
        @endif
    </div>
</div>
<div class="row gx-3 mb-3 col-md-12">    
    <!-- Form Group (last name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="phonenumber">Phone number *</label>
        <input class="form-control cls" name="phone_number" id="phonenumber" type="text" placeholder="Enter phone number" value="{{ old('phone_number',$merchant->phone_number) }}">
        @if ($errors->has('phone_number'))
            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
        @endif
    </div>
</div>
<div class="row gx-3 mb-3 col-md-12">    
    <div class="col-md-6">
        <label class="small mb-1" for="merchant_code">Merchant code*</label>
        <input class="form-control cls" id="merchant_code" type="text" name="merchant_code" placeholder="Enter merchant code" value="{{ old('merchant_code',$merchant->merchant_code) }}">
        @if ($errors->has('merchant_code'))
            <span class="text-danger">{{ $errors->first('merchant_code') }}</span>
        @endif
    </div>
</div>
<div class="row gx-3 mb-3 col-md-12">    
    <div class="col-md-6">
        <label class="small mb-1" for="password">Password*</label>
        <input class="form-control cls" id="password" type="password" name="password" placeholder="Enter password" value="">
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
</div>
<div class="row gx-3 mb-3 col-md-12">    
    <div class="col-md-6">
        <label class="small mb-1" for="pickup_address">Pickup address*</label>
        <input class="form-control cls" id="pickup_address" type="pickup_address" name="pickup_address" placeholder="Enter pickup address" value="{{ old('pickup_address',$merchant->pickup_address) }}">
        @if ($errors->has('pickup_address'))
            <span class="text-danger">{{ $errors->first('pickup_address') }}</span>
        @endif
    </div>
</div>
<div class="row gx-3 mb-3 col-md-12">    
    <div class="col-md-6">
        <button class="btn btn-primary" type="submit">
            {{$merchant->id ? 'Edit' : 'Create'}}
        </button>
        <a href="{{route("merchant.index")}}" class="btn ">Back</a>
    </div>
</div>

@section('bodyscript')
<script type="text/javascript">
    window.initMap = function() {window.mapLoaded = true}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places&callback=initMap"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
       const input = document.getElementById('pickup_address');
       const options = {
        componentRestrictions: { country: "US" }, 
      };
      let autocomplete = new google.maps.places.Autocomplete(input,options);
      let $this = this
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
        });
        $('.cls').keyup(function() {
            $(this).siblings('.text-danger').hide();
        })

        $("#merchant").validate({
            rules : {
                full_name : {
                    required : true
                },
                phone_number : {
                    required : true
                },
                merchant_code : {
                    required : true
                },
                password : {
                    required : true
                },
                pickup_address : {
                    required : true
                }
            },
            messages : {
                full_name : {
                    required : "The full name is required"
                },
                phone_number : {
                    required : "The phone number is required"
                },
                pickup_address : {
                    required : "The pickup address is required"
                },
                merchant_code : {
                    required : "The merchant code is required"
                },
                password : {
                    required : "The password is required"
                }
            }
            // ,errorPlacement: function(error, element) {
            //     error.insertAfter(element.parent("div.input-group"))
            // }
        })
        
    })
</script>
@endsection