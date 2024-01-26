@extends('fe/layout')
@section('content')

<!-- Detail Start -->
<div class="container-fluid pt-5">
   <div class="container pt-5 pb-3">
      <h1 class="display-4 text-uppercase mb-5">Mercedes Benz R3</h1>
      <div class="row align-items-center pb-2">
         <div class="col-lg-6 mb-4">
            <img class="img-fluid" src="{{asset('public/fe')}}/img/bg-banner.jpg" alt="">
         </div>
         <div class="col-lg-6 mb-4">
            <h4 class="mb-2">$99.00/Day</h4>
            <div class="d-flex mb-3">
               <h6 class="mr-2">Rating:</h6>
               <div class="d-flex align-items-center justify-content-center mb-1">
                  <small class="fa fa-star text-primary mr-1"></small>
                  <small class="fa fa-star text-primary mr-1"></small>
                  <small class="fa fa-star text-primary mr-1"></small>
                  <small class="fa fa-star text-primary mr-1"></small>
                  <small class="fa fa-star-half-alt text-primary mr-1"></small>
                  <small>(250)</small>
               </div>
            </div>
            <p>Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et, tempor voluptua sit
               consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et lorem et sit, sed
               stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata eirmod, dolores takimata
               consetetur invidunt</p>
            <div class="d-flex pt-1">
               <h6>Share on:</h6>
               <div class="d-inline-flex">
                  <a class="px-2" href=""><i class="fab fa-facebook-f"></i></a>
                  <a class="px-2" href=""><i class="fab fa-twitter"></i></a>
                  <a class="px-2" href=""><i class="fab fa-linkedin-in"></i></a>
                  <a class="px-2" href=""><i class="fab fa-pinterest"></i></a>
               </div>
            </div>
         </div>
      </div>
      <div class="row mt-n3 mt-lg-0 pb-4">
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-car text-primary mr-2"></i>
            <span>Model: 2015</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-cogs text-primary mr-2"></i>
            <span>Automatic</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-road text-primary mr-2"></i>
            <span>20km/liter</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-eye text-primary mr-2"></i>
            <span>GPS Navigation</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-car text-primary mr-2"></i>
            <span>Model: 2015</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-cogs text-primary mr-2"></i>
            <span>Automatic</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-road text-primary mr-2"></i>
            <span>20km/liter</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-eye text-primary mr-2"></i>
            <span>GPS Navigation</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-car text-primary mr-2"></i>
            <span>Model: 2015</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-cogs text-primary mr-2"></i>
            <span>Automatic</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-road text-primary mr-2"></i>
            <span>20km/liter</span>
         </div>
         <div class="col-md-3 col-6 mb-2">
            <i class="fa fa-eye text-primary mr-2"></i>
            <span>GPS Navigation</span>
         </div>
      </div>
   </div>
</div>
<!-- Detail End -->


<!-- Car Booking Start -->
<div class="container-fluid pb-5">
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
            <h2 class="mb-4">Personal Detail</h2>
            <div class="mb-5">
               <div class="row">
                  <form action="{{route('fe.rental')}}" method="post">
                     @csrf
                     <div class="col-6 form-group">
                        <input type="text" class="form-control p-4" placeholder="Fullname" name="fullname">
                     </div>
                     <div class="col-6 form-group">
                        <input type="text" class="form-control p-4" placeholder="Phone">
                     </div>
                     <div class="col-6 form-group">
                        <button type="submit">Pay</button>
                     </div>
                  </form>

               </div>
            </div>
            <h2 class="mb-4">Booking Detail</h2>

            <form action="{{route('fe.payment')}}" method="post">
               @csrf
               <div class="mb-5">
                  <div class="row">
                     <div class="col-12">
                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Pickup Date</h6>
                           </div>
                           <div class="col-9">
                              <span>{{Session::get('pickup_date')}}</span>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Return Date</h6>
                           </div>
                           <div class="col-9">
                              <span>{{Session::get('return_date')}}</span>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Total Days</h6>
                           </div>
                           <div class="col-9">
                              <span>{{Session::get('total_days')}}</span>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-2">
                              <h6>Total Amount</h6>
                           </div>
                           <div class="col-9">
                              <span>{{Session::get('total_days')*Session::get('price_per_day')*1000}} VND</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6 form-group">
                     <select class="custom-select px-4" style="height: 50px;">
                        <option selected>Select Adult</option>
                        <option value="1">Adult 1</option>
                        <option value="2">Adult 2</option>
                        <option value="3">Adult 3</option>
                     </select>
                  </div>
                  <div class="col-6 form-group">
                     <select class="custom-select px-4" style="height: 50px;">
                        <option selected>Select Child</option>
                        <option value="1">Child 1</option>
                        <option value="2">Child 2</option>
                        <option value="3">Child 3</option>
                     </select>
                  </div>
                  <div class="row"><button type="submit" name="redirect">Book</button></div>
               </div>
               <div class="form-group">
                  <textarea class="form-control py-3 px-4" rows="3" placeholder="Special Request"
                     required="required"></textarea>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="bg-secondary p-5 mb-5">
               <h2 class="text-primary mb-4">Payment</h2>
               <div class="form-group">
                  <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="payment" id="paypal">
                     <label class="custom-control-label" for="paypal">Momo</label>
                  </div>
               </div>
               <div class="form-group">
                  <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                     <label class="custom-control-label" for="directcheck">ZaloPay</label>
                  </div>
               </div>
               <div class="form-group mb-4">
                  <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                     <label class="custom-control-label" for="banktransfer">VNPay</label>
                  </div>
               </div>
               <a href="" class="btn btn-block btn-primary py-3">Reserve Now</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Car Booking End -->

@endsection