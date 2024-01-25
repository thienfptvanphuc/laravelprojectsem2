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
                <!-- <div class="row mx-n2 mb-3" id="thumbnailCarousel">
                    @if(is_array(json_decode($detail->thumbnail)))
                    @foreach(json_decode($detail->thumbnail) as $image=>$images)
                    <div class="item">
                        <img class="img-fluid w-100 "
                            src="{{ asset('public/be/images/products/thumbnail/' . $images) }}" alt="">
                    </div>
                    @endforeach
                    @endif
                </div> -->











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
                <p>Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et, tempor voluptua
                    sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et lorem et
                    sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata eirmod,
                    dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et magna
                </p>
                <div class="row pt-2">
                    <div class="col-md-3 col-6 mb-2">
                        <i class="fa fa-car text-primary mr-2"></i>
                        <span>Model: 2015</span>
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
                <div class="bg-secondary p-5">
                    <h3 class="text-primary text-center mb-4">Check Availability</h3>


                    <div class="form-group">
                        <div class="date" id="date1" data-target-input="nearest">
                            <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Date"
                                data-target="#date1" data-toggle="datetimepicker" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="time" id="time1" data-target-input="nearest">
                            <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Time"
                                data-target="#time1" data-toggle="datetimepicker" />
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block" type="submit" style="height: 50px;">Check Now</button>
                    </div>
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

<!-- script mới -->
<script>
    jQuery(document).ready(function ($) {
        // Owl Carousel initialization
        $(".gallery-carousel").owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            dots: false,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                768: {
                    items: 3
                }
            },
            navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"]
        });

        // Click event for opening large image modal
        $(".gallery-carousel").on("click", ".item img", function () {
            var largeImageUrl = $(this).attr("src");
            $("#largeImage").attr("src", largeImageUrl);
            $("#largeImageModal").modal("show");
        });
    });
</script>

<!-- style mới -->
<style>
    .owl-carousel {
        transition: transform 0.5s ease-in-out;
    }

    .owl-item {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .owl-stage {
        display: flex;
        align-items: center;
    }

    .owl-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
    }

    .owl-prev,
    .owl-next {
        font-size: 24px;
        color: #fff;
        background: #333;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>






<!-- <script>
    var currentThumbnailIndex = 0;
    var totalThumbnails = document.querySelectorAll('.thumbnail-item').length;

    function changeThumbnail(offset) {
        currentThumbnailIndex += offset;

        if (currentThumbnailIndex < 0) {
            currentThumbnailIndex = totalThumbnails - 1;
        } else if (currentThumbnailIndex >= totalThumbnails) {
            currentThumbnailIndex = 0;
        }

        updateThumbnailDisplay();
    }

    function updateThumbnailDisplay() {
        var thumbnails = document.querySelectorAll('.thumbnail-item');
umbnails.forEach(function(thumbnail, index) {
            var newIndex = (index - currentThumbnailIndex + totalThumbnails) % totalThumbnails;
            
            if (newIndex === 0) {
                thumbnail.style.display = 'block';
            } else {
                thumbnail.style.display = 'none';
            }
        });
    }

    function showButtons() {
        if (totalThumbnails > 1) {
            document.getElementById('prevBtn').style.display = 'inline-block';
            document.getElementById('nextBtn').style.display = 'inline-block';
        } else {
            document.getElementById('prevBtn').style.display = 'none';
            document.getElementById('nextBtn').style.display = 'none';
        }
    }

    // Gọi hàm showButtons khi trang được tải
    window.onload = showButtons;
</script>

<style>
    #prevBtn,
    #nextBtn {
        display: none;
    }
</style> -->


@endsection