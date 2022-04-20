@extends('layouts.frontend')
@section('content')
<section class="masthead bg-section">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
            <div class="col-12 col-lg-7 col-sm-8 col-md-10 ">
                <img class="img homebanner" src="{{url('images/banner.png')}}" alt="banner">
            </div>
            
            <div class="col-sm-8 col-md-10">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                <form id="contactForm" method="POST" action="{{ route('delivery.store') }}" class="merchant-form merchantform">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 deliveryRequestType">
                                <label class="merchantlbl labelst" for="merchant">Merchant</label>
                                <input name="percletype" class="percletype" style="opacity: 0;" value="merchant" id="merchant" type="radio">
                            </div>
                            <div class="col-sm-6 col-md-6 deliveryRequestType">
                                <input name="percletype" class="percletype" style="opacity: 0;" value="customer" id="customer" type="radio">
                                <label class="customerlbl labelst" for="customer">Customer</label>
                            </div>
                        </div>

                    </div>
                    <div class="mb-3 customerCls">
                        <div class="input-group">
                            <div class="input-group-prepend input-zindex">
                                <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-person icon-feature2"></i></span>
                            </div>
                            <input type="hidden" id="merchantUrl" value="{{route('merchant.auth')}}">
                            <input type="text" class="form-control input-mf-text" autocomplete="off" name="full_name" id="full_name" type="text" placeholder="Full Name">
                        </div>
                        @if ($errors->has('full_name'))
                            <span class="text-danger">{{ $errors->first('full_name') }}</span>
                        @endif
                    </div>
                    <div class=" mb-3 customerCls">
                        <div class="input-group">
                            <div class="input-group-prepend input-zindex">
                                <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-telephone icon-feature2"></i></span>
                            </div>
                            <input type="text" class="form-control input-mf-text" autocomplete="off" name="phone_number" id="phone_number" type="text" placeholder="Phone number">
                        </div>
                        @if ($errors->has('phone_number'))
                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                        @endif
                    </div>
                    <div class="input-group mb-3 merchantCls">
                        <div class="input-group">
                            <div class="input-group-prepend input-zindex">
                                <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-person icon-feature2"></i></span>
                            </div>
                            <input type="text" class="form-control input-mf-text merchant_fields" autocomplete="off" name="merchant_code" id="merchant_code" type="text" placeholder="Merchant code">
                        </div>
                        @if ($errors->has('merchant_code'))
                            <span class="text-danger">{{ $errors->first('merchant_code') }}</span>
                        @endif
                    </div>
                    <div class="mb-3 merchantCls">
                        <div class="input-group">
                            <div class="input-group-prepend input-zindex">
                                <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-lock icon-feature2"></i></span>
                            </div>
                            <input class="form-control input-mf-text merchant_fields" name="merchant_password" id="merchant_password" type="password" placeholder="Merchant password" data-sb-validations="required">                           
                            <input name="merchant_id" id="merchant_id" type="hidden">                           
                        </div>
                        @if ($errors->has('merchant_password'))
                            <span class="text-danger">{{ $errors->first('merchant_password') }}</span>
                        @else 
                            <span class="text-danger merchantcodeError"></span>
                        @endif
                        <div class="mb-3 merchantCodeLoader" style="display: none">
                            <div class="spinner-border text-primary" role="status">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend input-zindex">
                                        <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-calendar icon-feature2"></i></span>
                                    </div>
                                    <input class="form-control input-mf-text datepicker" autocomplete="off" name="pickup_date" value="{{old('pickup_date',date('d/m/Y'))}}" id="pickup_date" type="text" placeholder="Pickup date">
                                </div>
                                @if ($errors->has('pickup_date'))
                                    <span class="text-danger">{{ $errors->first('pickup_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend input-zindex">
                                        <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-clock icon-feature2"></i></span>
                                    </div>
                                    <input class="form-control timepicker input-mf-text" autocomplete="off" name="pickup_time" id="pickup_time" type="text" value="{{old('pickup_time',date('H:m'))}}" placeholder="Pickup time">
                                </div>
                                @if ($errors->has('pickup_time'))
                                    <span class="text-danger">{{ $errors->first('pickup_time') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 customerCls">
                        <div class="input-group">
                            <div class="input-group-prepend input-zindex ">
                                <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-geo-alt icon-feature2"></i></span>
                            </div>
                            <input class="form-control input-mf-text address" autocomplete="off" name="pickup_address" id="pickup_address" type="text" placeholder="Pick up Address">
                        </div>
                        @if ($errors->has('pickup_address'))
                            <span class="text-danger">{{ $errors->first('pickup_address') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend input-zindex">
                                <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-geo-alt icon-feature2"></i></span>
                            </div>
                            <input class="form-control input-mf-text address" autocomplete="off" name="drop_address" id="drop_off_address" type="text" placeholder="Drop Off Address">
                        </div>
                        @if ($errors->has('drop_address'))
                            <span class="text-danger">{{ $errors->first('pickup_address') }}</span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend input-zindex">
                            <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-card-text icon-feature2"></i></span>
                        </div>
                        <input class="form-control input-mf-text " name="item_description" id="item_description" type="text" placeholder="Item description">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend input-zindex">
                            <span class="input-group-text bg-white" id="basic-addon1"><i class="bi-box icon-feature2"></i></span>
                        </div>
                        <input class="form-control input-mf-text" name="weight" id="weight" type="text" placeholder="Item weight">
                    </div>
                    <div class="mb-3 distanceCalculateWrapper" style="display: none">
                        <div class="row">
                            <div class="col-sm-2">&nbsp;</div>
                            <div class="col-sm-3">
                                <label>Cost</label>
                                <p><b id="costAmt"></b></p>
                            </div>
                            <div class="col-sm-5">
                                <label>Estimated delivery time</label>
                                <p><b id="estDeliveryTime"></b></p>
                            </div>
                        </div>
                        <input name="cost" id="cost" value="" readonly type="hidden">
                        <input name="estimate_time" id="estimate_time" value="" readonly type="hidden">
                    </div>
                    <div class="mb-3 distanceCalculateLoader" style="display: none">
                        <div class="spinner-border text-primary" role="status">
                        </div>
                    </div>
                    <div class="d-grid offset-xxl-3 col-xxl-4"><button class="btn btn-primary rounded-pill bg-footer" id="submitButton" type="submit">Confim</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="feedbackModal" tabindex="-1" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="spinner-border text-light" role="status">
                <span class="sr-only"></span>
              </div>
        </div>
    </div>
</section>
@stop

@section('bodyscript')
<script type="text/javascript">
    window.initMap = function() {window.mapLoaded = true}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places&callback=initMap" defer="true"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" defer="true" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" defer="true"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" defer="true" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.stripe.com/v3/" ></script>
<script type="text/javascript">
    function calculateRoutePrice() {
        const pickupAddress = $("#pickup_address").val()
        const dropOffAddress = $("#drop_off_address").val()

        if (pickupAddress && dropOffAddress) {
            $(".distanceCalculateLoader").show()
            $(".distanceCalculateWrapper").hide()
            var directionsService = new google.maps.DirectionsService();
                    directionsService
                    .route({
                    origin: {
                        query : pickupAddress
                    },
                    destination: {
                        query: dropOffAddress,
                    },
                        travelMode: google.maps.TravelMode.DRIVING,
                    })
                    .then((response) => {
                        $(".distanceCalculateLoader").hide()
                        const durationSeconds = response?.routes[0]?.legs[0]?.duration?.value || 0
                        const durationMinutStr = response?.routes[0]?.legs[0]?.duration?.text || ''
                        const durationMinutes = parseInt(durationSeconds) > 0 ? Math.ceil(parseInt(durationSeconds)/60) : 0
                        const durationUnit = `{{env("DURATION_UNIT")}}`;
                        let unitPrice = parseFloat(durationUnit) * durationMinutes
                        let unitPriceInDollar = unitPrice.toLocaleString('en-US', { style: 'currency', currency: 'USD' })
                        $(".distanceCalculateWrapper").show();
                        $("#estDeliveryTime").html(durationMinutStr)
                        $("#costAmt").html(unitPriceInDollar)
                        $("#cost").val(unitPrice)
                        $("#estimate_time").val(durationSeconds)
                     
                    }).catch((e) => {
                        console.log("Directions request failed due to " + status)}
                    );
        }
        
    }
    $(() => {
        var prefix = 'Toledo, OH, ';

        $('.address').on('input',function(){
            var str = $(this).val();
            if(str.indexOf(prefix) == 0) {
                // string already started with prefix
                return;
            } else {
                if (prefix.indexOf(str) >= 0) {
                    $(this).val(prefix)
                } else {
                    $(this).val(prefix+str)
                }
            }
        });
        //cs_test_a1fyvmqG4KlMkPQYBvP58DEqizL1koWj8U9cWUKCGaCjMzxEOhZ29hs1Cc
        $(".address").change(function() {
            calculateRoutePrice()
        })
        $("#contactForm").validate({
            rules : {
                full_name : {
                    required : "#customer:checked"
                },
                phone_number : {
                    required : "#customer:checked"
                },
                pickup_address : {
                    required : "#customer:checked"
                },
                merchant_code : {
                    required : "#merchant:checked"
                },
                merchant_password : {
                    required : "#merchant:checked"
                },
                pickup_date : {
                    required : true
                },
                pickup_time : {
                    required : true
                },
                drop_address : {
                    required : true
                },
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
                merchant_password : {
                    required : "The merchant password is required"
                },
                pickup_date : {
                    required : "The pickup date is required"
                },
                pickup_time : {
                    required : "The pickup time is required"
                },
                drop_address : {
                    required : "The drop address is required"
                },
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent("div.input-group"))
            },
            submitHandler: function (form) { 
                $('#feedbackModal').modal('show')
                $.ajax({
                    url : form.action,
                    data : $("#contactForm").serialize(),
                    type : "POST",
                    success:function(response) {
                        if (response.session_id) {
                            $('#feedbackModal').modal('hide')
                            const stripeInit = Stripe(`{{env("STRIPE_PUBLISH_KEY")}}`);
                            stripeInit.redirectToCheckout({
                                sessionId: response.session_id
                            })
                            .then(function(result) {
                                console.log(result);
                            }).catch(function(error) {
                                console.error(error);
                            });
                        }
                    }
                })
                
                return false;
            }
        })
        $(".merchant_fields").on('change',function(){
            const merchantCode = $("#merchant_code").val()
            const merchantPassword = $("#merchant_password").val()
            if (merchantCode && merchantPassword) {
                //$('#feedbackModal').modal('show')
                $('.merchantCodeLoader').show()
                $.ajax({
                    url: $("#merchantUrl").val(),
                    type:'POST',
                    data:{
                        merchant_code:merchantCode,
                        password:merchantPassword
                    },
                    success:function(data) {   
                        if (data.success) {
                            $(".merchantcodeError").html(" ")
                            $("#merchant_id").val(data.data.id)
                            $("#full_name").val(data.data.full_name)
                            $("#phone_number").val(data.data.phone_number)
                            $("#pickup_address").val(data.data.pickup_address)
                        } else {
                            $(".merchantcodeError").html(data.message)
                        }
                        $('.merchantCodeLoader').hide()
                    }
                })
            }
            console.log($(this).val())
        })
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: 'd',
            autoclose:true,
            clearBtn:true,
            orientation:'bottom right',
            zIndexOffset:true
        });
        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            dynamic: false,
            dropdown: true,
            scrollbar: false
        });
        $('.percletype').click(function(){
            const lbl = $(this).siblings('.labelst')[0]
            if (this.value == 'merchant') {
                $('.customerlbl').removeClass('label-decoration')
                $('.merchantCls').show()
                $('.customerCls').hide()
            } else if (this.value == 'customer') {
                $('.merchantlbl').removeClass('label-decoration')
                $('.merchantCls').hide()
                $('.customerCls').show()
            }

            $(lbl).addClass('label-decoration')
        })

        const percleType = `{{old("percletype")}}`
        if (percleType === 'merchant') {
            $('#merchant').trigger('click')
        } else {
            $('.percletype').trigger('click')
        }
//41.737090, -83.457511
//41.530388, -83.687966
        var defaultBounds = new google.maps.LatLngBounds(
    new google.maps.LatLng(41.737, -83.457),
    new google.maps.LatLng(41.530, -83.687));
    console.log(defaultBounds)
        const pickup_address = document.getElementById('pickup_address');
        const dropoff_address = document.getElementById('drop_off_address');
        const options = {
            //bounds:defaultBounds
            componentRestrictions: { country: "US" },
            //location : "41.5792772,-84.2005035" 
        };
        let autocomplete1 = new google.maps.places.Autocomplete(pickup_address,options);
        let autocomplete2 = new google.maps.places.Autocomplete(dropoff_address,options);
        google.maps.event.addListener(autocomplete1, 'place_changed', function () {
           // var place = autocomplete1.getPlace();
           calculateRoutePrice()
        });
        google.maps.event.addListener(autocomplete2, 'place_changed', function () {
            //var place = autocomplete2.getPlace();
            calculateRoutePrice()
        });

      
            
    })

    
</script>
@stop
