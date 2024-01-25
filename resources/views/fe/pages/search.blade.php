@extends('fe/layout')
@section('content')

<!-- Search Start -->
<div class="container-fluid bg-white pt-3 px-lg-5">
   <form action="" method="get" class="">
      @csrf
      <div class="row mx-n2 justify-content-center">
         <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <div class="mb-3" id="pdate" data-target-input="nearest">
               <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Date" name="pk_date"
                  data-target="#pdate" data-toggle="datetimepicker" />
            </div>
         </div>

         <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <div class="mb-3" id="rdate" data-target-input="nearest">
               <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Return Date" name="rt_date"
                  data-target="#rdate" data-toggle="datetimepicker" />
            </div>
         </div>

         @php
         $car_type = App\Models\CarCategory:: where('type_status',1)->get();
         @endphp
         <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <select class="custom-select px-4 mb-3" style="height: 50px;" name="ctype">
               <option value="0" disabled selected>Select car type</option>
               @foreach ($car_type as $item)
               <option value="{{$item->id}}">{{$item->name}}</option>
               @endforeach
            </select>
         </div>
         <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">Search</button>
         </div>
      </div>
   </form>
</div>

<!-- Rent A Car Start -->
<div class="container-fluid py-5">
   <div class="container pt-5 pb-3">
      <h1 class="display-4 text-uppercase text-center mb-5">Result</h1>
      <div class="row">
         <?php
         if($list_car) {
            foreach ($list_car as $item ) {
         ?>
         <div class="col-lg-4 col-md-6 mb-2">
            <div class="rent-item mb-4">
               <img class="img-fluid mb-4" src="{{asset('public/be/images/products/thumbnail/'.$item->thumbnail)}}">

               <h4 class=" text-uppercase mb-4">{{$item->name}}</h4>
               <div class="d-flex justify-content-center mb-4">
                  <div class="px-2">
                     <i class="fa fa-car text-primary mr-1"></i>
                     <span>{{$item->year}}</span>
                  </div>
                  <div class="px-2 border-left border-right">
                     <i class="fa fa-cogs text-primary mr-1"></i>
                     <span>AUTO</span>
                  </div>
                  <div class="px-2">
                     <i class="fa fa-flask text-primary mr-1"></i>
                     <span>{{$item->seats}}</span>

                  </div>
               </div>
               <a class="btn btn-primary px-3" href="">$ {{$item->price}}/Day</a>
               <a class="btn btn-primary px-3" href="{{route('fe.detail',[khongdau($item->name),$item->id] )}}">View
                  Detail</a>
            </div>
         </div>
         <?php }} ?>
      </div>
   </div>
</div>
<!-- Rent A Car End -->

@endsection

@section('content2')

<script>
   $(document).ready(function () {
$('#pdate, #rdate').datetimepicker({
   format: 'YYYY-MM-DD',
   minDate: new Date()
});
})
</script>
@endsection