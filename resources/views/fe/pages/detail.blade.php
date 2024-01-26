@extends('fe/layout')
@section('content')
<!-- Search Start -->
<div class="container-fluid bg-white pt-3 px-lg-5">
    <div class="row mx-n2">
        <div class="col-xl-2 col-lg-4 col-md-6 px-2">

        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 px-2">

        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <div class="date mb-3" id="date" data-target-input="nearest">
                <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Return Date"
                    data-target="#date" data-toggle="datetimepicker" />
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <div class="time mb-3" id="time" data-target-input="nearest">
                <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Time"
                    data-target="#time" data-toggle="datetimepicker" />
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <select class="custom-select px-4 mb-3" style="height: 50px;">
                <option selected>Select A Car</option>
                <option value="1">Car 1</option>
                <option value="2">Car 1</option>
                <option value="3">Car 1</option>
            </select>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">Search</button>
        </div>
    </div>
</div>
<!-- Search End -->

<!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Car Details</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="{{route('fe.home')}}">Home</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Car Details</h6>
    </div>
</div>
<!-- Page Header Start -->


<!-- Detail Start -->
<div class="container-fluid pt-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <h1 class="display-4 text-uppercase mb-5">{{$detail->name}}</h1>

                <div class="row mx-n2 mb-3">
                    <img class="img-fluid w-100" id="mainImage"
                        src="{{asset('public/be/images')}}/products/imagesPro/{{$detail->image}}" alt="Image">
                </div>

                <!-- mới -->
                <div class="owl-carousel gallery-carousel">
                    @if(is_array(json_decode($detail->thumbnail)))
                    @foreach(json_decode($detail->thumbnail) as $image)
                    <div class="item">
                        <img class="img-fluid w-100" src="{{ asset('public/be/images/products/thumbnail/' . $image) }}"
                            alt="">
                    </div>
                    @endforeach
                    @endif
                </div>









                <!-- <div id="thumbnailContainer">
                    <div class="row mx-n2 mb-3" id="thumbnailCarousel">
                        @if(is_array(json_decode($detail->thumbnail)))
                        @foreach(json_decode($detail->thumbnail) as $image=>$images)
                        <div class="col-md-3 col-6 px-2 pb-2 thumbnail-item">
                            <img class="img-fluid w-100 thumbnail-image"
                                src="{{ asset('public/be/images/products/thumbnail/' . $images) }}" alt="">
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <button id="prevBtn" onclick="changeThumbnail(-1)">Previous</button>
                    <button id="nextBtn" onclick="changeThumbnail(1)">Next</button>
                </div>  -->
                <div class="row mx-n2 mb-3" id="thumbnailCarousel">
                    <div class="item">
                        <img class="img-fluid w-100 "
                            src="{{asset('public/be/images/products/thumbnail/'.$detail->thumbnail)}}" alt="">
                    </div>
                </div>


                <!-- <div class="row mx-n2 mb-3">
                    <img class="img-fluid  w-20"
                        src="{{asset('public/be/images')}}/products/imagesPro/{{$detail->image}}" alt="Image"> </br>
                    <div class="row mx-n2 mb-3">  
                        @if(is_array(json_decode($detail->thumbnail)))
                        @foreach(json_decode($detail->thumbnail) as $image=>$images)
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{ asset('public/be/images/products/thumbnail/' . $images) }}"
                                alt="">

                        </div>
                        @endforeach
                        @endif
                    </div>
                </div> -->
                {!!$detail->overview!!}
                <!-- Start rating -->
                <script>
                    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
                </script>

                <!-- <div class="rating" style="display: none;"> -->
                <!-- Your default star rating -->
                <!-- <input type="radio" id="defaultStar5" name="rating" value="5" checked>
                    <label for="defaultStar5" title="5 stars"><i class="fas fa-star"></i></label> -->

                <!-- Add more default stars if needed -->
                <!-- </div> -->

                <div class="average-rating" style="display: inline-block;">
                    <!-- Display average rating when not logged in -->
                    <label for="defaultStar5" title="5 stars" style="color: yellow; font-size: 30px;">
                        <i class="fas fa-star"></i></label>&nbsp;&nbsp; {{number_format($detail->averageRating(), 1)}}
                </div>

                @if(auth()->check())
                <!-- Your form for logged-in users -->
                <form action="{{ route('fe.rate', $detail['id']) }}" method="post">
                    @csrf
                    <div class="container mt-5 d-flex flex-column align-items-center"></div>
                    {{-- <div class="rating"> --}}
                        <!-- Your star rating input using Font Awesome -->
                        <div class="rating">
                            <!-- Your star rating input using Font Awesome -->
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>





                            <button type="submit" class="btn btn-primary " name="rate">Submit Rating</button>
                            <!-- Add more stars if needed -->
                        </div>

                        <!-- Add more stars if needed -->
                        {{--
                    </div> --}}


                </form>
                @endif

                <!-- End rating -->


                <div class="row pt-2">
                    <div class="col-md-3 col-6 mb-2">

                    </div>

                    <div class="col-md-3 col-6 mb-2">
                        <i class="fa fa-cogs text-primary mr-2"></i>
                        <span>Automatic</span>
                    </div>
                    <div class="col-md-3 col-6 mb-2">
                        <!-- <i class="fa fa-road text-primary mr-2"></i>
                            <span>20km/liter</span> -->
                    </div>
                    <div class="col-md-3 col-6 mb-2">
                        <!-- <i class="fa fa-eye text-primary mr-2"></i>
                            <span>GPS Navigation</span> -->
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

                    </div>
                    <div class="col-md-3 col-6 mb-2">

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

                    </div>
                    <div class="col-md-3 col-6 mb-2">

                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-5">
                <div class="bg-light p-5">
                    <h3 class="text-primary text-center mb-4">Schedule</h3>
                    <form action="" method="post" class="col-12">
                        @csrf
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="">
                                <h6>Pickup Date</h6>
                            </label>
                            <div class="schedule col-9" id="date1" data-target-input="nearest">
                                <input type="text" class="form-control p-4 datetimepicker-input"
                                    placeholder="Pickup Date" name="pickup_date" data-target="#date1"
                                    data-toggle="datetimepicker" onkeydown="return false" />
                                {!!$errors->first("pickup_date",'<div class="text-danger">:message</div>')!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="">
                                <h6>Return Date</h6>
                            </label>
                            <div class="schedule col-9" id="date2" data-target-input="nearest">
                                <input type="text" class="form-control p-4 datetimepicker-input"
                                    placeholder="Return Date" name="return_date" data-target="#date2"
                                    data-toggle="datetimepicker" onkeydown="return false" />
                                {!!$errors->first("return_date",'<div class="text-danger">:message</div>')!!}
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" name="booking" class="btn btn-primary">Book</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Detail End -->


<!-- Các sản phẩm liên quan -->
<!-- Related Car Start -->
<div class="container-fluid pb-5">
    <div class="container pb-5">
        <h2 class="mb-4">Related Cars</h2>
        <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">
            <div class="rent-item">
                <img class="img-fluid mb-4" src="img/car-rent-1.png" alt="">
                <h4 class="text-uppercase mb-4">Mercedes Benz R3</h4>
                <div class="d-flex justify-content-center mb-4">
                    <div class="px-2">
                        <i class="fa fa-car text-primary mr-1"></i>
                        <span>2015</span>
                    </div>
                    <div class="px-2 border-left border-right">
                        <i class="fa fa-cogs text-primary mr-1"></i>
                        <span>AUTO</span>
                    </div>
                    <div class="px-2">

                    </div>
                </div>
                <a class="btn btn-primary px-3" href="">$99.00/Day</a>
            </div>
            <div class="rent-item">
                <img class="img-fluid mb-4" src="img/car-rent-2.png" alt="">
                <h4 class="text-uppercase mb-4">Mercedes Benz R3</h4>
                <div class="d-flex justify-content-center mb-4">
                    <div class="px-2">
                        <i class="fa fa-car text-primary mr-1"></i>
                        <span>2015</span>
                    </div>
                    <div class="px-2 border-left border-right">
                        <i class="fa fa-cogs text-primary mr-1"></i>
                        <span>AUTO</span>
                    </div>
                    <div class="px-2">

                    </div>
                </div>
                <a class="btn btn-primary px-3" href="">$99.00/Day</a>
            </div>
            <div class="rent-item">
                <img class="img-fluid mb-4" src="img/car-rent-3.png" alt="">
                <h4 class="text-uppercase mb-4">Mercedes Benz R3</h4>
                <div class="d-flex justify-content-center mb-4">
                    <div class="px-2">
                        <i class="fa fa-car text-primary mr-1"></i>
                        <span>2015</span>
                    </div>
                    <div class="px-2 border-left border-right">
                        <i class="fa fa-cogs text-primary mr-1"></i>
                        <span>AUTO</span>
                    </div>
                    <!-- <div class="px-2">
                            <i class="fa fa-road text-primary mr-1"></i>
                            <span>25K</span>
                        </div> -->
                </div>
                <a class="btn btn-primary px-3" href="">$99.00/Day</a>
            </div>
            <div class="rent-item">
                <img class="img-fluid mb-4" src="img/car-rent-4.png" alt="">
                <h4 class="text-uppercase mb-4">Mercedes Benz R3</h4>
                <div class="d-flex justify-content-center mb-4">
                    <div class="px-2">
                        <i class="fa fa-car text-primary mr-1"></i>
                        <span>2015</span>
                    </div>
                    <div class="px-2 border-left border-right">
                        <i class="fa fa-cogs text-primary mr-1"></i>
                        <span>AUTO</span>
                    </div>
                    <div class="px-2">

                    </div>
                </div>
                <a class="btn btn-primary px-3" href="">$99.00/Day</a>
            </div>
        </div>
    </div>
</div>
<!-- Related Car End -->





<!-- style rating -->
<style>
    /* Add your custom styles for the rating here */
    .rating {
        display: inline-block;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 30px;
        color: #ddd;
        cursor: pointer;
    }

    .rating label:hover,
    .rating label:hover~label,
    .rating input:checked~label {
        color: #f39c12;
    }

    /* Thêm phần này để áp dụng Font Awesome icon cho nhãn trong .rating */
    .rating label:before {
        font-family: 'Font Awesome 5 Free';
        /* Đảm bảo bạn chọn đúng tên font */
        font-weight: 900;
        /* Đảm bảo bạn chọn đúng trọng lượng font */
    }
</style>
<!-- style mới -->

@endsection

@section('content2')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
      // Tạo mảng chứa dữ liệu ngày tháng xe đã được thuê
      var dateArray = {!! json_encode($rented_dates) !!};
      
      $('.schedule').datetimepicker({
         format: 'YYYY-MM-DD',
         minDate: new Date(),
         disabledDates: dateArray
      });
   })
   
</script>
@endsection